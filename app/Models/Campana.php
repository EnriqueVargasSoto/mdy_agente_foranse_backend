<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campana extends Model
{
    use HasFactory;

    protected $table = 'TbCampana';

    protected $fillable = [
        'Id',
        'in_SegmentoId',
        'in_CentroId',
        'vc_Descripcion',
        'in_Estado',
        'in_RequierePrestamo',
        'vc_linkevaluatest',
        'vc_codigoEvaluatest',
        'in_NoRequiereUsuarioE',
        'dtfecha_usuarioModifico',
        'dtfecha_usuarioRegistro',
        'id_usuarioModifico',
        'id_usuarioRegistro'
    ];
}
