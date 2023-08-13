@extends('template')

@section('main-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0">Conciliaciones bancarias</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/conciliaciones-bancarias">Lista de conciliaciones bancarias</a></li>
                    <li class="breadcrumb-item active">Detalles conciliacion bancaria</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <!-- Main content -->

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6>Datos generales</h6>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Descripcion</p>
                            <p>{{ $conciliacionBancaria->descripcion }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Fecha</p>
                            <p>{{ $conciliacionBancaria->fecha }}</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8">

                <div class="card">
                    <div class="card-header">
                        <h6>Items</h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Referencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conciliacionBancaria->conciliacion_bancaria_detalles as $i)
                                <tr>
                                    <td>{{ $i->id }}</td>
                                    <td>{{ $i->movimiento_bancario->descripcion }}</td>
                                    <td>{{ $i->movimiento_bancario->monto }}</td>
                                    <td>{{ $i->movimiento_bancario->fecha }}</td>
                                    <td>{{ $i->movimiento_bancario->tipo_movimiento }}</td>
                                    <td>{{ $i->movimiento_bancario->ref }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#bancos-submenu').addClass('menu-open')
    $('#bancos-submenu > a').addClass('active')
    $('#conciliaciones-bancarias-link').addClass('active')
</script>
@endpush