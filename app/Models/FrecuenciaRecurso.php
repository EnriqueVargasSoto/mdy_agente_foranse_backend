<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrecuenciaRecurso extends Model
{
    use HasFactory;

    protected $table = 'af_frecuencia_recursos';

    protected $fillable = [
        'id',
        'in_PersonaId',
        'intervalo'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'in_PersonaId', 'id');
    }
}
