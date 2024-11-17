<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;

    protected $table = 'materia_prima';
    protected $primaryKey = 'id_materia_prima';

    protected $fillable = [
        'nombre',
        'cantidad',
        'costo',
        'id_proyecto'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }
}
