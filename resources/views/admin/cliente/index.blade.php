@extends('layouts.app_admin')

@section('template_title')
    Cliente
@endsection

@section('css')
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


    #reader {
        width: 400px;
    }
</style>
@endsection


@section('content')
<section class="" style="min-height: 800px;padding: 15px;">

    <div class="row">
        <div class="col-12">
            <h2 class="text-left text-white mt-3">Clientes</h2>
        </div>

            @include('admin.cliente.create')
            <div class="col-12" style="padding: 0!important;">
                @can('client-list')
                    <table id="myTable" class="" style="width:100%">
                        <thead class="thead  text-white">
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                                @can('personal')
                                    <th>Usuario</th>
                                    <th>Fecha creado/editado</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)

                                @include('admin.cliente.edit')
                                <tr class="text-white">
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->nombre }}</td>
                                    <td>{{ $client->telefono }}</td>
                                    <td>
                                        @can('client-edit')
                                            <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editClientModal{{$client->id}}" style="color: #ffff"><i class="fa fa-fw fa-edit"></i></a>
                                        @endcan
                                    </td>
                                        @can('personal')
                                            @if ($client->id_user == 0)
                                                <td>Sin user</td>
                                            @else
                                                <td>{{ $client->Usuario->name }}</td>
                                            @endif

                                            @if ($client->updated_at == NULL)
                                                <td>Sin fecha</td>
                                            @else
                                                <td>{{$client->updated_at->format('d-m-Y H:i')}}</td>
                                            @endif

                                        @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h2 class="text-center text-white mt-3">No tienes Permiso Para ver esta vista.</h2>
                @endcan
            </div>
        </div>
    </section>
@endsection

@section('columna_4')
    <p class="text-center">
        <a class="btn_back" href="" data-bs-toggle="modal" data-bs-target="#modal_creat_user">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>

    $(document).ready(function () {
    $('#myTable').DataTable();
        responsive: true
    });

</script>
@endsection

