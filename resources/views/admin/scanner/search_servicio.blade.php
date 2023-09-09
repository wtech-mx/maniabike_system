    @isset($products)
        <div class="container_request_qr">
            <div class="row" >
                <div class="col-12">
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Folio:</strong>{{$products->folio}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Estatus:</strong>{{$products->estatus}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Cliente:</strong>{{$products->Cliente->nombre}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Telefono:</strong><a href="https://api.whatsapp.com/send?phone=521{{$products->Cliente->telefono}}"></a>{{$products->Cliente->telefono}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Fecha:</strong>{{$products->fecha}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Bicicleta:</strong>  {{$products->marca}} ' - ' {{$products->modelo}}' - ' {{$products->rodada}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Observaciones:</strong>{{$products->observaciones}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Precio del servicio:</strong>{{$products->precio_servicio}}</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Saldo a favor:</strong>${{$products->subtoral}}.0</p>
                <p class="respuesta_qr_info"><strong class="strong_qr_res">Total:</strong>${{$products->total}}.0</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_service{{$products->id}}">
                    <i class="icon_modal_menu fa fa-pencil"></i>  Editar
                </button>
                    <a class="btn btn-secondary" href="{{ route('imprimir.create',$products->id) }}">
                        <i class="icon_modal_menu fas fa-print"></i> Imprimir Etiqueta<br>
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_modal_service{{$products->id}}" tabindex="-1" aria-labelledby="edit_modal_service{{$products->id}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $products->Cliente->nombre }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Informacion</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Carga de productos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Resumen</button>
                    </li>
                  </ul>

                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <form class="row" method="POST" action="{{route('scanner_servicio.edit', $products->id)}}" >
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="col-12">
                                {{-- <p class="text-center">
                                <img src="{{asset('fotos_bicis/'.$products->foto1)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$products->foto2)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$products->foto3)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="{{asset('fotos_bicis/'.$products->foto4)}}" style="width:90px;border-radius: 19px; margin-top: 1rem;">
                                </p> --}}
                            </div>
                            <div class="col-12">
                            <label for="name" class="form-label">Estatus</label>
                            <select class="form-select" name="estado">
                                <option selected >{{ $products->estatus }}</option>
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
                            <input type="text" class="form-control" id="marca" name="marca" value="{{$products->marca}}">
                            </div>
                            <div class="col-4">
                            <label for="sale_price" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="{{$products->modelo}}">
                            </div>
                            <div class="col-4">
                            <label for="sku" class="form-label">Rodada</label>
                            <input type="text" class="form-control" id="rodada" name="rodada" value="{{$products->rodada}}">
                            </div>
                            <div class="col-4">
                            <label for="Costo del servicio" class="form-label">Precio del servicio</label>
                            <input type="number" class="form-control" id="precio_servicio" name="precio_servicio" value="{{$products->precio_servicio}}">
                            </div>
                            <div class="col-4">
                            <label for="Saldo a Favor" class="form-label">Saldo a Favor</label>
                            <input type="number" disabled class="form-control" id="subtotal" name="subtotal" value="{{$products->subtotal}}">
                            </div>
                            <div class="col-4">
                            <label for="Total" class="form-label">Total</label>
                            <input type="number" class="form-control" id="total" name="total" value="{{$products->total}}">
                            </div>
                            <button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <form method="POST" id="miFormulario" action="{{route('product.store_product', $products->id)}}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="id" id="id" value="{{$products->id}}">
                            <input type="hidden" name="folio" id="folio" value="{{$products->folio}}">
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
                                        Agregar Producto
                                    </button>
                                    <button type="submit" id="submitBtn" class="ladda-button btn btn-success mt-3" data-style="expand-right" style="color: #ffff;width:100%;">
                                        <span class="ladda-label">Cargar producto</span>
                                    </button>
                                </div>
                            </div>
                        </form>


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
                                        // Agregar campos de entrada para SKU y Cantidad
                                        $(wrapper).append(`
                                            <div class="row mt-3">
                                                <div class="col-9">
                                                    <input class="form-control" type="number" name="sku[]" placeholder="1234">
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-control" type="number" name="cantidad[]" value="1">
                                                </div>
                                            </div>
                                        `);
                                        x++; // Incrementar el contador
                                    }
                                });
                            });
                        </script>

                    </div>

                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

                    </div>
                  </div>




            </div>
        </div>
        </div>
    @endisset
