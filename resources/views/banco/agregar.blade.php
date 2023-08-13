@extends('template')

@section('main-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0">Bancos</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/bancos">Lista de bancos</a></li>
                    <li class="breadcrumb-item active">Agregar banco</li>
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
                <h5>Agregar banco</h5>
            </div>
            <div class="card-body">

                <form action="/bancos/agregar" method="post">

                    @csrf

                    <div class="form-group">
                        <label for="">Nombre del banco <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" style="max-width: 400px;">
                        @error('nombre')
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
    $('#bancos-link').addClass('active')
</script>
@endpush