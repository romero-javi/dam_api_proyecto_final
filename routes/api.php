<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RecursoHumanoController;
use App\Http\Controllers\MaquinariaController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas de entidad Cliehte
Route::get("/clientes", [ClienteController::class, 'selectClientes']);
Route::get("/clientes/{id}", [ClienteController::class, 'findCliente']);
Route::post("/clientes", [ClienteController::class, 'addCliente']);
Route::put("/clientes/{id}", [ClienteController::class, 'updateCliente']);
Route::delete("/clientes/{id}", [ClienteController::class, 'deleteCliente']);

// Rutas de entidad RecursoHumano

Route::get('/recurso-humano', [RecursoHumanoController::class, 'index']); // Listar todos los empleados
Route::get('/recurso-humano/{id}', [RecursoHumanoController::class, 'show']); // Mostrar un empleado específico
Route::post('/recurso-humano', [RecursoHumanoController::class, 'store']); // Crear un nuevo empleado
Route::put('/recurso-humano/{id}', [RecursoHumanoController::class, 'update']); // Actualizar un empleado
Route::delete('/recurso-humano/{id}', [RecursoHumanoController::class, 'destroy']); // Eliminar un empleado

// Rutas de entidad maquinaria 

Route::get('/maquinaria', [MaquinariaController::class, 'index']); // Obtener lista de toda la maquinaria
Route::get('/maquinaria/{id}', [MaquinariaController::class, 'show']); // Obtener detalles de una maquinaria específica
Route::post('/maquinaria', [MaquinariaController::class, 'store']); // Crear una nueva maquinaria
Route::put('/maquinaria/{id}', [MaquinariaController::class, 'update']); // Actualizar una maquinaria existente
Route::delete('/maquinaria/{id}', [MaquinariaController::class, 'destroy']); // Eliminar una maquinaria
