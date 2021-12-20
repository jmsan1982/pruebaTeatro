    <div class="modal bd-example-modal-lg" id="modalEliminarCuenta">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Cuenta</h4>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="openCloseModalDelete()">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="contenidoModal" >
                    ¿Esta seguro que desea eliminar la cuenta?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <a class="btn btn-success" href="{{ route('perfil.destroy', ['id' => auth()->user()->id]) }}">Aceptar</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="openCloseModalDelete()">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
