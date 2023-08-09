
<!-- Modal -->
<div class="modal fade" id="manual_update_{{ $item['id'] }}" tabindex="-1" aria-labelledby="manual_update_{{ $item['id'] }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="">{{ $item['name'] }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row" method="POST" action="" >
                <input type="hidden" name="_token" value="csrf_token().'">
                <input type="hidden" name="_method" value="PATCH">
                <div class="row">
                    <div class="col-12">
                        <p class="text-center">
                        <a href="{{ $item['permalink'] }}" target="_blank"><img src="{{ $imageSrc }}" style="width:200px;"></a>
                        </p>
                    </div>

                    <div class="col-12">
                        <p class="text-center">
                            @php
                                use Carbon\Carbon;

                                echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($item['sku'], 'C128', 3, 33, array(1, 1, 1), true) . '" alt="barcode"   />';
                                $fechaHora_creat = $item['date_created'];
                                $fechaHora_mod = $item['date_modified'];

                                $fecha_create = Carbon::parse($fechaHora_creat)->locale('es')->isoFormat('LL'); // Formato de fecha largo
                                $fecha_mod = Carbon::parse($fechaHora_mod)->locale('es')->isoFormat('LL'); // Formato de fecha largo

                                $hora_create = Carbon::parse($fechaHora_creat)->format('h:i:s A'); // Formato de hora
                                $hora_mod  = Carbon::parse($fechaHora_mod)->format('h:i:s A'); // Formato de hora

                            @endphp
                        </p>
                    </div>

                    <div class="col-6">
                        <label for="date_created" class="form-label">Fecha de Creacion</label>
                        <input type="text" class="form-control" id="date_created" name="date_created" value="{{ $fecha_create }}">
                    </div>

                    <div class="col-6">
                        <label for="date_modified" class="form-label">Hora de Creacion</label>
                        <input type="text" class="form-control" id="date_modified" name="date_modified" value="{{ $hora_create}}">
                    </div>

                    <div class="col-6">
                        <label for="date_created" class="form-label">Fecha de modificaion</label>
                        <input type="text" class="form-control" id="date_created" name="date_created" value="{{ $fecha_mod }}">
                    </div>

                    <div class="col-6">
                        <label for="date_modified" class="form-label">Hora de modificaion</label>
                        <input type="text" class="form-control" id="date_modified" name="date_modified" value="{{ $hora_mod}}">
                    </div>

                    <div class="col-12">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $item['name'] }}">
                    </div>

                    <div class="col-3">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $item['price'] }}">
                    </div>

                    <div class="col-3">
                    <label for="sale_price" class="form-label">Promoción</label>
                    <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{ $item['sale_price'] }}">
                    </div>

                    <div class="col-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku" value="{{ $item['sku'] }}.'">
                    </div>

                    <div class="col-3">
                    <label for="stock_quantity" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $item['stock_quantity'] }}">
                    </div>

                    <div class="col-6">
                    <label for="costo" class="form-label">costo</label>
                    <input type="text" class="form-control" id="costo" name="costo" value="{{ $costo }}">
                    </div>

                    <div class="col-6">
                    <label for="nombre_del_proveedor" class="form-label">Proveedor</label>
                    <input type="text" class="form-control" id="nombre_del_proveedor" name="nombre_del_proveedor" value="{{ $nombre_del_proveedor }}">
                    </div>

                    <div class="col-6">
                    <label for="id_proveedor" class="form-label">Id Prove</label>
                    <input type="text" class="form-control" id="id_proveedor" name="id_proveedor" value="{{ $id_proveedor }}">
                    </div>

                    <div class="col-6">
                    <label for="clave_mayorista" class="form-label">Mayoreo</label>
                    <input type="text" class="form-control" id="clave_mayorista" name="clave_mayorista" value="{{ $clave_mayorista }}">
                    </div>

                    <div class="col-6 mt-3">
                    <button id="save-btn" type="submit" class="btn btn-success mt-2">
                             Actualizar <i class="fa fa-save"></i>
                    </button>
                    <button type="button" class="btn btn-secondary mt-1" data-bs-dismiss="modal">
                            Cerrar <i class="fa fa-close"></i>
                    </button>
                    </div>

                    <div class="col-6 mt-3">
                    <a href="{{ route('imprimir_eticketa.create',$item['sku'])}}" target="_blank" class="btn btn-danger mt-2">
                        Imprimir <i class="fa fa-print"></i>
                    </a>
                    </div>
                </div>
            </div>
            </form>
        </div>

      </div>
    </div>
  </div>
