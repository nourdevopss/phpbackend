<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group(['prefix' => config('sanctum.prefix', 'sanctum')], static function () {
    Route::get('/csrf-cookie', [CsrfCookieController::class, 'show'])
        ->middleware([
            'web',
            InitializeTenancyByDomain::class // Use tenancy initialization middleware of your choice
        ])->name('sanctum.csrf-cookie');
});

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::post('api/login', [AuthController::class, 'authenticate']);
    Route::post('api/register', [AuthController::class, 'register']);
});


Route::middleware([
    'web',
    'auth:sanctum',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('api/user', [UserController::class, 'index']);
});

