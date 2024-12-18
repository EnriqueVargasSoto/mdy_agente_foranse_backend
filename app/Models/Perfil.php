<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'TbPerfil';

    protected $fillable = [
        'Id',
        'vc_Descripcion',
        'in_Estado',
        'area_id'
    ];
}
