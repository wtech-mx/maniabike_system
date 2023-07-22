<!-- Modal -->
<div class="modal fade" id="recordatorio_{{$recordatorio->id}}" tabindex="-1" aria-labelledby="_{{$recordatorio->id}}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="recordatorioLabel">Crear Recordatorio</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="" action="{{ route('recordatorios.edit', $recordatorio->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-body row">
                <div class="col-12 form-group ">
                    <label for="">Cliente</label>
                    <input class="form-control" type="text" name="cliente" id="cliente"  value="{{$recordatorio->cliente}}">
                </div>

                <div class="col-6 form-group ">
                    <label for="">Fecha</label>
                    <input class="form-control" type="date" name="fecha" id="fecha" value="{{$recordatorio->fecha}}">
                </div>

                <div class="col-6 form-group ">
                    <label for="">Estatus</label>
                    <select class="form-control" name="estatus" id="estatus">
                        <option selected>{{$recordatorio->estatus}}</option>
                        <option value="En espera">En espera</option>
                        <option value="No hay Piezas">No hay Piezas</option>
                        <option value="Urgente">Urgente</option>
                        <option value="Realizado">Realizado</option>
                    </select>
                </div>

                <div class="col-12 form-group ">
                    <label for="">Descripccion</label>
                    <textarea  class="form-control" name="descripcion" id="descripcion"  cols="10" rows="5">{{$recordatorio->descripcion}}</textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>

      </div>
    </div>
  </div>
