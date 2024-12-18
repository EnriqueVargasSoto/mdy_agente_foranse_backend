<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('vc_usuario', 'vc_clave');

        // Realizar la consulta a la base de datos y desencriptar la contraseña
        $persona = DB::table('TbPersona')
        ->where('vc_usuario', $credentials['vc_usuario'])
        ->whereRaw("pgp_sym_decrypt(decode(vc_clave, 'base64'), 'contraseña')::text = ?", [$credentials['vc_clave']])
        ->first();

        // Si la persona no existe o las credenciales no coinciden
        if (!$persona) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        // Aquí, creamos una instancia de Eloquent
        $personaModel = Persona::with(['pais','campanaDetalle.segmento','campanaDetalle.centro.pais','campanaDetalle.campana'])->find($persona->id);


        // Generar el token JWT usando el modelo de Eloquent
        $token = JWTAuth::fromUser($personaModel);
        // Devolver el token
        //return response()->json(['token' => $token]);
        return $this->respondWithToken($token, $personaModel);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $personal)
    {
        // Extraer centros, paises y segmentos
        $centros = collect();
        $paises = collect();
        $segmentos = collect();
        $campanas = collect();

        $personal->campanaDetalle->each(function ($detalle) use ($centros, $paises, $segmentos, $campanas) {
            // Centros únicos
            if ($detalle->centro) {
                $centros->push($detalle->centro);
                // Paises únicos desde centro
                if ($detalle->centro->pais) {
                    $paises->push($detalle->centro->pais);
                }
            }
            // Segmentos únicos
            if ($detalle->segmento) {
                $segmentos->push($detalle->segmento);
            }
            // Campanas únicos
            if ($detalle->campana) {
                $campanas->push($detalle->campana);
            }
        });

        // Filtrar únicos por ID
        $centrosUnicos = $centros->unique('Id')->values();
        $paisesUnicos = $paises->unique('Id')->values();
        $segmentosUnicos = $segmentos->unique('Id')->values();
        $campanasUnicos = $campanas->unique('Id')->values();

        return response()->json(['data'=>[
            'access_token' => $token,
            'token_type' => 'bearer',
            'persona' => $personal,
            'centros' => $centrosUnicos,
            'paises' => $paisesUnicos,
            'segmentos' => $segmentosUnicos,
            'campana' => $campanasUnicos,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]]);
    }
}
