<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    use HasFactory;
    
    protected $table = 'maquinaria';
    protected $primaryKey = 'id_maquinaria';

    protected $fillable = [
        'nombre',
        'estado',
        'fecha_ultimo_mantenimiento',
        'fecha_adquisicion',
        'tipo',
        'costo_diario',
    ];
}
