<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'TbPersona';

    protected $primaryKey = 'id'; // Clave primaria (ajústalo si es diferente)

    protected $fillable = [
        'id',
        'in_TipoDocumento',
        'in_NumDocumentoIdentidad',
        'vc_Nombres',
        'vc_ApePaterno',
        'vc_ApeMaterno',
        'in_Edad',
        'in_Sexo',
        'vc_Correo',
        'vc_usuario',
        'vc_clave',
        'in_PaisId',
        'in_CentroId',
        'in_CampanaId',
        'in_SegmentoId',
        'in_AreaId',
        'in_PerfilId',
        'in_ModalidadId',
        'in_Nivel',
        'in_Estado',
        'dt_FecNacimiento',
        'in_flat',
        'in_CargoId',
        'in_telefono',
        'in_EstadoCivilId',
        'in_BlackList',
        'vc_MotivoBlackList',
        'id_usuarioRegistroBlackList',
        'dt_fechaRegistroBlackList',
        'is_Conectado',
        'is_realizoEncuesta',
        'is_finalizoEncuesta',
        'dt_fecharegistroEncuesta',
        'in_usuariogestionEncuesta',
        'in_estadogestion',
        'vc_comentarioGestion',
        'is_AproboDocumentosPuestoTrabajo',
        'is_RealizoDocumentosPuestoTrabajo',
        'dt_FechaActivo',
        'dt_FechaAnulo',
        'dt_FechaModifico',
        'dt_FechaRegistro',
        'in_IdUsuarioActivo',
        'in_IdUsuarioAnulo',
        'in_IdUsuarioModifico',
        'in_IdUsuarioRegistro',
        'dt_FechaUltimoCambioClave',
        'ip_conexion',
        'is_notificaciones',
        'dt_FechaIngreso',
        'dt_fecha_gestiono_encuesta_autoevaluacion',
        'dt_fecha_gestiono_file_autoevaluacion',
        'in_usuario_gestiono_encuesta_autoevaluacion',
        'in_usuario_gestiono_file_autoevaluacion',
        'vc_correo_corporativo',
        'in_usuarioreinicio_clave',
        'dt_fechareinicioclave',
        'url_avatar_perfil',
        'url_firma_digital',
        'in_jefe_inmediato1',
        'in_jefe_inmediato2',
        'dt_reg_token',
        'vc_acc_token',
        'vc_ref_token'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'in_PaisId', 'Id');
    }

    public function campanaDetalle()
    {
        return $this->hasMany(CampanaDetalle::class, 'in_PersonaId', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
