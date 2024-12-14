<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';

    protected $fillable = [
        'id',
        'sistemaOperativo',
        'procesador',
        'ram',
        'mac',
        'ipPublica',
        'ipPrivada',
        'ubicacionGeografica',
        'idPc',
        'nombre',
        'tipo',
        'cliente',
        'hostname'
    ];
}
