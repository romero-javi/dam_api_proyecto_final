<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    use HasFactory;

    // Definir los campos que pueden ser llenados de manera masiva (mass assignable)
    protected $fillable = [
        'nombre',
        'estado',
        'fecha_ultimo_mantenimiento',
        'costo_diario',
        'especializacion',
        'fecha_registro',
        'ID_Proyecto',  // Asegúrate de que este campo sea correcto según tu migración
    ];

    // Definir las relaciones si es necesario (por ejemplo, con Proyecto)
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'ID_Proyecto');
    }

    // Si quieres personalizar los nombres de las fechas
    const CREATED_AT = 'fecha_creacion';   // Personaliza el nombre de la columna 'created_at'
    const UPDATED_AT = 'fecha_actualizacion'; // Personaliza el nombre de la columna 'updated_at'
}
