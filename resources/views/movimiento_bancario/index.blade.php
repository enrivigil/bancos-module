@extends('template')


@push('styles')
<link rel="stylesheet" href="{{ url('') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endpush

@section('main-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0">Movimientos bancarios</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Lista de movimientos bancarios</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <!-- Main content -->

        <div class="card">
            <div class="card-header">
                <h5>Lista de movimientos bancarios</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Referencia</th>
                            <th>Tipo de movimiento</th>
                            <th>Conciliado</th>
                            <th>Cuenta/Banco</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientosBancarios as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->descripcion }}</td>
                            <td>{{ $i->monto }}</td>
                            <td>{{ $i->fecha }}</td>
                            <td>{{ $i->ref }}</td>
                            <td>{{ $i->tipo_movimiento }}</td>
                            <td>
                                @if ($i->conciliado)
                                    <span class="badge badge-success px-3">Si</span>
                                @else
                                    <span class="badge badge-danger px-3">No</span>
                                @endif

                            </td>
                            <td>
                                {{ $i->cuenta_bancaria->num_cuenta }} |
                                {{ $i->cuenta_bancaria->banco->nombre }}
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
    $('#movimientos-bancarios-link').addClass('active')

    $('.table').DataTable()
</script>
@endpush