<?php

namespace App\Http\Controllers;

use App\Models\Butaca;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            return redirect()->route('home')->with([
                'messageWrong' => 'Debe seleccionar al menos una butaca'
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
        $reserva->ids_butaca = implode(',', $butacasACrear);
        $reserva->fecha = '21-11-2021';
        $reserva->numero_personas = 2;
        $reserva->save();

        return redirect()->route('home')->with([
           'message' => 'Reserva guardada correctamente'
        ]);

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
