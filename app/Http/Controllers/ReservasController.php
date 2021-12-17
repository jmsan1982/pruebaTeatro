<?php

namespace App\Http\Controllers;

use App\Models\Butaca;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ReservasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (is_null($request->fecha) || empty($request->fecha)){
            return redirect()->route('home')->with([
                'fechaNoSeleccionada' => 'Debe seleccionar al menos una fecha'
            ]);
        }



        $fechaReserva = $request->fecha;
        $reservas = Reserva::where('fecha', $fechaReserva)->get();

        foreach ($reservas as $reserva){

        }


        $data['fechaReserva'] = $request->fecha;
        $data['filas'] = range('A', 'E');
        $data['columnas'] = range(0,9);
        return view('reservas')->with($data);
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
        if (is_null($request->id_butaca) || empty($request->id_butaca)){
            return redirect()->route('reservas')->with([
                'idButacaWrong' => 'Debe seleccionar al menos una butaca'
            ]);
        }

        $this->validate($request, [
            'id_butaca' => 'array'
        ]);

        $ids_butacas = [];

        $butacasACrear = $request->id_butaca;

        foreach ($butacasACrear as $butaca){
           $id_butaca =  $this->guardarButaca($butaca);
           array_push($ids_butacas, $id_butaca);
        }

        $reserva = new Reserva();
        $reserva->id_user = $request->id_user;
        $reserva->ids_butaca = implode(',',$ids_butacas);
        $reserva->fecha = date('d-m-Y', strtotime($request->fecha));
        $reserva->numero_personas = count($request->id_butaca);
        $reserva->save();

        $logName = storage_path() . '\logs\reservasLog.txt';
        File::append($logName,
            "Id reserva: " . $reserva->id . ", Asientos: " . $reserva->ids_butaca . ", Fecha: " . $reserva->fecha .
            ", Nº Personas: " . $reserva->numero_personas . PHP_EOL
        );

        return redirect()->route('home')->with([
           'message' => 'Reserva guardada correctamente'
        ]);

    }

    public function comprobarButacas($fecha){
        Log::debug("llega");
        Log::debug($fecha);
        return view('prueba');
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

    private function guardarButaca($ids_butacas){
        //separo fila de columna
        $arrayButaca = str_split($ids_butacas);

        //guardo un registro por butaca seleccionada
        $butaca = new Butaca();
        $butaca->fila = $arrayButaca[0];
        $butaca->columna = $arrayButaca[1];
        $butaca->save();

        return $butaca->id;
    }
}
