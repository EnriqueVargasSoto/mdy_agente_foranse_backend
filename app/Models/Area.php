<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'TbArea';

    protected $fillable = [
        'Id',
        'vc_Descripcion',
        'df_FecSistema',
        'in_Estado'
    ];
}
