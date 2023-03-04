@extends('layouts.app_admin')

@section('template_title')
     Roles
@endsection

@section('page_actuality')
Roles
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->


            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Roles y Permisos</h3>

                    @can('role-create')
                    <a class="btn" href="{{ route('roles.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">Crear </a>
                    @endcan

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                  <thead class="thead-light">
                      <tr>
                       <th>No</th>
                       <th>Name</th>
                       <th width="280px">Action</th>
                     </tr>
                  </thead>

                 @foreach ($roles as $key => $role)
                      <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>



                        <td>

                            <a class="btn btn-sm btn-primary " href="{{ route('roles.show',$role->id) }}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> </a>

                            <a class="btn btn-sm btn-success" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-fw fa-edit"></i> </a>


                            {!! Form::open(['method' => 'DELETE','route' => ['permisos.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}


                        </td>

                      </tr>
                 @endforeach

              </table>
            </div>

          </div>
        </div>
      </div>
</div>

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
</script>

@endsection
