<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'TbPais';

    protected $fillable = [
        'Id',
        'vc_Descripcion',
        'df_FecSistema',
        'in_Estado'
    ];

    public function personas()
    {
        return $this->hasMany(Persona::class, 'in_PaisId', 'Id');
    }

    public function centro()
    {
        return $this->hasMany(Persona::class, 'in_CentroId', 'Id');
    }
}
