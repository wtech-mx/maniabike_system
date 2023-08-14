<div class="modal fade" id="modal_estatus{{$nota->id}}" tabindex="-1" aria-labelledby="modal_estatus{{$nota->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <div class="modal-body" style="background-color: #003249">

                                  <p class="text-center"><strong>Cambiar Estatus</strong></p>

                                      <form method="POST" action="{{ route('caja.estatus', $nota->id) }}" enctype="multipart/form-data" role="form">
                                          @csrf
                                          <input type="hidden" name="_method" value="PATCH">

                                          <div class="row m-0 ">
                                              <div class="col-12">

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Pagado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/dar-dinero.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="pagado" id="estatus" >
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="cancelado" id="estatus">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <div class="form-check mt-3 mb-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        deudor<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="deudor" id="estatus">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn_save_estatus mt-1">Actualizar</button>
                                            </div>

                                            </div>

                                          </div>
                                      </form>

        </div>

      </div>
    </div>
  </div>
