<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\UsuarioController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


/*
|--------------------------------------------------------------------------  
| API Routes  
|--------------------------------------------------------------------------  
|  
| Here is where you can register API routes for your application. These  
| routes are loaded by the RouteServiceProvider and all of them will  
| be assigned to the "api" middleware group. Make something great!  
|  
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('empresas', EmpresaController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('clientes', ClienteController::class);
});

Route::middleware('api')->get('csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
