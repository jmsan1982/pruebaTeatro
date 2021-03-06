<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $fechaReserva = $request->fecha . ' 00:00:00' ;

        $fecha_actual = date("Y-m-d");

        if (strtotime($fecha_actual) > strtotime($request->fecha)){
            return redirect()->route('home')->with([
                'fechaNoSeleccionada' => 'La fecha elegida es menor que la actual, seleccione otra fecha'
            ]);
        }

        $reserva = Reserva::where('fecha', $fechaReserva)
            ->where('id_user', $request->id_user)->first();

        if (isset($reserva->id)){
            return redirect()->route('home')->with([
                'fechaNoSeleccionada' => 'Ya tiene una reserva en esa fecha, modifique la existente'
            ]);
        }

        $reservas = Reserva::where('fecha', $fechaReserva)->get();

        $butacas = [];

        foreach ($reservas as $reserva){
            $butacasArray = explode(",", $reserva->butacas);
            foreach ($butacasArray as $butacaArray){
                array_push($butacas, $butacaArray);
            }
        }

        $data['butacas'] = $butacas;
        $data['fechaReserva'] = $request->fecha;
        $data['filas'] = range('A', 'E');
        $data['columnas'] = range(0,9);
        return view('reservas')->with($data);
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
            return redirect()->route('home')->with([
                'idButacaWrong' => 'Debe seleccionar al menos una butaca',
            ]);
        }

        $this->validate($request, [
            'id_butaca' => 'array'
        ]);

        $reserva = new Reserva();
        $reserva->id_user = $request->id_user;
        $reserva->fecha = date('d-m-Y', strtotime($request->fecha));
        $reserva->numero_personas = count($request->id_butaca);
        $reserva->butacas = implode(',',$request->id_butaca);
        $reserva->save();

        $logName = storage_path() . '\logs\reservasLog.txt';
        File::append($logName,
            "Id reserva: " . $reserva->id . ", Asientos: " . $reserva->ids_butaca . ", Fecha: " . $reserva->fecha .
            ", N?? Personas: " . $reserva->numero_personas . PHP_EOL
        );

        return redirect()->route('home')->with([
           'message' => 'Reserva guardada correctamente'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservas = Reserva::where('id_user', $id)->get();

        if (empty($reservas)){
            $data['reservas'] = null;
        }else{
            $data['reservas'] = $reservas;
        }

        return view('verReservas')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $reserva = Reserva::find($id);
        $reservas = Reserva::where('fecha', $reserva->fecha)->get();

        $butacas = [];

        foreach ($reservas as $reserva){
            $butacasArray = explode(",", $reserva->butacas);
            foreach ($butacasArray as $butacaArray){
                array_push($butacas, $butacaArray);
            }
        }

        $data['butacas'] = $butacas;
        $data['idReserva'] = $reserva->id;
        $data['fechaReserva'] = $reserva->fecha;
        $data['filas'] = range('A', 'E');
        $data['columnas'] = range(0,9);
        $data['update'] = 'reservas.actualizar';

        return view('reservas')->with($data);
    }

    public function updateReserva(Request $request)
    {
        if (is_null($request->id_butaca) || empty($request->id_butaca)){
            return redirect()->route('reservas')->with([
                'idButacaWrong' => 'Debe seleccionar al menos una butaca'
            ]);
        }

        $this->validate($request, [
            'id_butaca' => 'array'
        ]);

        $reserva = Reserva::find($request->idReserva);
        $reserva->id_user = $request->id_user;
        $reserva->fecha = date('d-m-Y', strtotime($request->fecha));
        $reserva->numero_personas = count($request->id_butaca);
        $reserva->butacas = implode(',',$request->id_butaca);
        $reserva->update();

        return redirect()->route('home')->with([
            'message' => 'Reserva modificada correctamente'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarReserva($id)
    {
        $reserva = Reserva::find($id);
        $reserva->delete();

        return redirect()->route('home')->with([
            'message' => 'Reserva Eliminada correctamente'
        ]);
    }
}
