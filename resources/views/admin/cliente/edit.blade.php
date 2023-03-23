<!-- Modal -->
<div class="modal fade" id="editClientModal{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="editClientModal{{$client->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editDataModalLabel">Editar Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                <span aria-hidden="true">X</span>
            </button>
        </div>
        <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data" role="form">
            @csrf

            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-body">
            <div class="row">

                <div class="col-12 form-group ">
                    <label for="" class="form-control-label label_form_custom">Nombre </label>
                    <div class="input-group input-group-alternative mb-4">
                    <span class="input-group-text">
                        <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/biker.png') }}" alt="">
                    </span>

                    <input class="form-control" type="text"  id="nombre" name="nombre" value="{{$client->nombre}}">
                    </div>
                </div>

                <div class="col-6 form-group ">
                    <label for="" class="form-control-label label_form_custom">Celular </label>
                    <div class="input-group input-group-alternative mb-4">
                    <span class="input-group-text">
                        <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/ring-phone.png') }}" alt="">
                    </span>

                    <input class="form-control" type="text"  id="telefono" name="telefono" value="{{$client->telefono}}">
                    </div>
                </div>

                <div class="col-6 form-group ">
                    <label for="" class="form-control-label label_form_custom">Correo </label>
                    <div class="input-group input-group-alternative mb-4">
                    <span class="input-group-text">
                        <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/sobre.png') }}" alt="">
                    </span>

                    <input class="form-control" type="email"  id="email" name="email" value="{{$client->email}}">
                    </div>
                </div>
            </div>

            </div>

            </div>
        </form>
    </div>
</div>
</div>
