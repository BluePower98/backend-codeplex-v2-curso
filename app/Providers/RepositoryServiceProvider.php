<?php

namespace App\Providers;

use App\Repositories\Branch\BranchRepository;
use App\Repositories\Branch\BranchRepositoryInterface;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Inventory\InventoryRepository;
use App\Repositories\Inventory\InventoryRepositoryInterface;
use App\Repositories\Line\LineRepository;
use App\Repositories\Line\LineRepositoryInterface;
use App\Repositories\Measure\MeasureRepository;
use App\Repositories\Measure\MeasureRepositoryInterface;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Repositories\Module\ModuleRepository;
use App\Repositories\Module\ModuleRepositoryInterface;
use App\Repositories\ModuleMenuVideo\ModuleMenuVideoRepository;
use App\Repositories\ModuleMenuVideo\ModuleMenuVideoRepositoryInterface;
use App\Repositories\Month\MonthRepository;
use App\Repositories\Month\MonthRepositoryInterface;
use App\Repositories\PasswordReset\PasswordResetRepository;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;
use App\Repositories\PersonalAccessToken\PersonalAccessTokenRepository;
use App\Repositories\PersonalAccessToken\PersonalAccessTokenRepositoryInterface;
use App\Repositories\Plan\PlanRepository;
use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\PlanDescription\PlanDescriptionRepository;
use App\Repositories\PlanDescription\PlanDescriptionRepositoryInterface;
use App\Repositories\PlanDetail\PlanDetailRepository;
use App\Repositories\PlanDetail\PlanDetailRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductImage\ProductImageRepository;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Repositories\SubLine\SubLineRepository;
use App\Repositories\SubLine\SubLineRepositoryInterface;
use App\Repositories\Sunatt07TypeAffectation\Sunatt07TypeAffectationRepository;
use App\Repositories\Sunatt07TypeAffectation\Sunatt07TypeAffectationRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Year\YearRepository;
use App\Repositories\Year\YearRepositoryInterface;
use App\Repositories\Zone\ZoneRepository;
use App\Repositories\Zone\ZoneRepositoryInterface;
use App\Repositories\ZonePrice\ZonePriceRepository;
use App\Repositories\ZonePrice\ZonePriceRepositoryInterface;
use App\Repositories\ZonePriceType\ZonePriceTypeRepository;
use App\Repositories\ZonePriceType\ZonePriceTypeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            PersonalAccessTokenRepositoryInterface::class,
            PersonalAccessTokenRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            PasswordResetRepositoryInterface::class,
            PasswordResetRepository::class
        );

        $this->app->bind(
            ModuleRepositoryInterface::class,
            ModuleRepository::class
        );

        $this->app->bind(
            PlanRepositoryInterface::class,
            PlanRepository::class
        );

        $this->app->bind(
            PlanDetailRepositoryInterface::class,
            PlanDetailRepository::class
        );

        $this->app->bind(
            PlanDescriptionRepositoryInterface::class,
            PlanDescriptionRepository::class
        );

        $this->app->bind(
            MenuRepositoryInterface::class,
            MenuRepository::class
        );

        $this->app->bind(
            ModuleMenuVideoRepositoryInterface::class,
            ModuleMenuVideoRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            MonthRepositoryInterface::class,
            MonthRepository::class
        );

        $this->app->bind(
            YearRepositoryInterface::class,
            YearRepository::class
        );

        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );

        $this->app->bind(
            BranchRepositoryInterface::class,
            BranchRepository::class
        );

        $this->app->bind(
            ZoneRepositoryInterface::class,
            ZoneRepository::class
        );

        $this->app->bind(
            MeasureRepositoryInterface::class,
            MeasureRepository::class
        );

        $this->app->bind(
            ZonePriceTypeRepositoryInterface::class,
            ZonePriceTypeRepository::class
        );

        $this->app->bind(
            Sunatt07TypeAffectationRepositoryInterface::class,
            Sunatt07TypeAffectationRepository::class
        );

        $this->app->bind(
            LineRepositoryInterface::class,
            LineRepository::class
        );

        $this->app->bind(
            SubLineRepositoryInterface::class,
            SubLineRepository::class
        );

        $this->app->bind(
            ZonePriceRepositoryInterface::class,
            ZonePriceRepository::class
        );

        $this->app->bind(
            InventoryRepositoryInterface::class,
            InventoryRepository::class
        );

        $this->app->bind(
            ProductImageRepositoryInterface::class,
            ProductImageRepository::class
        );
    }
}
