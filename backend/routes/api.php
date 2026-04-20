<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// Route::middleware('auth:sanctum')->group(function () {
//   Route::get('/me', [UserController::class, 'me']);
//   Route::middleware('authAdmin')->get('/admin', [UserController::class, 'admin']);
//   Route::middleware('authManagerOrAdmin')->get('/manager-or-admin', [UserController::class, 'managerOrAdmin']);
// });
Route::post('/fake-saml-login', [UserController::class, 'fakeSamlLogin']);
Route::get('/me', [UserController::class, 'me']);

