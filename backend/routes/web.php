<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware('auth:sanctum')->get('api/me', [UserController::class, 'me']); 
