@if(session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
@if(session('idButacaWrong'))
    <div class="alert alert-danger">
        {{ session('idButacaWrong') }}
    </div>
@endif
@if(session('fechaNoSeleccionada'))
    <div class="alert alert-danger">
        {{ session('fechaNoSeleccionada') }}
    </div>
@endif
