<?php

namespace App\Providers;

use App\Repositories\Branch\BranchRepository;
use App\Repositories\Branch\BranchRepositoryInterface;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\CompanyApi\CompanyApiRepository;
use App\Repositories\CompanyApi\CompanyApiRepositoryInterface;
use App\Repositories\Comprobante\ComprobanteRepository;
use App\Repositories\Comprobante\ComprobanteRepositoryInterface;
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
use App\Repositories\Parameter\ParameterRepository;
use App\Repositories\Parameter\ParameterRepositoryInterface;
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
use App\Repositories\ModuleCourse\Alumnos\AlumnosRepository;
use App\Repositories\ModuleCourse\Alumnos\AlumnosRepositoryInterface;
use App\Repositories\ModuleCourse\Comments\CommentsRepository;
use App\Repositories\ModuleCourse\Comments\CommentsRepositoryInterface;
use App\Repositories\ModuleCourse\Courses\CoursesRepository;
use App\Repositories\ModuleCourse\Courses\CoursesRepositoryInterface;
use App\Repositories\ModuleCourse\Groups\GroupsRepository;
use App\Repositories\ModuleCourse\Groups\GroupsRepositoryInterface;
use App\Repositories\ModuleCourse\Instructors\InstructorsRepository;
use App\Repositories\ModuleCourse\Instructors\InstructorsRepositoryInterface;
use App\Repositories\ModuleCourse\Specialties\SpecialtiesRepository;
use App\Repositories\ModuleCourse\Specialties\SpecialtiesRepositoryInterface;
use App\Repositories\SubLine\SubLineRepository;
use App\Repositories\SubLine\SubLineRepositoryInterface;
use App\Repositories\Sunat01MethodPayment\Sunat01MethodPaymentRepository;
use App\Repositories\Sunat01MethodPayment\Sunat01MethodPaymentRepositoryInterface;
use App\Repositories\Sunatt04Monedas\Sunatt04MonedasRepository;
use App\Repositories\Sunatt04Monedas\Sunatt04MonedasRepositoryInterface;
use App\Repositories\Sunatt07TypeAffectation\Sunatt07TypeAffectationRepository;
use App\Repositories\Sunatt07TypeAffectation\Sunatt07TypeAffectationRepositoryInterface;
use App\Repositories\Ubigeo\UbigeoRepository;
use App\Repositories\Ubigeo\UbigeoRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Ventasenc\VentasencRepository;
use App\Repositories\Ventasenc\VentasencRepositoryInterface;
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
        $this->app->bind(
            UbigeoRepositoryInterface::class,
            UbigeoRepository::class
        );
        $this->app->bind(
            ParameterRepositoryInterface::class,
            ParameterRepository::class
        );
        $this->app->bind(
            Sunat01MethodPaymentRepositoryInterface::class,
            Sunat01MethodPaymentRepository::class
        );
        $this->app->bind(
            CompanyApiRepositoryInterface::class,
            CompanyApiRepository::class
        );
        $this->app->bind(
            VentasencRepositoryInterface::class,
            VentasencRepository::class
        );
        $this->app->bind(
            Sunatt04MonedasRepositoryInterface::class,
            Sunatt04MonedasRepository::class
        );
        $this->app->bind(
            ComprobanteRepositoryInterface::class,
            ComprobanteRepository::class
        );
        //Repositorios de Cursos
        $this->app->bind(
            AlumnosRepositoryInterface::class,
            AlumnosRepository::class
        );
        $this->app->bind(
            CommentsRepositoryInterface::class,
            CommentsRepository::class
        );
        $this->app->bind(
            CoursesRepositoryInterface::class,
            CoursesRepository::class
        );
        $this->app->bind(
            GroupsRepositoryInterface::class,
            GroupsRepository::class
        );
        $this->app->bind(
            InstructorsRepositoryInterface::class,
            InstructorsRepository::class
        );
        $this->app->bind(
            SpecialtiesRepositoryInterface::class,
            SpecialtiesRepository::class
        );
    }
}
