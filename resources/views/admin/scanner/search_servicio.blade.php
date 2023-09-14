    @isset($servicio)
        <div class="container_request_qr">
            <div class="row" >
                <div class="col-12">
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Folio:</strong>{{$servicio->folio}}</p>
                @php
                    $status = '';
                    switch ($servicio->estatus) {
                        case 1:
                            $status = 'Procesando';
                            break;
                        case 2:
                            $status = 'En Espera';
                            break;
                        case 3:
                            $status = 'Realizado';
                            break;
                        case 4:
                            $status = 'Cancelado';
                            break;
                        case 0:
                            $status = 'R ingresado';
                            break;
                        case 5:
                            $status = 'Pagado';
                            break;
                        // Puedes manejar un caso predeterminado si el valor no coincide con ninguno de los anteriores
                        default:
                            $status = 'Desconocido';
                            break;
                    }
                @endphp
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Estatus:</strong> {{ $status }}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Cliente:</strong>{{$servicio->Cliente->nombre}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Telefono:</strong><a href="https://api.whatsapp.com/send?phone=521{{$servicio->Cliente->telefono}}"></a>{{$servicio->Cliente->telefono}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Fecha:</strong>{{$servicio->fecha}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Bicicleta:</strong>  {{$servicio->marca}} ' - ' {{$servicio->modelo}}' - ' {{$servicio->rodada}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Observaciones:</strong>{{$servicio->observaciones}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Precio del servicio:</strong>{{$servicio->precio_servicio}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Saldo a favor:</strong>${{$servicio->subtoral}}.0</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Total:</strong>${{$servicio->total}}.0</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_service{{$servicio->id}}">
                    <i class="icon_modal_menu fa fa-pencil"></i>  Editar
                </button>
                    <a class="btn btn-secondary" href="{{ route('imprimir.create',$servicio->id) }}">
                        <i class="icon_modal_menu fas fa-print"></i> Imprimir Etiqueta<br>
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_modal_service{{$servicio->id}}" tabindex="-1" aria-labelledby="edit_modal_service{{$servicio->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $servicio->Cliente->nombre }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
            <div class="modal-body">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Info.</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Subir Productos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Resumen</button>
                    </li>
                  </ul>

                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <form class="row" method="POST" action="{{route('scanner_servicio.edit', $servicio->id)}}" >
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="col-12">
                                {{-- <p class="text-center">
                                <img src="{{asset('fotos_bicis/'.$servicio->foto1)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$servicio->foto2)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$servicio->foto3)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$servicio->foto4)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;">
                                </p> --}}
                            </div>
                            <div class="col-12">
                            <label for="name" class="form-label">Estatus</label>

                            <select class="form-select" name="estado">
                                @foreach(['1' => 'Procesando', '2' => 'En Espera', '3' => 'Realizado', '4' => 'Cancelado', '0' => 'R ingresado', '5' => 'Pagado'] as $value => $label)
                                <option value="{{ $value }}" @if($servicio->estatus == $value) selected @endif>{{ $label }}</option>
                                @endforeach
                                <option value="1">Procesando</option>
                                <option value="2">En Espera</option>
                                <option value="3">Realizado</option>
                                <option value="4">Cancelado</option>
                                <option value="0">R ingresado</option>
                                <option value="5">Pagado</option>
                            </select>

                            </div>
                            <div class="col-4">
                            <label for="price" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" value="{{$servicio->marca}}">
                            </div>
                            <div class="col-4">
                            <label for="sale_price" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="{{$servicio->modelo}}">
                            </div>
                            <div class="col-4">
                            <label for="sku" class="form-label">Rodada</label>
                            <input type="text" class="form-control" id="rodada" name="rodada" value="{{$servicio->rodada}}">
                            </div>
                            <div class="col-4">
                            <label for="Costo del servicio" class="form-label">Precio del servicio</label>
                            <input type="number" class="form-control" id="precio_servicio" name="precio_servicio" value="{{$servicio->precio_servicio}}">
                            </div>
                            <div class="col-4">
                            <label for="Saldo a Favor" class="form-label">Saldo a Favor</label>
                            <input type="number" disabled class="form-control" id="subtotal" name="subtotal" value="{{$servicio->subtotal}}">
                            </div>
                            <div class="col-4">
                            <label for="Total" class="form-label">Total</label>
                            <input type="number" class="form-control" id="total" name="total" value="{{$servicio->total}}">
                            </div>
                            <button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <form method="POST" id="miFormulario" action="{{route('product.store_product', $servicio->id)}}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="id" id="id" value="{{$servicio->id}}">
                            <input type="hidden" name="folio" id="folio" value="{{$servicio->folio}}">
                            <div class="row">
                                <div class="col-12">
                                    <label class="text-dark" for="">Ingresa el o los productos para el servicio</label><br>
                                    <label class="text-dark">Medio Servicio : 23431 <br>Servicio Completo : 61534 <br>Nivelada : 19328 <br>Parche : 29117 <br>Ajuste/Camio de frenos : 29548 <br></label>
                                </div>
                                <div class="col-9">
                                    <label class="text-dark" for="">Sku</label><br>
                                    <input class="form-control" type="number" name="sku[]" placeholder="1234">
                                </div>
                                <div class="col-3">
                                    <label class="text-dark" for="">Cantidad</label><br>
                                    <input class="form-control" type="number" name="cantidad[]" value="1">
                                </div>
                                <div id="productInputs"></div>

                                <div class="col-12">
                                    <button type="button" id="addInput" class="btn btn-primary mt-3">
                                        Agregar Producto <i class=" fa fa-plus"></i>
                                    </button>
                                    <button type="submit" id="submitBtn" class="ladda-button btn btn-success mt-3" data-style="expand-right" style="color: #ffff;width:100%;">
                                        <span class="ladda-label">Cargar producto <i class=" fa fa-save"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>


                        <!-- Agrega jQuery si aún no lo has hecho -->

                        <script>
                            $(document).ready(function() {
                                var maxInputs = 10; // Número máximo de campos de entrada
                                var wrapper = $("#productInputs"); // Contenedor de los campos de entrada
                                var addButton = $("#addInput"); // Botón para agregar campos

                                var x = 1; // Inicializa el contador de campos

                                // Función para agregar campos de entrada
                                $(addButton).click(function(e) {
                                    e.preventDefault();
                                    if (x < maxInputs) {
                                        // Agregar campos de entrada para SKU y Cantidad con botón de eliminar
                                        $(wrapper).append(`
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    <input class="form-control" type="number" name="sku[]" placeholder="1234">
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-control" type="number" name="cantidad[]" value="1">
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="btn btn-danger btn-remove">  <i class=" fas fa-trash"></i> </button>
                                                </div>
                                            </div>
                                        `);
                                        x++; // Incrementar el contador
                                    }
                                });

                                // Función para eliminar campos de entrada
                                $(wrapper).on("click", ".btn-remove", function(e) {
                                    e.preventDefault();
                                    $(this).closest('.row').remove(); // Eliminar el contenedor más cercano
                                    x--; // Decrementar el contador
                                });
                            });
                        </script>


                    </div>

                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                        <div class="d-flex ">
                            <div class="row">
                                {{-- D A T O S  G E N E R A L E S --}}
                                    <div class="col-12 mt-2 mb-3" style="color: #0dcaf0">
                                        <strong>Datos Generales</strong>
                                    </div>
                                    <div class="col-4" style="color: #2dce89">
                                        Nombre
                                    </div>
                                    <div class="col-4" style="color: #2dce89">
                                        Telefono
                                    </div>
                                    <div class="col-4" style="color: #2dce89">
                                        Fecha Ing.
                                    </div>
                                    <div class="col-4" style="font-size: 13px;">
                                        {{$servicio->Cliente->nombre}}
                                    </div>
                                    <div class="col-4" style="font-size: 13px;">
                                        {{$servicio->Cliente->telefono}}
                                    </div>
                                    <div class="col-4" style="font-size: 13px;">
                                        {{$servicio->fecha}}
                                    </div>

                                    <div class="col-4 mt-3" style="color: #2dce89">
                                        Servicio
                                    </div>
                                    <div class="col-4 mt-3" style="color: #2dce89">
                                        Folio
                                    </div>
                                    <div class="col-4 mt-3" style="color: #2dce89">
                                        Estatus
                                    </div>
                                    <div class="col-4"  style="font-size: 13px;">
                                        {{$servicio->servicio}}
                                    </div>
                                    <div class="col-4" style="font-size: 13px;">
                                        {{$servicio->folio}}
                                    </div>
                                    <div class="col-4" style="font-size: 13px;">
                                        {{$servicio->estatus}}
                                    </div>
                                {{-- E N D  D A T O S  G E N E R A L E S --}}

                                {{-- D A T O S  P R O D U C T O S --}}
                                    <hr class="mt-3 mb-3" style="background-color: #0dcaf0; height: 5px;">

                                    <div class="col-12 mt-2 mb-3" style="color: #0dcaf0">
                                        <strong>Componentes</strong>
                                    </div>
                                    <div class="col-2 mt-3" style="color: #2dce89">
                                        sku
                                    </div>
                                    <div class="col-6 mt-3" style="color: #2dce89">
                                        Producto
                                    </div>
                                    <div class="col-4 mt-3" style="color: #2dce89">
                                        Precio
                                    </div>
                                    @php $suma=0; @endphp
                                    @if(!empty($servicio->TallerProductos->id ))
                                        @foreach ($taller_productos as $taller_producto)
                                            @if($taller_producto->id_taller == $servicio->id)
                                            <div class="col-2 mb-2">
                                                <p class="text-dark" style="font-size: 11px;">{{$taller_producto->sku}}</p>
                                            </div>
                                            <div class="col-6 mb-2">
                                               <a class="text-dark" style="font-size: 11px;" href="{{$taller_producto->permalink}}" target="_blank">
                                                {{$taller_producto->producto}}
                                               </a>
                                            </div>
                                            <div class="col-4 mb-2 text-dark" >
                                                <form action="{{ route('taller.precio_product', $taller_producto->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    {{-- <input type="hidden" value="{{$taller_producto->id}}"> --}}
                                                    <input type="number" id="price" name="price" value="{{$taller_producto->price}}" style="width: 50px;background: #fff;border-radius: 10px;border: solid 3px transparent;">
                                                    <button type="submit" style="background: transparent;border: solid 1px transparent;padding: 0;">
                                                        <img style="width:25px" src="{{ asset('assets/admin/img/icons/disquete.png') }}" alt="">
                                                    </button>
                                                </form>
                                                <form action="{{ route('products_taller.destroy', $taller_producto->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="background: transparent;border: solid 1px transparent;padding: 0;">
                                                            <img style="width:25px" src="{{ asset('assets/admin/img/icons/bote-de-basura.png') }}" alt="">
                                                        </button>
                                                </form>
                                            </div>
                                            @php $suma+=$taller_producto->price @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                {{-- E N D  D A T O S  P R O D U C T O S --}}
                                <hr class="mt-3 mb-3" style="background-color: #0dcaf0; height: 5px;">
                                {{-- D A T O S  T O T A L --}}
                                    <div class="col-12 mt-2 mb-3" style="color: #0dcaf0">
                                        <strong>Total Sugerido</strong>
                                    </div>
                                    <div class="col-10 mt-3" style="color: #2dce89">
                                        Servicio
                                    </div>
                                    <div class="col-2 text-dark">
                                        <form action="{{ route('taller.precio_servicio', $servicio->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            {{-- <input type="hidden" value="{{$taller_producto->id}}"> --}}
                                            <input type="number" id="precio_servicio" name="precio_servicio" value="{{$servicio->precio_servicio}}" style="width: 50px;
                                                background: #fff;
                                                border-radius: 10px;
                                                border: solid 3px transparent;">
                                            <button type="submit" style="background: transparent;border: solid 1px transparent;">
                                                <img style="width:25px" src="{{ asset('assets/admin/img/icons/disquete.png') }}" alt="">
                                            </button>
                                        </form>                                        </div>
                                    <div class="col-10 mt-3" style="color: #2dce89">
                                        Componentes
                                    </div>
                                    <div class="col-2 text-dark">
                                        ${{$suma}}
                                    </div>
                                    <div class="col-10 mt-3" style="color: #2dce89">
                                        SubTotal
                                    </div>
                                    @php $subtotal=$suma + $servicio->precio_servicio @endphp
                                    <div class="col-2 text-dark">
                                        <input type="text" value="{{$subtotal}}" style="width: 50px;
                                        background: #fff;
                                        border-radius: 10px;
                                        border: solid 3px transparent;">
                                    </div>
                                    <div class="col-10 mt-3" style="color: #2dce89">
                                        Total
                                    </div>
                                    @php $total=$subtotal - $servicio->subtotal @endphp
                                    <div class="col-2 text-dark">
                                        <input type="text" value="{{$total}}" style="width: 50px;
                                        background: #fff;
                                        border-radius: 10px;
                                        border: solid 3px transparent;" disabled>
                                    </div>
                                {{-- E N D  D A T O S  T O T A L --}}
                            </div>
                        </div>
                    </div>
                  </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
        </div>
        </div>
    @endisset
