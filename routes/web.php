<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPortfolioController;
use App\Http\Controllers\UserController;

Route::any('/{any}', [MyPortfolioController::class, 'index'])
    ->where('any', '^(?!api|sanctum).*$');
