<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try {
            // Obtener el parámetro opcional de la solicitud
            $filter = $request->input('idPc'); // Cambia 'filter' al nombre del parámetro que deseas usar

            // Obtener todos los trackings o aplicar el filtro si se proporciona

            if ($filter) {
                $trackings = Tracking::when($filter, function ($query, $filter) {
                    return $query->where('idPc', $filter); // Reemplaza 'campo_a_filtrar' con el campo real de tu tabla
                })->first();
            }else{
                $trackings = Tracking::when($filter, function ($query, $filter) {
                    return $query->where('idPc', $filter); // Reemplaza 'campo_a_filtrar' con el campo real de tu tabla
                })->get();
            }


            return response()->json(['data' => $trackings], 200);
        } catch (\ErrorException $e) {
            //throw $th;
            return response()->json(['error' => $e], 500);
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
        try {
            $tracking = Tracking::create([
                'in_CampanaDetalleId' => $request->in_CampanaDetalleId,
                'sistemaOperativo' => $request->sistemaOperativo,
                'procesador' => $request->procesador,
                'ram' => $request->ram,
                'mac' => $request->mac,
                'ipPublica' => $request->ipPublica,
                'ipPrivada' => $request->ipPrivada,
                'ubicacionGeografica' => $request->ubicacionGeografica,
                'idPc' => $request->idPc,
                'nombre' => $request->name,
                'tipo' => $request->type,
                'cliente' => $request->client,
                'hostname' => $request->hostname
            ]);

            return response()->json(['data' => $tracking], 200);
        } catch (\ErrorException $e) {
            //throw $th;
            return response()->json(['error' => $e], 500);
        }
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
        $tracking = Tracking::find($id);
        $tracking->delete();

        return response(true);
    }
}
