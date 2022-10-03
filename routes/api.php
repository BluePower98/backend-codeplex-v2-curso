<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\Branch\BranchController;
use App\Http\Controllers\Api\V1\Company\CompanyApiController;
use App\Http\Controllers\Api\V1\Company\CompanyLineProductTypeSubLineController;
use App\Http\Controllers\Api\V1\Company\CompanyMeasureController;
use App\Http\Controllers\Api\V1\Company\CompanyProductTypeLineController;
use App\Http\Controllers\Api\V1\Company\CompanyUserBranchController;
use App\Http\Controllers\Api\V1\Company\CompanyZoneController;
use App\Http\Controllers\Api\V1\Company\IntegrationCompanyController;
use App\Http\Controllers\Api\V1\Comprobante\comprobanteController;
use App\Http\Controllers\Api\V1\Logistic\Maintainers\Product\ProductCompanyZonePriceController;
use App\Http\Controllers\Api\V1\Logistic\Maintainers\Product\ProductController;
use App\Http\Controllers\Api\V1\ModuleCourse\Alumnos\AlumnoController;
use App\Http\Controllers\Api\V1\ModuleCourse\Comments\commentsController;
use App\Http\Controllers\Api\V1\ModuleCourse\Courses\CoursesController;
use App\Http\Controllers\Api\V1\ModuleCourse\Groups\GroupsController;
use App\Http\Controllers\Api\V1\ModuleCourse\Instructors\InstructorsController;
use App\Http\Controllers\Api\V1\ModuleCourse\Specialties\SpecialtiesController;
use App\Http\Controllers\Api\V1\Logistic\Maintainers\ProductType\ProductTypeController;
use App\Http\Controllers\Api\V1\Module\ModuleController;
use App\Http\Controllers\Api\V1\Module\ModulePlanMenuController;
use App\Http\Controllers\Api\V1\Month\MonthController;
use App\Http\Controllers\Api\V1\Parameter\ParameterController;
use App\Http\Controllers\Api\V1\Plan\PlanController;
use App\Http\Controllers\Api\V1\Sunat01MethodPayment\Sunat01MethodPaymentController;
use App\Http\Controllers\Api\V1\Sunatt04Monedas\Sunatt04MonedasController;
use App\Http\Controllers\Api\V1\Sunatt07TypeAffectation\Sunatt07TypeAffectationController;
use App\Http\Controllers\Api\V1\Ubigeo\UbigeoController;
use App\Http\Controllers\Api\V1\User\UserCompanyController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\User\UserModuleController;
use App\Http\Controllers\Api\V1\Ventasenc\VentasencController;
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
            Route::put('/token', [UserController::class, 'updateToken']);
            Route::get('/{user}/token', [UserController::class,'showtoken']);

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
            Route::get('/{companyId}/{prefijo}', [ProductController::class, 'getProductListByComapanyId']);

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
            Route::get('/zonatable/{company}',[CompanyZoneController::class,'getZonasS04']);
            Route::get('/combobox/{company}/{prefijo}', [CompanyZoneController::class, 'getComboBox']);
            Route::get('/combomoneda',[Sunatt04MonedasController::class,'findAllSunatt04Moneda']);

            Route::post('/datatables',[IntegrationCompanyController::class,'datatables']);
            Route::get('/',[IntegrationCompanyController::class,'show']);
            Route::post('/',[IntegrationCompanyController::class,'store']);
            Route::put('/update',[IntegrationCompanyController::class,'update']);
            Route::delete('/{company}/delete',[IntegrationCompanyController::class,'delete']);
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
        // Sunat01MethodPayment
        Route::group([
            'prefix'=>'Sunat01MethodPayment',
        ], function(){
            Route::get('/{prefijo}',[Sunat01MethodPaymentController::class,'findAllSunat01MethodPayment']);
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
        // UBIGEO
        Route::group([
            'prefix'=>'ubigeo',
        ], function(){
            Route::get('/{ubigeo}',[UbigeoController::class,'findAllByUbigeoId']);
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

    Route::group([
        'prefix'=>'ModuleCourse-Alumno'
    ],function(){

        Route::group([
            'middleware'=>'auth:sanctum'
        ],function(){
            Route::post('/datatables', [AlumnoController::class, 'datatables'])->name("alumnos.datatables");
            Route::post('/', [AlumnoController::class, 'store'])->name("alumnos.store");
            Route::put('/{idempresa}/{idalumno}', [AlumnoController::class, 'update'])->name("alumnos.update");
            Route::delete('/{idempresa}/{idalumno}', [AlumnoController::class, 'delete'])->name("alumnos.delete");
            Route::get('/{idempresa}/{idalumno}', [AlumnoController::class, 'show'])->name("alumnos.show");
        });
    });

    Route::group([
        'prefix'=>'ModuleCourse-Comments'
    ],function(){

        Route::group([
            'middleware'=>'auth:sanctum'
        ],function(){
            Route::post('/datatables', [commentsController::class, 'datatables'])->name("comments.datatables");
            Route::post('/', [commentsController::class, 'store'])->name("comments.store");
            Route::put('/{idempresa}/{idcomentarios}', [commentsController::class, 'update'])->name("comments.update");
            Route::delete('/{idempresa}/{idcomentarios}', [commentsController::class, 'delete'])->name("comments.delete");
            Route::get('/{idempresa}/{idcomentarios}', [commentsController::class, 'show'])->name("comments.show");
        });
    });

    Route::group([
        'prefix'=>'ModuleCourse-Courses'
    ],function(){

        Route::group([
            'middleware'=>'auth:sanctum'
        ],function(){
            Route::post('/datatables', [CoursesController::class, 'datatables'])->name("courses.datatables");
            Route::post('/', [CoursesController::class, 'store'])->name("courses.store");
            Route::put('/{idempresa}/{idcurso}', [CoursesController::class, 'update'])->name("courses.update");
            Route::delete('/{idempresa}/{idcurso}', [CoursesController::class, 'delete'])->name("courses.delete");
            Route::get('/{idempresa}/{idcurso}', [CoursesController::class, 'show'])->name("courses.show");
            Route::get('/{idempresa}', [CoursesController::class, 'getEspecialidades'])->name("courses.getEspecialidades");
        });
    });

    Route::group([
        'prefix'=>'ModuleCourse-Groups'
    ],function(){

        Route::group([
            'middleware'=>'auth:sanctum'
        ],function(){
            Route::post('/datatables', [GroupsController::class, 'datatables'])->name("groups.datatables");
            Route::post('/', [GroupsController::class, 'store'])->name("groups.store");
            Route::put('/{idempresa}/{idgrupo}', [GroupsController::class, 'update'])->name("groups.update");
            Route::delete('/{idempresa}/{idgrupo}', [GroupsController::class, 'delete'])->name("groups.delete");
            Route::get('/{idempresa}/{idgrupo}', [GroupsController::class, 'show'])->name("groups.show");
            Route::get('/{idempresa}', [GroupsController::class, 'getCursos'])->name("groups.getCursos");
            Route::get('/', [GroupsController::class, 'getMondedas'])->name("groups.getMondedas");
        });
    });

    Route::group([
        'prefix'=>'ModuleCourse-Instructors'
    ],function(){

        Route::group([
            'middleware'=>'auth:sanctum'
        ],function(){
            Route::post('/datatables', [InstructorsController::class, 'datatables'])->name("instructors.datatables");
            Route::post('/', [InstructorsController::class, 'store'])->name("instructors.store");
            Route::put('/{idempresa}/{idinstructor}', [InstructorsController::class, 'update'])->name("instructors.update");
            Route::delete('/{idempresa}/{idinstructor}', [InstructorsController::class, 'delete'])->name("instructors.delete");
            Route::get('/{idempresa}/{idinstructor}', [InstructorsController::class, 'show'])->name("instructors.show");
        });
    });

    Route::group([
        'prefix'=>'ModuleCourse-Specialties'
    ],function(){

        Route::group([
            'middleware'=>'auth:sanctum'
        ],function(){
            Route::post('/datatables', [SpecialtiesController::class, 'datatables'])->name("specialties.datatables");
            Route::post('/', [SpecialtiesController::class, 'store'])->name("specialties.store");
            Route::put('/{idempresa}/{idespecialidad}', [SpecialtiesController::class, 'update'])->name("specialties.update");
            Route::delete('/{idempresa}/{idespecialidad}', [SpecialtiesController::class, 'delete'])->name("specialties.delete");
            Route::get('/{idempresa}/{idespecialidad}', [SpecialtiesController::class, 'show'])->name("specialties.show");
        });
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
    Route::group([
        'prefix' => 'documentos',
    ], function() {
        Route::get('/', [comprobanteController::class, 'getComprobante']);
        Route::get('/detalle', [comprobanteController::class, 'GetVentasDetalleId_Comprobante']);
        Route::get('/ventapago', [comprobanteController::class, 'getVentaPagos']);
        Route::get('/downloadXML', [comprobanteController::class, 'downloadXML']);
        Route::get('/excel', [comprobanteController::class, 'getDatoForExcel']);
    });
});
