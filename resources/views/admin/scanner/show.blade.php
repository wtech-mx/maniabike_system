@if(isset($product))

<div class="container_request_qr mb-3">
    <div class="row">
        <div class="col-12">
            <a href="{{ $product['permalink'] }}" target="_blank"><img src="{{ $product['images'][0]->src }}" style="width:100px;"></a>
            <p class="respuesta_qr_info"><strong class="strong_qr_res">Nombre:</strong>{{ $product['name'] }}</p>
            <p class="respuesta_qr_info"><strong class="strong_qr_res">Precio:</strong>{{ $product['price'] }}</p>
            <p class="respuesta_qr_info"><strong class="strong_qr_res">Promocion:</strong>{{ $product['sale_price'] }}</p>
            <p class="respuesta_qr_info"><strong class="strong_qr_res">SKU:</strong>{{ $product['sku'] }}</p>
            <p class="respuesta_qr_info"><strong class="strong_qr_res">Stock:</strong>{{ $product['stock_quantity'] }}</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_product{{ $product['id'] }}">Editar</button>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_modal_product{{ $product['id'] }}" tabindex="-1" aria-labelledby="edit_modal_product{{ $product['id'] }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$product['name']}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex justify-content-center">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Info</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Mod</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Ventas</button>
                    </li>
                  </ul>
                </div>

                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <form class="row" method="POST" action="{{route('scanner_product.edit',$product['id'])}}" >
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="col-12">
                                <p class="text-center">
                                <a href="{{$product['permalink']}}" target="_blank"><img src="{{$product['images'][0]->src}}" style="width:200px;"></a>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-center">
                                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product['sku'], 'C128', 3, 33, array(1, 1, 1), true) }}" alt="barcode" />                    </p>
                            </div>
                            <div class="col-12">
                                <p class="d-inline-flex gap-1">
                                    <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Mas Detalles
                                    </a>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body ">
                                        <div class="row">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$product['name']}}">
                            </div>
                            <div class="col-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{$product['price']}}" readonly>
                            </div>
                            <div class="col-3">
                            <label for="sale_price" class="form-label">Promoción</label>
                            <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{$product['sale_price']}}">
                            </div>
                            <div class="col-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku" value="{{$product['sku']}}">
                            </div>
                            <div class="col-3">
                            <label for="stock_quantity" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{$product['stock_quantity']}}" readonly>
                            </div>
                            <div class="col-6">
                            <label for="costo" class="form-label">costo</label>
                            <input type="text" class="form-control" id="costo" name="costo" value="{{$costo}}" readonly>
                            </div>
                            <div class="col-6">
                            <label for="nombre_del_proveedor" class="form-label">Proveedor</label>
                            <input type="text" class="form-control" id="nombre_del_proveedor" name="nombre_del_proveedor" value="{{$nombre_del_proveedor}}">
                            </div>
                            <div class="col-6">
                            <label for="id_proveedor" class="form-label">Id Prove</label>
                            <input type="text" class="form-control" id="id_proveedor" name="id_proveedor" value="{{$id_proveedor}}">
                            </div>
                            <div class="col-6">
                            <label for="clave_mayorista" class="form-label">Mayoreo</label>
                            <input type="text" class="form-control" id="clave_mayorista" name="clave_mayorista" value="{{$clave_mayorista}}" readonly>
                            </div>
                            <div class="col-3">
                                <label for="stock_quantity" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock_quantity_nuevo" name="stock_quantity_nuevo">
                            </div>
                            <div class="col-3">
                                <label for="costo" class="form-label">Costo</label>
                                <input type="text" class="form-control" id="costo_nuevo" name="costo_nuevo">
                            </div>
                            <div class="col-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="price_nuevo" name="price_nuevo">
                            </div>
                            <div class="col-3">
                                <label for="clave_mayorista" class="form-label">Mayoreo</label>
                                <input type="text" class="form-control" id="clave_mayorista_nuevo" name="clave_mayorista_nuevo">
                            </div>
                            <div class="col-7">
                            <button id="save-btn" type="submit" class="btn btn-success mt-2"> Actualizar <i class="fa fa-save"></i></button>
                            <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal" style="margin-left: 1rem;"> Cerrar <i class="fa fa-close"></i></button>
                            </div>
                            <div class="col-4">
                            <a href="{{route('imprimir_eticketa.create',$product['sku'])}}" target="_blank" class="btn btn-danger mt-2">  Imprimir <i class="fa fa-print"></i></a>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <div class="row">
                            @if (!empty($historial_stock))

                                @foreach ($historial_stock as $historial_mod)
                                    <div class="col-6" style="padding:5px;">
                                        <div class="card mb-2">
                                            @php
                                                $fecha = $historial_mod->created_at;
                                                $fecha_timestamp = strtotime($fecha);
                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);

                                            @endphp

                                            <div class="car-body p-2">
                                                <p class="text-sm">
                                                    <strong>Fecha: </strong><br> {{ $fecha_formateada }}<br>
                                                    <strong>Usuario: </strong><br> {{ $historial_mod->Usuario->name }}<br>
                                                    <strong>Cambio de: </strong><br>  {!! $historial_mod->accion !!}<br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                               <div class="col-12">
                                    <h2 class="text-center text-dark"> No hay registros</h2>
                               </div>
                            @endif

                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                        <div class="row">
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
                                            <p class="text-sm">
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
                        </div>
                    </div>
                  </div>

            </div>

        </div>
    </div>
</div>

@endif
<!-- Add the modal code here, just like in your previous code -->
