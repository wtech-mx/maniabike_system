@extends('layouts.app_admin')

@section('template_title')
    Cliente
@endsection

@section('content')
<section class="" style="min-height: 800px;padding: 15px;">

    <div class="row">
        <div class="col-12">
            <h2 class="text-left text-white mt-3">Clientes</h2>
        </div>

            <div class="card-header">
                @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
                @endif

                <div class="d-flex justify-content-between">

                    <h3 class="mb-3">Clientes</h3>

                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        Crear
                    </a>

                </div>
            </div>

            @include('admin.cliente.create')
            <div class="col-12" style="padding: 0!important;">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead  text-white">
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        @include('admin.cliente.edit')
                            <tr class="text-white">
                                <td>{{ $client->id }}</td>

                                <td>{{ $client->nombre }}</td>
                                <td>{{ $client->telefono }}</td>
                                <td>{{ $client->email }}</td>
                                <td><a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editClientModal{{$client->id}}" style="color: #ffff"><i class="fa fa-fw fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('select2')
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

  <script type="text/javascript">
        $(document).ready(function() {
            $('.cliente').select2();
        });
  </script>
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
