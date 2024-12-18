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
    public function index(Request $request)
    {
        //
        try {

            // Convertir las fechas al formato esperado y a UTC
            $startDate = Carbon::parse($request->inicio)->startOfDay()->timezone('UTC');
            $endDate = Carbon::parse($request->fin)->endOfDay()->timezone('UTC');

            // Obtenemos todos los registros del día actual
            $screens = ScreenEvent::whereDate('created_at', [$startDate, $endDate])->with(['tracking.campanaDetalle.persona'])->get();

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
                'in_TrackingId' => $request->in_TrackingId,
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

    public function transformarMenu(){

        $menuString = "‡#†Maestros†k-menu__link-icon flaticon-layers‡generales_copy.php†Generales†‡solicitudConvocatoria.php†Registro Convocatoria†‡plantillasaludocupacional.php†Plantilla Salud Ocupacional†‡persona.php†Registro Personal†‡pantallaBlackList.php†Registro BlackList†‡repositoriopostulante.php†Busqueda de Personal†‡convocatoriasgenerales.php†Lista Solicitudes Generales†‡detallepostulantesso.php†Solicitud Convocatoria†‡plantillasautoevaluaciones.php†Plantilla AutoEvaluacion†‡generalesfa.php†Generales F.A†‡permisosporperfil.php†Permisos por Perfil†‡solicitudreingreso.php†Solicitudes de Reingreso†‡manplantillasolicitudes.php†Mant de Plantillas para Solicitud†‡plantillaencuestacambioregimen.php†Plantilla Cuestionario†‡plantillaConvenioLaboral.php†Plantilla Convenio Laboral†‡mantgeneralesip.php†Campañas†‡#†Gestion†k-menu__link-icon flaticon-interface-7‡pendienteaprobaciongg.php†Bandeja Solicitudes Pre.Equipos - Gerencia†‡pendientespordespachar.php†Solicitud Pre.Equipos-Convocatorias†‡solicitudescapacion2.php†Lista de Solicitudes - Capacitación†‡complementar.php†Complementar Información†‡solicitudespermitidas.php†Lista de Solicitudes - Capacitación Asignadas†‡autoevaluacion.php†Autoevaluaciones†‡detallepostulantesautoevaluacion.php†Seguimiento Autoevaluacion†‡listasolicidudespendientes.php†Solicitud Pre.Equipos Pendientes†‡solicitudprestamo.php†Solicitud Pre.Equipos - Generales†‡listadoValidacionDocumentosxSolicitud.php†Solicitud Pre.Equipos Personal†‡gestiondocumentosdesolicitud.php†Complementar Solicitud†‡listadoDocumentosxSolicitudIT.php†Solicitud Pre.Equipos Personal†‡listadoValidacionDocumentos.php†Validacion Documentos - Convocatoria†‡mantAgentes.php†Busqueda Agentes†‡cargaEmasivo.php†Cargar E. Agentes†‡bajaMasivaAgentes.php†Baja Masiva - Agentes†‡Validaciones.php†Validacion Pago†‡solicitudesIngresoOperacion.php†Lista de Convocatorias para Ingreso a Operaciones†‡solicitudesGenerales.php†Generar Solicitud†‡bandejaSolicitudJefeInmediato.php†Bandeja de Solicitudes Jefe Inmediado†‡#†Reportes†k-menu__link-icon flaticon-interface-1‡reporteAfiliado.php†Reporte de Solicitudes†‡reporteconvocados.php†Reporte de Convocados†‡reporteconsolidadogrupos.php†Reporte Consolidado Grupos†‡reportedetalledocumentacion.php†Reporte Detalle Documentos†‡reportefinal.php†Reporte Final Dia0/Dia 1†‡reporteso.php†Reporte de Proceso SO†‡reporteautoevaluacion.php†Reporte de Autoevaluación†‡reporteprogramacionojt.php†Programacion OJT†‡reporteconvocatoriaIP.php†Reporte Final de Altas†‡reportecapacitacion.php†Reporte Capacitaciones†‡reporteBajas.php†Reporte de Bajas - Agentes†‡reporteAltas.php†Reporte de Altas - Agentes†‡reporteReingreso.php†Reporte de Reingreso†‡#†Graficos†k-menu__link-icon flaticon-diagram‡graficoAfiliado.php†Graficos de Solicitudes†‡graficoAfiliadoAvance.php†Grafico Afiliado Avance†‡#†WIBEST†‡wibest-pas.php†Indicadores - WIBEST†";
        $menu = [];
        $rows = explode('‡', $menuString); // Separar las filas

        $currentCategory = null;
        $currentIcon = null;
        $menuItems = [];

        foreach ($rows as $row) {
            // Verificar si es una nueva categoría
            if (strpos($row, '#†') !== false) {
                // Guardar la categoría anterior antes de procesar una nueva
                if ($currentCategory) {
                    $menu[] = [
                        'category' => $currentCategory,
                        'icon' => $currentIcon,
                        'items' => $menuItems,
                    ];
                }

                // Procesar nueva categoría
                $parts = explode('†', $row);
                //return response()->json(strpos($parts[2], 'k-menu__link-icon') !== false);
                // Determinar ícono y categoría
                if (isset($parts[1]) && strpos($parts[2], 'k-menu__link-icon') !== false) {
                    $currentIcon = $parts[2]; // Guardar ícono
                    $currentCategory = $parts[1] ?? null; // Nombre de la categoría
                } else {
                    $currentIcon = null;
                    $currentCategory = $parts[1] ?? null; // Nombre de la categoría
                }

                $menuItems = []; // Reiniciar los elementos
            } elseif (strpos($row, '†') !== false) {
                // Procesar enlaces de la categoría actual
                $parts = explode('†', $row);
                $menuItems[] = [
                    'url' => $parts[0] ?? null,
                    'text' => $parts[1] ?? null,
                ];
            }
        }

        // Agregar la última categoría procesada
        if ($currentCategory) {
            $menu[] = [
                'category' => $currentCategory,
                'icon' => $currentIcon,
                'items' => $menuItems,
            ];
        }

        return response()->json($menu);

        /* // Dividir los datos por '¥' (en tu caso parece que ya viene sin el '¥', pero puedes usarlo si lo necesitas)
        $arreglo_datos = explode('¥', $menuString);

        // Dividir el primer elemento por '‡' y filtrar los registros vacíos
        $registros = array_filter(array_map('trim', explode('‡', $arreglo_datos[0])), fn($registro) => $registro !== '');

        // Organizar los registros en cabeceras y detalles
        $menu = [];
        $currentCategory = null;

        // Recorrer los registros y agruparlos por categorías
        foreach ($registros as $registro) {
            // Dividir por el primer '†' para separar la categoría del detalle
            $parts = explode('†', $registro);

            // Verificar si el primer elemento contiene un hash (#), lo cual indicaría que es una categoría
            if (strpos($parts[0], '#') !== false) {
                // Es una categoría, la asignamos como la nueva categoría
                $currentCategory = trim($parts[0]);
                $menu[$currentCategory] = [];
            } else {
                // Si no es una categoría, lo agregamos como detalle de la categoría actual
                if ($currentCategory) {
                    $menu[$currentCategory][] = [
                        'link' => $parts[0], // El primer elemento es el link
                        'description' => $parts[1] ?? '', // El segundo elemento es la descripción
                    ];
                }
            }
        }

        // Ahora $menu contiene la estructura organizada en cabecera y detalles
        return response()->json($menu); */
    }
}
