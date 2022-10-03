<?php

namespace App\Services\Application\ModuleCourse\Groups;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\ModuleCourse\Groups\GroupsRepositoryInterface;

class GroupsService
{
    private GroupsRepositoryInterface $GroupsRepository;

    public function __construct(
        GroupsRepositoryInterface $GroupsRepository
    )
    {
        $this->GroupsRepository = $GroupsRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->GroupsRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->GroupsRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idgrupo): Collection
    {
        return $this->GroupsRepository->update($request->all(), $idempresa, $idgrupo);
    }

    public function delete(string $idempresa, int $idgrupo): Collection
    {
        return $this->GroupsRepository->delete($idempresa, $idgrupo);
    }

    public function show(string $idempresa, int $idgrupo): Collection
    {
        return $this->GroupsRepository->show($idempresa, $idgrupo);
    }

    public function getCursos(string $idempresa): Collection
    {
        return $this->GroupsRepository->getCursos($idempresa);
    }

    public function getMondedas(): Collection
    {
        return $this->GroupsRepository->getMondedas();
    }
}
