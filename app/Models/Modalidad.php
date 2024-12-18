<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;

    protected $table = 'TbModalidad';

    protected $fillable = [
        'Id',
        'vc_Descripcion',
        'in_Estado'
    ];
}
