<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoHumano extends Model
{
    use HasFactory;

    protected $table = 'recursos_humanos';
    protected $primaryKey = 'id_recurso_humano';

    protected $fillable = [
        'nombre',
        'rol',
        'especializacion',
        'estado',
        'fecha_ingreso',
    ];
}
