
<!-- Modal -->
<div class="modal fade" id="manual_update_{{ $item['id'] }}" tabindex="-1" aria-labelledby="manual_update_{{ $item['id'] }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="">{{ $item['name'] }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="d-flex justify-content-center">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-info-pro-tab_{{ $item['id'] }}" data-bs-toggle="pill" data-bs-target="#pills-info-pro_{{ $item['id'] }}" type="button" role="tab" aria-controls="pills-info-pro_{{ $item['id'] }}" aria-selected="true">Info</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-historial-pro-tab_{{ $item['id'] }}" data-bs-toggle="pill" data-bs-target="#pills-historial-pro_{{ $item['id'] }}" type="button" role="tab" aria-controls="pills-historial-pro_{{ $item['id'] }}" aria-selected="false">Historial</button>
                    </li>
                </ul>

            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-info-pro_{{ $item['id'] }}" role="tabpanel" aria-labelledby="pills-info-pro-tab_{{ $item['id'] }}">

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
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-historial-pro_{{ $item['id'] }}" role="tabpanel" aria-labelledby="pills-historial-pro-tab_{{ $item['id'] }}">
                        @php

                            use App\Models\TallerProductos;
                            use App\Models\ProductoNota;

                            $historial_productos_servicios = TallerProductos::where('sku', '=', $item['sku'])->get();
                            $historial_productos = ProductoNota::where('id_product_woo', '=', $item['id'])->get();

                            $mergedCollection = $historial_productos_servicios->concat($historial_productos);
                        @endphp

                        <div class="row">
                            @if ($mergedCollection->isEmpty())
                                <p class="text-center text-dark">No hay registros disponibles.</p>
                            @else
                            @foreach ($mergedCollection as $historial_producto)
                                <div class="col-6" style="padding:5px;">
                                    <div class="card mb-2">


                                        @if (!empty($historial_producto->Nota->created_at))

                                        @php
                                            $fecha = $historial_producto->Nota->created_at;
                                            $fecha_timestamp = strtotime($fecha);
                                            $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                        @endphp

                                        <div class="car-body p-2">
                                            @php
                                                $fecha = $historial_producto->Nota->created_at;
                                                $fecha_timestamp = strtotime($fecha);
                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                            @endphp
                                            <p class="text-sm text-dark">
                                                <strong>Nota: </strong>
                                                <a href="{{ route('notas.edit', $historial_producto->id_nota) }}" target="_blank" style="text-decoration: underline;">
                                                        {{ $historial_producto->id_nota }}
                                                </a><br>
                                                <strong>Fecha: </strong><br> {{ $fecha_formateada }}<br>
                                                <strong>Cantidad: </strong>{{ $historial_producto->cantidad }}<br>
                                                <strong>Precio:</strong> {{ $historial_producto->subtotal }}<br>
                                                <strong>Cajero:</strong>
                                                @if (!empty($historial_producto->Nota->Usuario->name))
                                                        {{ $historial_producto->Nota->Usuario->name }}
                                                    @else
                                                    <strong>Sin Cajero</strong>
                                                @endif
                                            </p>
                                        </div>

                                        @else

                                        <div class="car-body p-2" style="background-color: #003249;border-radius: 10px;">
                                            @php
                                                $fecha = $historial_producto->Taller->fecha;
                                                $fecha_timestamp = strtotime($fecha);
                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                            @endphp
                                            <p class="text-sm text-white">
                                                <strong>Folio: </strong>{{ $historial_producto->Taller->folio }} <br>
                                                <strong>Cantidad: </strong>1<br>
                                                <strong>Fecha: </strong> <br> {{ $fecha_formateada }} <br>
                                                <strong>Precio:</strong>{{ $historial_producto->price }}<br>
                                                <strong>Bici:</strong>{{ $historial_producto->Taller->marca }} {{ $historial_producto->Taller->modelo }} <br>
                                            </p>
                                        </div>

                                        @endif
                                    </div>

                                </div>
                            @endforeach
                            @endif
                        </div>
                </div>
            </div>


        </div>

      </div>
    </div>
  </div>
