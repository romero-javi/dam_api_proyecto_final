<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombre',
        'contacto',
        'direccion',
        'estado',
        'fecha_registro',
    ];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'id_cliente');
    }
}
