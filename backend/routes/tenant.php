<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
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

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {
    Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [App\Http\Controllers\Api\AuthController::class, 'me']);
        Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        
        // Master Data
        Route::apiResource('anggota', App\Http\Controllers\Api\AnggotaController::class);
    });

    Route::get('/', function () {
        return response()->json([
            'message' => 'Tenant API is working',
            'tenant_id' => tenant('id')
        ]);
    });
});
