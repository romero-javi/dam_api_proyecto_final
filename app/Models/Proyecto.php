<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyecto';
    protected $primaryKey = 'id_proyecto';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'estado',
        'porcentaje_avance',
        'fecha_inicio',
        'fecha_fin',
        'inversion_inicial',
        'inversion_final',
        'costo_diario',
        'tipo_proyecto',
        'imagen_url',
        'inconvenientes',
        'notificaciones',
        'id_cliente'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function gastos()
    {
        return $this->hasMany(Gasto::class, 'id_proyecto');
    }

    public function materias_primas()
    {
        return $this->belongsToMany(MateriaPrima::class);
    }
}
