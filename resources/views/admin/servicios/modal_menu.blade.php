            <!-- Modal -->
            <div class="modal fade" id="modal_menu{{$servicio->id}}" tabindex="-1" aria-labelledby="modal_menu{{$servicio->id}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <a class="text_menu_icon mt-3" target="_blank" href="{{ route('taller.show', $servicio->id) }}">
                                    <i class="icon_modal_menu fas fa-eye"></i>Ver Servicios
                                </a> <br>
                                <a class="text_menu_icon mt-3" target="_blank" href="https://api.whatsapp.com/send?phone=521{{$servicio->Cliente->telefono}}&text=¡Hola%20{{$servicio->Cliente->nombre}}!%20%20👋%0ALa%20Fecha%20de%20ingreso%20📅%3A%{{$fecha_formateada}}%0ATu%20numero%20de%20Folio%20📝%3A%20%{{$servicio->folio}}%0ABicicleta🚲%20%3A%20{{$servicio->marca}}%20-{{$servicio->modelo}}%20-%20R{{$servicio->rodada}}%0A%0APodras%20ver%20el%20esatus%20de%20tu%20bicicleta%20y%20mas%20detalles%20en%20el%20siguiente%20enlace%3A%0A{{ route('taller.show', $servicio->id) }}">
                                    <i class="icon_modal_menu fab fa-whatsapp"></i>Enviar Whats
                                </a> <br>

                                <a class="text_menu_icon mt-3" href="{{ route('taller.edit',$servicio->id) }}">
                                    <i class="icon_modal_menu fas fa-edit"></i>Editar Servicio
                                </a> <br>

                                <a class="text_menu_icon mt-3" href="{{ route('imprimir.create',$servicio->id) }}">
                                    <i class="icon_modal_menu fas fa-print"></i>Imprimir Etiqueta<br>
                                </a>

                                {{-- <a class="text_menu_icon mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                    <i class="icon_modal_menu fas fa-recycle"></i>Cambiar Estatus
                                </a> <br> --}}

                                <a class="text_menu_icon mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#sku" aria-expanded="false" aria-controls="collapseWidthExample">
                                    <i class="icon_modal_menu fas fa-recycle"></i>Agregar Producto
                                </a> <br>

                                   <div class="collapse collapse-horizontal" id="sku">
                                      <div class="card card-body" style="width: auto;">
                                        <div id="reader"></div>

                                        <form method="POST" id="miFormulario" action="{{ route('product.store_product') }}" enctype="multipart/form-data" role="form">
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
                                                    <input class="form-control" type="number" name="sku" id="sku" placeholder="1234">
                                                </div>
                                                <div class="col-3">
                                                    <label class="text-dark" for="">Cantidad</label><br>
                                                    <input class="form-control" type="number" name="cantidad" id="cantidad" value="1">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" id="submitBtn" class="ladda-button btn btn-success mt-3" data-style="expand-right" style=" color: #ffff;width:100%;">
                                                        <span class="ladda-label">Enviar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                      </div>
                                    </div>

                            </div>
                        </div>
                    </div>

                        <a type="button" class="btn btn-secondary btn_close_modal" data-bs-dismiss="modal" style="">
                            <i class="fas fa-times-circle"></i>
                        </a>

                </div>
                </div>
            </div>
