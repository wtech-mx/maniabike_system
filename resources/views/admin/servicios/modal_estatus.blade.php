            <!-- Modal -->
            <div class="modal fade" id="modal_estatus{{$servicio->id}}" tabindex="-1" aria-labelledby="modal_estatus{{$servicio->id}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-body" style="background-color: #003249">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center"><strong>Cambiar Estatus</strong></p>

                                <div class="d-flex justify-content-center">
                                    <div class="row">
                                        <form method="POST" action="{{ route('taller.edit_status', $servicio->id) }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <input type="hidden" name="_method" value="PATCH">
                                            <div class="col-12">

                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Realizado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/comprobado.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="1" id="flexRadioDefault1">
                                                </div>

                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Candelado<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/cancelar.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="2" id="flexRadioDefault1">
                                                </div>

                                                <div class="form-check mt-3">
                                                    <label class="form-check-label content_label_estatus" >
                                                        En Proceso<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/mechanic.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="3" id="flexRadioDefault1">
                                                </div>

                                                <div class="form-check mt-3 mb-5">
                                                    <label class="form-check-label content_label_estatus" >
                                                        Espera<img class="image_label_estatus" src="{{ asset('assets/admin/img/icons/stopwatch.png') }}" alt="">
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="estatus" value="4" id="flexRadioDefault1">
                                                </div>

                                                <button type="submit" class="btn_save_estatus mt-5">Actualizar</button>

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
