@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes/message')
                <div class="card">
                    <div class="card-header">Reserva tu butaca
                        <a class="float-end" href="{{ route('home') }}">Realizar Reserva</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-center">
                            @if(!empty($reservas))
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Butacas</th>
                                        <th scope="col">Modificar / Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reservas as $reserva)
                                        <tr>
                                            <td>{{date("d-m-Y", strtotime($reserva->fecha))}}</td>
                                            <td>{{$reserva->butacas}}</td>
                                            <td>
                                                <a href="" class="btn btn-success btn-sm">
                                                    <i class='fas fa-edit fa-lg'></i>
                                                </a>
                                                /
                                                <a href="" class="btn btn-danger btn-sm">
                                                    <i class='fas fa-trash-alt fa-lg'></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-success">
                                    No hay reservas aun
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
