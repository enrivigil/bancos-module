@extends('template')

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
                    <li class="breadcrumb-item"><a href="/cuentas-bancarias">Lista de cuentas bancarias</a></li>
                    <li class="breadcrumb-item active">Detalles cuenta bancaria</li>
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
                <h5>Detalles cuenta bancaria</h5>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <p class="mb-0 text-muted">Id</p>
                    <p>{{ $cuentaBancaria->id }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Num. de cuenta</p>
                    <p>{{ $cuentaBancaria->num_cuenta }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Banco</p>
                    <p>{{ $cuentaBancaria->banco->nombre }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Codigo contable</p>
                    <p>{{ $cuentaBancaria->codigo_conta }}</p>
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
    $('#cuentas-bancarias-link').addClass('active')
</script>
@endpush