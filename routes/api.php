<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RecursoHumanoController;
use App\Http\Controllers\MaquinariaController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas de entidad Cliente
Route::get("/clientes", [ClienteController::class, 'selectClientes']);
Route::get("/clientes/{id}", [ClienteController::class, 'findCliente']);
Route::post("/clientes", [ClienteController::class, 'addCliente']);
Route::put("/clientes/{id}", [ClienteController::class, 'updateCliente']);
Route::delete("/clientes/{id}", [ClienteController::class, 'deleteCliente']);

// Rutas de entidad RecursosHumanos
Route::get('/recurso-humanos', [RecursoHumanoController::class, 'index']); 
Route::get('/recurso-humanos/{id}', [RecursoHumanoController::class, 'show']);
Route::post('/recurso-humanos', [RecursoHumanoController::class, 'store']);
Route::put('/recurso-humanos/{id}', [RecursoHumanoController::class, 'update']);
Route::delete('/recurso-humano/{id}', [RecursoHumanoController::class, 'destroy']);

// Rutas de entidad Maquinaria 
Route::get('/maquinarias', [MaquinariaController::class, 'selectMaquinarias']);
Route::get('/maquinarias/{id}', [MaquinariaController::class, 'findMaquinaria']);
Route::post('/maquinarias', [MaquinariaController::class, 'addMaquinaria']);
Route::put('/maquinarias/{id}', [MaquinariaController::class, 'updateMaquinaria']);
Route::delete('/maquinarias/{id}', [MaquinariaController::class, 'deleteMaquinaria']);
