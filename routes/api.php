<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\RecursoHumanoController;
use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\ProyectoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas que necesitan autenticacion
Route::middleware('auth:sanctum')->group(function () {
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
    Route::get("/proyectos/{id}/gastos", [ProyectoController::class, 'getGastos']);
    Route::get("/proyectos/{id}/materias-primas", [ProyectoController::class, 'getMateriasPrimas']);
    Route::post("/proyectos", [ProyectoController::class, 'addProyecto']);
    Route::put("/proyectos/{id}", [ProyectoController::class, 'updateProyecto']);
    Route::delete("/proyectos/{id}", [ProyectoController::class, 'deleteProyecto']);
    Route::post('/proyectos/{id}/materias-primas', [ProyectoController::class, 'assignMateriasPrimas']);
    Route::delete('/proyectos/{proyecto_id}/materias-primas/{materia_id}', [ProyectoController::class, 'deleteMateriaPrimaAsociada']);

    // Rutas de entidad Maquinaria 
    Route::get('/maquinarias', [MaquinariaController::class, 'selectMaquinarias']);
    Route::get('/maquinarias/{id}', [MaquinariaController::class, 'findMaquinaria']);
    Route::post('/maquinarias', [MaquinariaController::class, 'addMaquinaria']);
    Route::put('/maquinarias/{id}', [MaquinariaController::class, 'updateMaquinaria']);
    Route::delete('/maquinarias/{id}', [MaquinariaController::class, 'deleteMaquinaria']);

    // Rutas de entidad Gasto 
    Route::get('/gastos', [GastoController::class, 'selectGastos']);
    Route::get('/gastos/{id}', [GastoController::class, 'findGasto']);
    Route::post('/gastos', [GastoController::class, 'addGasto']);
    Route::get('/gastos/{id}/proyecto', [GastoController::class, 'getProyecto']);
    Route::put('/gastos/{id}', [GastoController::class, 'updateGasto']);
    Route::delete('/gastos/{id}', [GastoController::class, 'deleteGasto']);

    // Rutas de entidad Materia Prima 
    Route::get('/materias-primas', [MateriaPrimaController::class, 'selectMateriasPrimas']);
    Route::get('/materias-primas/{id}', [MateriaPrimaController::class, 'findMateriaPrima']);
    Route::post('/materias-primas', [MateriaPrimaController::class, 'addMateriaPrima']);
    Route::get('/materias-primas/{id}/proyecto', [MateriaPrimaController::class, 'getProyecto']);
    Route::put('/materias-primas/{id}', [MateriaPrimaController::class, 'updateMateriaPrima']);
    Route::delete('/materias-primas/{id}', [MateriaPrimaController::class, 'deleteMateriaPrima']);

    // Obtener Perfil de Usuario
    Route::get('/user', [AuthController::class, 'getPerfil']);

    // Log out functionality
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Rutas que no necesitan autenticacion
Route::post('/registrarse', [AuthController::class, 'addUser']);
Route::post('/login', [AuthController::class, 'login']);
