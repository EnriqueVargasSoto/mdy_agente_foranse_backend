<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampanaDetalle extends Model
{
    use HasFactory;

    protected $table = 'TbCampanaDetalle';

    protected $fillable = [
        'Id',
        'in_CampanaId',
        'in_Estado',
        'in_PersonaId',
        'in_SegmentoId',
        'in_CentroId'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'in_PersonaId', 'id');
    }

    public function segmento()
    {
        return $this->belongsTo(Segmento::class, 'in_SegmentoId', 'Id');
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class, 'in_CentroId', 'Id');
    }

    public function campana()
    {
        return $this->belongsTo(Campana::class, 'in_CampanaId', 'Id');
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'in_CampanaDetalleId', 'Id');
    }
}
