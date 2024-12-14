<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScreenEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ScreenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            // Obtenemos todos los registros del día actual
            $screens = ScreenEvent::whereDate('created_at', Carbon::today('UTC'))->get();

            // Agrupamos los datos por hora
            $groupedScreens = $screens->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->setTimezone('America/Lima')->format('H:00'); // Agrupamos por hora en formato "HH:00"
            });

            // Construimos el listado con solo las horas que tienen registros
            $result = $groupedScreens->map(function ($items, $hour) {
                return [
                    'hour' => $hour,
                    'screens' => $items // Incluimos los registros correspondientes
                ];
            })->values(); // Reseteamos las claves para que el resultado sea un array numérico

            return response()->json(['data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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
        try {
            $screens = ScreenEvent::all();

            return response()->json(['data' => $screens], 200);
        } catch (\ErrorException $e) {
            //throw $th;
            return response()->json(['error' => $e], 500);
        }
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
            $acreen = ScreenEvent::create([
                'idTracking' => $request->idTracking,
                'objectName' => $request->key,
                'url' => $request->url

            ]);

            return response()->json(['data' => $acreen], 200);
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
    }
}
