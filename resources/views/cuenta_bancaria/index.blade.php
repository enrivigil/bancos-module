@extends('template')


@push('styles')
<link rel="stylesheet" href="{{ url('') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endpush

@section('main-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0">Cuentas bancarias</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Lista de cuentas bancarias</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <!-- Main content -->

        <div class="card">
            <div class="card-header align-items-center d-flex justify-content-between">
                <h5>Lista de cuentas bancarias</h5>
                <a href="/cuentas-bancarias/agregar" class="btn btn-light ml-auto">
                    <i class="fas fa-plus"></i>
                    <span>Agregar cuenta bancaria</span>
                </a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Num. cuenta</th>
                            <th>Banco</th>
                            <th>Codigo conta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuentasBancarias as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->num_cuenta }}</td>
                            <td>{{ $i->banco->nombre }}</td>
                            <td>{{ $i->codigo_conta }}</td>
                            <td style="width: 220px;">
                                <div class="btn-group align-items-center">
                                    <a href="/cuentas-bancarias/{{ $i->id }}/detalles" class="btn btn-link">Detalles</a>
                                    <!-- <a href="/bancos/{{ $i->id }}/editar" class="btn btn-link">Editar</a> |
                                    <a href="/bancos/{{ $i->id }}/borrar" class="btn btn-link">Borrar</a> -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ url('') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#bancos-submenu').addClass('menu-open')
    $('#bancos-submenu > a').addClass('active')
    $('#cuentas-bancarias-link').addClass('active')

    $('.table').DataTable()
</script>
@endpush