<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'af_tracking';

    protected $fillable = [
        'id',
        'in_CampanaDetalleId',
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

    public function campanaDetalle()
    {
        return $this->belongsTo(CampanaDetalle::class, 'in_CampanaDetalleId', 'Id');
    }

    public function screens()
    {
        return $this->hasMany(ScreenEvent::class, 'in_TrackingId', 'id');
    }
}
