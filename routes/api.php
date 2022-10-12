<?php
// MODULO INTEGRADOR
use App\Http\Controllers\Api\V1\ModuleIntegrator\Branch\BranchController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Company\CompanyApiController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Company\IntCompanyZoneController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Company\IntegrationCompanyController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Comprobante\ComprobanteController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Parameter\ParameterController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Product\IntProductController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Sunat01MethodPayment\Sunat01MethodPaymentController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Sunatt04Monedas\Sunatt04MonedasController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Ubigeo\UbigeoController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\User\UserController;
use App\Http\Controllers\Api\V1\ModuleIntegrator\Ventasenc\VentasencController;
// END MODULO INTEGRADOR

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
            Route::get('/{idplan}',[ModuleController::class,'findByPrefijoModulo']);
            Route::get('/{user}/all',[ModuleController::class,'findModuleByUserId']);
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

    // ==============================================
    //          MODULO INTEGRADOR
    // ==============================================
    Route::group([
        'prefix'=>'integrador'
    ],function(){


        Route::group([
            'middleware'=>'auth:sanctum'
        ],function(){

            // users
            Route::group([
                'prefix' => 'users',
            ], function() {
                Route::put('/token', [UserController::class, 'updateToken']);
                Route::get('/{user}/token', [UserController::class,'showtoken']);
            });
            // BRANCH
            Route::group([
                'prefix'=>'branch',
            ], function(){
                Route::get('/',[BranchController::class,'show']);
                Route::post('/datatables/{companyId}',[BranchController::class,'datatables']);
                Route::post('/',[BranchController::class,'store']);
                Route::put('/update',[BranchController::class,'update']);
                Route::get('/{companyId}/{branchId}/{prefijo}',[BranchController::class,'showBranch']);
                Route::post('/logo',[BranchController::class,'updateLogo']);
                Route::get('/oneBranch/{companyId}/{branchId}/{prefijo}',[BranchController::class,'getOneBranchCompayIdBranchId']);
                Route::delete('/{brachId}/{companyId}/{prefijo}',[BranchController::class,'delete']);
                
            });

            // Products
            Route::group([
                'prefix' => 'products',
            ], function() {
                Route::get('/{companyId}/{prefijo}', [IntProductController::class, 'getProductListByComapanyId']);
            });

            // Sunat01MethodPayment
            Route::group([
                'prefix'=>'Sunat01MethodPayment',
            ], function(){
                Route::get('/{prefijo}',[Sunat01MethodPaymentController::class,'findAllSunat01MethodPayment']);
            });
            // PARAMETER
            Route::group([
                'prefix'=>'parameter',
            ], function(){
                Route::get('/',[ParameterController::class,'show']);
                Route::put('/update',[ParameterController::class,'update']);
                Route::get('/comboSoap',[ParameterController::class,'getComboSoap']);
                Route::get('/comboTypeSoap',[ParameterController::class,'getComboTypeSoap']);
                Route::get('/getSistem/{parameterId}',[ParameterController::class,'getDateSistemByParameterId']);
                Route::post('/',[ParameterController::class,'updateDateSistemByParameterId']);
                Route::get('/methodenvio',[ParameterController::class,'getComboMethodEnvio']);
                Route::get('/typedocument',[ParameterController::class,'gettypedocument']);
                
            });
            // companiesApi
            Route::group([
                'prefix'=>'companiesApi',
            ], function(){
                Route::post('/datatables',[CompanyApiController::class,'datatable']);
            });

            // Companies
            Route::group([
                'prefix' => 'companies',
            ], function() {
                Route::get('/zonatable/{company}',[IntCompanyZoneController::class,'getZonasS04']);
                Route::get('/combobox/{company}/{prefijo}', [IntCompanyZoneController::class, 'getComboBox']);
                Route::get('/combomoneda',[Sunatt04MonedasController::class,'findAllSunatt04Moneda']);

                Route::post('/datatables',[IntegrationCompanyController::class,'datatables']);
                Route::get('/',[IntegrationCompanyController::class,'show']);
                Route::post('/',[IntegrationCompanyController::class,'store']);
                Route::put('/update',[IntegrationCompanyController::class,'update']);
                Route::delete('/{company}/delete',[IntegrationCompanyController::class,'delete']);
            });
            
            //  Documentos
            Route::group([
                'prefix' => 'documentos',
            ], function() {
                Route::get('/', [ComprobanteController::class, 'getComprobante']);
                Route::get('/detalle', [ComprobanteController::class, 'GetVentasDetalleId_Comprobante']);
                Route::get('/ventapago', [ComprobanteController::class, 'getVentaPagos']);
                Route::post('/downloadXML', [ComprobanteController::class, 'downloadXML']);
                Route::get('/excel', [ComprobanteController::class, 'getDatoForExcel']);
            });

            // Int_Proc_facturacion
            Route::group([
                'prefix' => 'ventasenc',
            ], function() {
                Route::get('/{prefijo}/{idempresa}', [VentasencController::class, 'getTipoDocumneto']);
                Route::post('/datatables', [VentasencController::class, 'datatables']);
                Route::get('/detallefactura', [VentasencController::class, 'getDatoListaDetalleFactura']);
                Route::put('/quitar-habilitado-factura', [VentasencController::class, 'quitarHabilitadoFactura']);
                Route::put('/actualizar-estado', [VentasencController::class, 'habilitarEstado']);

            });

            // UBIGEO
            Route::group([
                'prefix'=>'ubigeo',
            ], function(){
                Route::get('/{ubigeo}',[UbigeoController::class,'findAllByUbigeoId']);
            });

            // zonas
            Route::group([
                'prefix' => 'zones',
            ], function() {
                Route::post('/',[IntCompanyZoneController::class, 'storeUpdate']);
                Route::delete('/{companyId}/{zonaId}',[IntCompanyZoneController::class, 'delete']);
            });

        });
    });

    // ==============================================
    //          END MODULO INTEGRADOR
    // ==============================================
});
