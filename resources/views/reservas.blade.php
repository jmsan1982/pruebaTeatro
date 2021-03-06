@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes/message')
                <div class="card">
                    <div class="card-header">Reserva tu butaca
                    @include('verReservasA')
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-center">
                            <div class="col-md-12">
                                <form method="POST" action="{{isset($update) ? route($update) : route('reservas.store')}}">
                                    @csrf
                                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="fecha" value="{{$fechaReserva}}">
                                    @if(isset($update))
                                        <input type="hidden" name="idReserva" value="{{$idReserva}}">
                                    @endif
                                    @foreach($filas as $fila)
                                        <div class="row">

                                            Fila {{$fila}}
                                            @foreach($columnas as $columna)
                                                <div class="col-md-1">
                                                    {{$fila}}{{$columna}}
                                                    @if(array_search($fila . $columna, $butacas) === false)
                                                        <img src="{{url('images/bvacia.jpg')}}" height="50px" width="50px">
                                                        <input type="checkbox" name="id_butaca[]"
                                                               value="{{$fila}}{{$columna}}">
                                                    @else
                                                        <img src="{{url('images/breservada.jpg')}}" height="50px" width="50px">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success">Reservar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
