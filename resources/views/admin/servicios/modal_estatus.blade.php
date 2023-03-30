<div class="modal fade" id="modal_estatus{{$servicio->id}}" tabindex="-1" aria-labelledby="modal_estatus{{$servicio->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <div class="modal-body" style="background-color: #003249">

                                  <p class="text-center"><strong>Cambiar Estatus</strong></p>

                                      <form method="POST" action="{{ route('taller.edit_status', $servicio->id) }}" enctype="multipart/form-data" role="form">
                                          @csrf
                                          <input type="hidden" name="_method" value="PATCH">

                                          <div class="row m-0 ">
                                              <div class="col-12">

                                            @if ($servicio->estatus == 'Procesando' )
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Ingresado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="0" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 ">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="3" id="estatus">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="4" id="estatus">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="1" id="estatus" checked>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="2" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="5" id="estatus" >
                                                </div>
                                            </div>

                                            @elseif ($servicio->estatus == 'En Espera')
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Ingresado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="0" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 ">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="3" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="4" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="1" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="2" id="estatus" checked>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="5" id="estatus" >
                                                </div>
                                            </div>

                                            @elseif ($servicio->estatus == 'Pagado')
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Ingresado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="0" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 ">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="3" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="4" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="1" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="2" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="5" id="estatus" checked>
                                                </div>
                                            </div>


                                            @elseif ($servicio->estatus == 'Realizado')
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="5" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Ingresado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="0" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 ">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="3" id="estatus" checked>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="4" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="1" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="2" id="estatus">
                                                </div>
                                            </div>

                                            @elseif ($servicio->estatus == 'Cancelado')
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="5" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Ingresado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="0" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 ">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="3" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="4" id="estatus" checked>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="1" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="2" id="estatus" >
                                                </div>
                                            </div>

                                            @elseif ($servicio->estatus == 'R ingresado')
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="5" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Ingresado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/lista-de-verificacion.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="0" id="estatus" checked>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 ">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="3" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="4" id="estatus">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="1" id="estatus" >
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="2" id="estatus">
                                                </div>
                                            </div>
                                            @endif

                                                  <button type="submit" class="btn_save_estatus mt-1">Actualizar</button>

                                              </div>

                                          </div>
                                      </form>

        </div>

      </div>
    </div>
  </div>
