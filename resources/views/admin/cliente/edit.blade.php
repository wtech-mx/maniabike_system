<!-- Modal -->
<div class="modal fade" id="editClientModal{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="editClientModal{{$client->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editDataModalLabel">Editar Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                <span aria-hidden="true">X</span>
            </button>
        </div>
        <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required value="{{$client->nombre}}">
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="phone">Telefono</label>
                        <input id="telefono" name="telefono" type="number" class="form-control" placeholder="Telefono" required value="{{$client->telefono}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Correo" required value="{{$client->email}}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn close-btn" data-dismiss="modal" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
