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
                    <li class="breadcrumb-item active">Agregar cuenta bancaria</li>
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
                <h5>Agregar cuenta bancaria</h5>
            </div>
            <div class="card-body">

                <form action="/cuentas-bancarias/agregar" method="post">

                    @csrf

                    <div class="form-group">
                        <label for="">Num. de cuenta <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('num_cuenta') is-invalid @enderror" name="num_cuenta" style="max-width: 600px;">
                        @error('num_cuenta')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Banco <span class="text-danger">*</span></label>
                        <select class="form-control @error('banco_id') is-invalid @enderror" name="banco_id" style="max-width: 400px;">
                            <option value="">Elegir banco</option>
                            @foreach ($bancos as $i)
                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>    
                            @endforeach
                        </select>
                        @error('banco_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Codigo contable <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('codigo_conta') is-invalid @enderror" name="codigo_conta" style="max-width: 400px;">
                        @error('codigo_conta')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        <span>Guardar</span>
                    </button>

                </form>

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