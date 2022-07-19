<?php

namespace App\Services\Application\Menu;

use App\Models\User;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Repositories\ModuleMenuVideo\ModuleMenuVideoRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class MenuService
{
    private MenuRepositoryInterface $menuRepository;
    private ModuleMenuVideoRepositoryInterface $moduleMenuVideoRepository;

    public function __construct(
        MenuRepositoryInterface $menuRepository,
        ModuleMenuVideoRepositoryInterface $moduleMenuVideoRepository
    )
    {
        $this->menuRepository = $menuRepository;
        $this->moduleMenuVideoRepository = $moduleMenuVideoRepository;
    }

    /**
     * @param int $moduleId
     * @param int $planId
     * @return Collection
     */
    public function findAllByModuleIdAndPlanId(int $moduleId, int $planId): Collection
    {
        /* @var User $user */
        $user = Auth::user();

        $userId = $user->{$user->getKeyName()};

        $menus = $this->menuRepository->findAllByModuleIdAndPlanId(
            $moduleId,
            $planId,
            $userId
        );

        // Obtener los videos de un módulo.
        $videos = $this->moduleMenuVideoRepository->findAllByModuleId($moduleId);

        // Obtener los niveles de permisos por menu.
        $permissions = $this->menuRepository->findAllPermissionsByUserId($userId);

        $parent = array_filter($menus, function ($menu) {
            return strlen($menu->codigo_menu) === 3;
        });

        $parent = array_values($parent);
        $array_codes = array_column($parent, 'codigo_menu');

        foreach ($menus as $menu) {
            $code = $menu->codigo_menu;

            if (strlen($code) === 3) {
                $index = array_search($code, $array_codes);
                $parent[$index]->childrens = [];

                // Videos para los menus "padre".
                $parent[$index]->videos = $this->getIteratorVideosByMenu($videos, $parent[$index]);
                $parent[$index]->permits = $this->getIteratorAccessLevel($permissions, $parent[$index]);
                continue;
            }

            // Videos para los "hijos" de un menu padre.
            $menu->videos = $this->getIteratorVideosByMenu($videos, $menu);
            $menu->permits = $this->getIteratorAccessLevel($permissions, $menu);

            $code = substr($code, 0, 3);
            $index = array_search($code, $array_codes);
            $parent[$index]->childrens[] = $menu;

            // TODO: Mejora esta función.
        }

        return collect($menus);
    }


    private function getIteratorVideosByMenu(array $videos, object $menu): array
    {
        return array_values(array_filter($videos, function($video) use($menu){
            return $video['idmenu'] === $menu->id;
        }));
    }

    private function getIteratorAccessLevel(array $permits, object $menu): array
    {
        return array_values(array_filter($permits, function($permit) use($menu){
            return $permit->idmenu === $menu->id;
        }));
    }
}
