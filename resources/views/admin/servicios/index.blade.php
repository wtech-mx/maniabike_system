@extends('layouts.app_admin')

@section('template_title')
   Servicios
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/servicios_index.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">

<style>
.modal-dialog {
    margin-left: 0!important;
}

.modal-dialog {
    width: 80%!important;;
}
</style>
@endsection

@section('content')
<section class="" style="min-height: 800px;padding: 15px;">

<div class="row">
    <div class="col-12">
        <h2 class="text-left text-white mt-3">Servicios</h2>
    </div>

    <div class="col-12" style="padding: 0;">

        <div class="d-flex mb-3">
            <div class="me-auto p-2"><h5 class="text-left text-white mt-3">Estatus</h5></div>
            <div class="p-2">
                <a href="{{ route('taller.create') }}" class="btn btn_add_service">
                    <i class="fas fa-plus-circle" style="color:#fff;font-size: 20px;"></i>
                </a>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <span class="badge rounded-pill text-white text-bg-warning">Ingre...</span>
            <span class="badge rounded-pill text-white text-bg-info">Proceso</span>
            <span class="badge rounded-pill text-white text-bg-danger">Espera</span>
            <span class="badge rounded-pill text-white text-bg-success">Reali...</span>
            <span class="badge rounded-pill text-white text-bg-dark">Cancel</span>
        </div>
    </div>

    <div class="col-12" style="padding: 0!important;">
        <table id="myTable" class="table  display responsive nowrap" style="width:100%">
            <thead>
                <tr class="text-white" style="font-size: 9px;">
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Bicicleta</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($servicios as $servicio)
            <tbody class="text-white">
                <tr style="font-size: 12px;">
                    <td>{{$servicio->id}}</td>
                    <td>{{$servicio->Cliente->nombre}} <br><a class="text-white" href="tel:+52{{$servicio->Cliente->telefono}}">{{$servicio->Cliente->telefono}}</a></td>
                    <td>{{$servicio->marca}} <br> {{$servicio->modelo}}</td>
                    <td>{{$servicio->fecha}}</td>
                    <td>
                        @php
                        if ($servicio->estatus == 1 ) {
                            $servicio->estatus = 'Procesando';
                        }elseif ($servicio->estatus == 2) {
                            $servicio->estatus = 'En Espera';
                        }elseif ($servicio->estatus == 3) {
                            $servicio->estatus = 'Realizado';
                        }elseif ($servicio->estatus == 4) {
                            $servicio->estatus = 'Cancelado';
                        }elseif ($servicio->estatus == 0) {
                            $servicio->estatus = 'R ingresado';
                        }
                        @endphp
                        @if ($servicio->estatus == 'Procesando' )
                            <span class="badge rounded-pill custom_badg text-white text-bg-info" style="padding: 15px;width: 15px;height: 15px;color: transparent!important;margin-left:5px;">-</span>
                        @elseif ($servicio->estatus == 'En Espera')
                            <span class="badge rounded-pill custom_badg text-white text-bg-danger" style="padding: 15px;width: 15px;height: 15px;color: transparent!important;margin-left:5px;">-</span>
                        @elseif ($servicio->estatus == 'Realizado')
                            <span class="badge rounded-pill custom_badg text-white text-bg-success" style="padding: 15px;width: 15px;height: 15px;color: transparent!important;margin-left:5px;">-</span>
                        @elseif ($servicio->estatus == 'Cancelado')
                            <span class="badge rounded-pill custom_badg text-white text-bg-dark" style="padding: 15px;width: 15px;height: 15px;color: transparent!important;margin-left:5px;">-</span>
                        @elseif ($servicio->estatus == 'R ingresado')
                        {{-- {{ dd($item->estatus) }} --}}
                            <span class="badge rounded-pill custom_badg text-white text-bg-warning" style="padding: 15px;width: 15px;height: 15px;color: transparent!important;margin-left:5px;">-</span>
                        @endif
                    </td>
                    <td>
                        <a type="button" class="btn btn_plus_action" data-bs-toggle="modal" data-bs-target="#modal_menu{{$servicio->id}}">
                            <i class="fas fa-plus-circle" style="color:#000;font-size: 20px;"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            <!-- Modal -->
            <div class="modal fade" id="modal_menu{{$servicio->id}}" tabindex="-1" aria-labelledby="modal_menu{{$servicio->id}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <a class="text_menu_icon mt-3" href="">
                                    <i class="icon_modal_menu fas fa-eye"></i>Ver Servicios
                                </a> <br>

                                <a  class="text_menu_icon mt-3" target="_blank"
                                href="https://wa.me/52{{$servicio->Cliente->telefono}}?text=Hola%20{{$servicio->Cliente->nombre}},%20ID:%{{$servicio->id}},%20Bici:%{{$servicio->marca}}-{{$servicio->modelo}},%20Fecha de ingreso:%{{$servicio->fecha}}%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0{{ route('taller.show', $servicio->id) }})">
                                    <i class="icon_modal_menu fab fa-whatsapp"></i>Enviar Whats
                                </a> <br>

                                <a class="text_menu_icon mt-3" href="{{ route('taller.edit',$servicio->id) }}">
                                    <i class="icon_modal_menu fas fa-edit"></i>Editar Servicio
                                </a> <br>

                                <a class="text_menu_icon mt-3" href="">
                                    <i class="icon_modal_menu fas fa-print"></i>Imprimir Etiqueta
                                </a> <br>

                                <a class="text_menu_icon mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                    <i class="icon_modal_menu fas fa-recycle"></i>Cambiar Estatus
                                </a> <br>
                                <div style="">
                                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                                      <div class="card card-body" style="width: 300px;">

                                        <form method="POST" action="{{ route('taller.edit_status', $servicio->id) }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <input type="hidden" name="_method" value="PATCH">
                                              <select class="form-control"  data-toggle="select" id="estatus" name="estatus" >
                                                <option selected value="">{{ $servicio->estatus }}</option>
                                                <option value="0">R Ingresado</option>
                                                <option value="1">Procesando</option>
                                                <option value="2">En Espera</option>
                                                <option value="3">Realizado</option>
                                                <option value="4">Cancelado</option>
                                            </select>
                                            <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                        </form>

                                      </div>
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
            @endforeach

        </table>
    </div>

</div>

</section>

@endsection

@section('columna_4')
    <p class="text-center">
        <a class="btn_back" href="{{ route('taller.create') }}"">
            <i class="fas fa-plus-circle"></i>
        </a>
    </p>
@endsection

@section('select2')

  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>
  {{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script> --}}

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

  <script>

    $(document).ready(function () {
    $('#myTable').DataTable();
        responsive: true
});
    </script>

@endsection
