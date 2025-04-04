<?php

use Illuminate\Support\Facades\Route;

Route::get('/users', [\App\Http\Controllers\Api\v1\UserController::class, 'index']);

