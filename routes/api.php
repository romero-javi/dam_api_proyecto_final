<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RecursoHumanoController;
use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\ProyectoController;
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
Route::get('/recursos-humanos', [RecursoHumanoController::class, 'selectRecursosHumanos']); 
Route::get('/recursos-humanos/{id}', [RecursoHumanoController::class, 'findRecursoHumano']);
Route::post('/recursos-humanos', [RecursoHumanoController::class, 'addRecursoHumano']);
Route::put('/recursos-humanos/{id}', [RecursoHumanoController::class, 'updateRecursoHumano']);
Route::delete('/recursos-humanos/{id}', [RecursoHumanoController::class, 'deleteRecursoHumano']);

// Rutas de entidad Proyecto
Route::get("/proyectos", [ProyectoController::class, 'selectProyectos']);
Route::get("/proyectos/{id}", [ProyectoController::class, 'findProyecto']);
Route::get("/proyectos/{id}/cliente", [ProyectoController::class, 'getcliente']);
Route::post("/proyectos", [ProyectoController::class, 'addProyecto']);
Route::put("/proyectos/{id}", [ProyectoController::class, 'updateProyecto']);
Route::delete("/proyectos/{id}", [ProyectoController::class, 'deleteProyecto']);

// Rutas de entidad Maquinaria 
Route::get('/maquinarias', [MaquinariaController::class, 'selectMaquinarias']);
Route::get('/maquinarias/{id}', [MaquinariaController::class, 'findMaquinaria']);
Route::post('/maquinarias', [MaquinariaController::class, 'addMaquinaria']);
Route::put('/maquinarias/{id}', [MaquinariaController::class, 'updateMaquinaria']);
Route::delete('/maquinarias/{id}', [MaquinariaController::class, 'deleteMaquinaria']);
