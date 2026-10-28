<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Categorías — CRUD completo
Route::apiResource('categories', CategoryController::class);

// Productos — CRUD completo
Route::apiResource('products', ProductController::class);

// Alias /api/docs → Swagger UI (requisito de la prueba)
Route::get('/docs', function () {
    return redirect('/api/documentation');
});
