<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\Company\CompanyLineProductTypeSubLineController;
use App\Http\Controllers\Api\V1\Company\CompanyMeasureController;
use App\Http\Controllers\Api\V1\Company\CompanyProductTypeLineController;
use App\Http\Controllers\Api\V1\Company\CompanyUserBranchController;
use App\Http\Controllers\Api\V1\Company\CompanyZoneController;
use App\Http\Controllers\Api\V1\Logistic\Maintainers\Product\ProductCompanyZonePriceController;
use App\Http\Controllers\Api\V1\Logistic\Maintainers\Product\ProductController;
use App\Http\Controllers\Api\V1\Logistic\Maintainers\ProductType\ProductTypeController;
use App\Http\Controllers\Api\V1\Module\ModuleController;
use App\Http\Controllers\Api\V1\Module\ModulePlanMenuController;
use App\Http\Controllers\Api\V1\Month\MonthController;
use App\Http\Controllers\Api\V1\Plan\PlanController;
use App\Http\Controllers\Api\V1\Sunatt07TypeAffectation\Sunatt07TypeAffectationController;
use App\Http\Controllers\Api\V1\User\UserCompanyController;
use App\Http\Controllers\Api\V1\User\UserModuleController;
use App\Http\Controllers\Api\V1\Year\YearController;
use App\Http\Controllers\Api\V1\ZonePriceType\ZonePriceTypeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/environments", function() {
    return response()->json(config('app'));
});

Route::get("/test-db", function() {
   $results = DB::table("zg_usuarios")->get();

   return response()->json($results);
});

// Auth
Route::group(['prefix' => 'auth'], function() {
    Route::post("/login", [AuthController::class, 'login'])->name("auth.login");
    Route::get("/activate-account/{token}", [AuthController::class, 'activateAccount'])->name("auth.activate-account");
    Route::get("/validate-token/{token}", [AuthController::class, 'validateToken'])->name("auth.validate-token");
    Route::post("/forgot-password", [ForgotPasswordController::class, 'sendResetLinkEmail'])->name("auth.forgot-password");
    Route::get("/reset-password/verify-token/{token}", [ResetPasswordController::class, 'verifyToken'])->name("auth.reset-password.verify-token");
    Route::put("/reset-password", [ResetPasswordController::class, 'update'])->name("auth.reset-password");

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get("/me", [AuthController::class, 'me'])->name("auth.me");
        Route::get("/logout", [AuthController::class, 'logout'])->name("auth.logout");
    });
});

// API en versión "V1"
Route::group([
    'prefix' => 'v1',
], function() {


    // Modules
    Route::group([
        'prefix' => 'modules',
    ], function() {
        Route::get('/', [ModuleController::class, 'index']);

        Route::group([
            'middleware' => 'auth:sanctum'
        ], function() {
            Route::get('/{module}/plans/{plan}/menu', [ModulePlanMenuController::class, 'index']);
        });
    });

    // Plans
    Route::group([
        'prefix' => 'plans',
    ], function() {
        Route::get('/', [PlanController::class, 'index']);
    });

    Route::group([
        'middleware' => 'auth:sanctum'
    ], function() {
        // Users
        Route::group([
            'prefix' => 'users',
        ], function() {
            Route::get('/{user}/companies', [UserCompanyController::class, 'index']);
            Route::get('/{user}/modules', [UserModuleController::class, 'index']);
        });

        // Products
        Route::group([
            'prefix' => 'products',
        ], function() {
            Route::get('/', [ProductController::class, 'index'])->name("products.index");
            Route::get('/{product}', [ProductController::class, 'show'])->name("products.show");
            Route::post('/generate-code', [ProductController::class, 'generateCode'])->name("products.generate-code");
            Route::post('/datatables', [ProductController::class, 'datatables'])->name("products.datatables");
            Route::post('/', [ProductController::class, 'store'])->name("products.store");
            Route::put('/{product}', [ProductController::class, 'update'])->name("products.update");
            Route::delete('/{product}', [ProductController::class, 'delete'])->name("products.delete");
            Route::get('/{product}/companies/{company}/zones-prices', [ProductCompanyZonePriceController::class, 'index'])->name("products.companies.zones-prices");
        });

        // Products Type
        Route::group([
            'prefix' => 'products-types',
        ], function() {
            Route::get('/', [ProductTypeController::class, 'index'])->name("products-types.index");
        });

        // Months
        Route::group([
            'prefix' => 'months',
        ], function() {
            Route::get('/', [MonthController::class, 'index'])->name("months.index");
        });

        // Years
        Route::group([
            'prefix' => 'years',
        ], function() {
            Route::get('/', [YearController::class, 'index'])->name("years.index");
        });

        // Companies
        Route::group([
            'prefix' => 'companies',
        ], function() {
            Route::get('/{company}/zones', [CompanyZoneController::class, 'index']);
            Route::get('/{company}/measures', [CompanyMeasureController::class, 'index']);
            Route::get('/{company}/products-types/{productType}/lines', [CompanyProductTypeLineController::class, 'index']);
            Route::get('/{company}/lines/{line}/products-types/{productType}/sub-lines', [CompanyLineProductTypeSubLineController::class, 'index']);
            Route::get('/{company}/users/{user}/sucursales', [CompanyUserBranchController::class, 'index']);
        });

        Route::group([
            'prefix' => 'zones-prices-types',
        ], function() {
            Route::get('/', [ZonePriceTypeController::class, 'index']);
        });

        Route::group([
            'prefix' => 'sunatt07-types-affectations',
        ], function() {
            Route::get('/', [Sunatt07TypeAffectationController::class, 'index']);
        });
    });


});
