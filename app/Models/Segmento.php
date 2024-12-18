<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
    use HasFactory;

    protected $table = 'TbSegmento';

    protected $fillable = [
        'Id',
        'vc_Descripcion',
        'df_FecSistema',
        'in_Estado'
    ];
}
