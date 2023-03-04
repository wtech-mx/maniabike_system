<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear permiso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                <span aria-hidden="true">X</span>
            </button>
        </div>

        {!! Form::open(array('route' => 'permisos.store','method'=>'POST')) !!}

            <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="">Permiso</label>
                        <input type="text" placeholder="Permiso" class="form-control" name="name" id="name">
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
            </div>

        {!! Form::close() !!}

      </div>
    </div>
  </div>
