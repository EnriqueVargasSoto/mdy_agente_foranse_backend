<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;

    protected $table = 'TbCentro';

    protected $fillable = [
        'Id',
        'inPaisId',
        'in_RazonSocialId',
        'vc_Descripcion',
        'df_FecSistema',
        'in_Estado',
        'Abr'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'inPaisId', 'Id');
    }
}
