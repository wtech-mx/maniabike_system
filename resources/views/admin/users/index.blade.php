@extends('layouts.app_admin')

@section('template_title')
    Usuarios
@endsection

@section('content')

<section class="" style="min-height: 700px;padding: 15px;">

    <div class="row">
        <div class="col-12">
            <h2 class="text-left text-white mt-3">Usuarios</h2>
        </div>

        <div class="col-12">
            @can('usuarios-create')
            <div class="table-responsive">
                <table class="table table-flush text-white" id="myTable">
                    <thead class="thead-light">
                        <tr>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Roles</th>
                        <th width="280px">Acciones</th>
                        </tr>
                    </thead>

                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->puesto }}</td>
                            <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                            </td>

                            <td>

                                {{-- <a class="btn btn-sm btn-primary " href="{{ route('users.show',$user->id) }}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> </a> --}}
                                @can('usuarios-edit')
                                <a class="btn btn-sm btn-success" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                @endcan

                                @can('usuarios-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display: contents;']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm ',]) !!}
                                {!! Form::close() !!}
                                @endcan

                            </td>

                        </tr>
                    @endforeach

                </table>
            </div>
            @endcan
        </div>
      </div>
</section>

@endsection

@section('columna_4')
    <p class="text-center">
        @can('usuarios-create')
        <a class="btn_back" href="{{ route('users.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
            <i class="fas fa-plus-circle"></i>
        </a>
        @endcan
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
