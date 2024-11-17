<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoHumano extends Model
{
    use HasFactory;

    // Definir los campos que pueden ser llenados de manera masiva (mass assignable)
    protected $fillable = [
        'nombre',
        'rol',
        'especializacion',
        'estado',
        'fecha_registro',
    ];

    // Si quieres personalizar los nombres de las fechas
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';
}
