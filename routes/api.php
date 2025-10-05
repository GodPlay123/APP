<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);

Route::fallback(function () {
    return response()->json(['message' => 'API route not found'], 404);
});
