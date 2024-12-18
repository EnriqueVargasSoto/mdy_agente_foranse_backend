<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

    $personal = Persona::where('vc_usuario', $request->vc_usuario)->with(['pais','campanaDetalle.segmento','campanaDetalle.centro.pais','campanaDetalle.campana'])->first();
        if ($personal) {
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

            // Respuesta JSON
            return response()->json([
                'usuario' => $personal,
                'centros_unicos' => $centrosUnicos,
                'paises_unicos' => $paisesUnicos,
                'segmentos_unicos' => $segmentosUnicos,
                'campanas_unicos' => $campanasUnicos
            ]);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $persona = Persona::where('in_NumDocumentoIdentidad', $id)->with(['campanaDetalle', 'frecuencia'])->first();

            return response()->json(['data' => $persona], 200);
        } catch (\ErrorException $e) {
            //throw $th;
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
