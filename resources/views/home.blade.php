@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes/message')
                <div class="card">
                    <div class="card-header text-center">Reserva tu butaca</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-center">
                            <div class="col-md-12">
                                <form method="GET" action="{{route('reservas.index')}}">
                                    @csrf
                                    <label for="fecha">Dia reserva:</label>
                                    <input type="date" id="fechaReserva" name ="fecha" value="{{ old('fecha') }}" onchange="disponibilidad()">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success">Disponibilidad</button>
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
