@extends('template')

@section('main-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0">Chequeras</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/chequeras">Lista de chequeras</a></li>
                    <li class="breadcrumb-item active">Detalles chequera</li>
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
                <h5>Detalles chequera</h5>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <p class="mb-0 text-muted">Id</p>
                    <p>{{ $chequera->id }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Nombre chequera</p>
                    <p>{{ $chequera->nombre }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Serie</p>
                    <p>{{ $chequera->serie }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Cuenta</p>
                    <p>{{ $chequera->cuenta_bancaria->num_cuenta }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Banco</p>
                    <p>{{ $chequera->cuenta_bancaria->banco->nombre }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-0 text-muted">Num. inicial de cheque</p>
                    <p>{{ $chequera->num_inicial_cheque }}</p>
                </div>
                <div class="mb-3">
                    <p class="mb-0 text-muted">Num. final de cheque</p>
                    <p>{{ $chequera->num_final_cheque }}</p>
                </div>
                <div class="mb-3">
                    <p class="mb-0 text-muted">Num. actual de cheque</p>
                    <p>{{ $chequera->num_actual_cheque }}</p>
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
    $('#chequeras-link').addClass('active')
</script>
@endpush