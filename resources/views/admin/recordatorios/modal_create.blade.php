<!-- Modal -->
<div class="modal fade" id="recordatorio" tabindex="-1" aria-labelledby="recordatorioLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="recordatorioLabel">Crear Recordatorio</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="" action="{{ route('recordatorios.create') }}" method="POST">
            @csrf
            <div class="modal-body row">
                <div class="col-12 form-group ">
                    <label for="">Cliente</label>
                    <input class="form-control" type="text" name="cliente" id="cliente">
                </div>

                <div class="col-6 form-group ">
                    <label for="">Fecha</label>
                    <input class="form-control" type="date" name="fecha" id="fecha" value="{{ $fechaActual }}" readonly>
                </div>

                <div class="col-6 form-group ">
                    <label for="">Estatus</label>
                    <select class="form-control" name="estatus" id="estatus">
                        <option value="En espera">En espera</option>
                        <option value="No hay Piezas">No hay Piezas</option>
                        <option value="Urgente">Urgente</option>
                        <option value="Realizado">Realizado</option>
                    </select>
                </div>

                <div class="col-12 form-group ">
                    <label for="">Descripccion</label>
                    <textarea  class="form-control" name="descripcion" id="descripcion"  cols="10" rows="5"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>

      </div>
    </div>
  </div>
