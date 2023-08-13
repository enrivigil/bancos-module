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
                    <li class="breadcrumb-item active">Agregar chequera</li>
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
                <h5>Agregar chequera</h5>
            </div>
            <div class="card-body">

                <form action="/chequeras/agregar" method="post">

                    @csrf

                    <div class="form-group">
                        <label for="">Banco</label>
                        <select class="form-control" id="banco_id" style="max-width: 500px;">
                            <option value="">Elegir banco</option>
                            @foreach ($bancos as $i)
                            <option value="{{ $i->id }}">{{ $i->nombre }}</option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Cuenta bancaria <span class="text-danger">*</span></label>
                        <select class="form-control @error('cuenta_bancaria_id') is-invalid @enderror" name="cuenta_bancaria_id" id="cuenta_bancaria_id" style="max-width: 500px;">
                            <option value="">Elegir cuenta bancaria</option>
                        </select>
                        @error('cuenta_bancaria_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Nombre de chequera <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" style="max-width: 400px;">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Serie <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('serie') is-invalid @enderror" name="serie" style="max-width: 400px;">
                        @error('serie')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Num. inicial de cheque <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('num_inicial_cheque') is-invalid @enderror" name="num_inicial_cheque" style="max-width: 400px;">
                        @error('num_inicial_cheque')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Num. final de cheque <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('num_final_cheque') is-invalid @enderror" name="num_final_cheque" style="max-width: 400px;">
                        @error('num_final_cheque')
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
    $('#chequeras-link').addClass('active')

    const cuentasBancarias = @json($cuentasBancarias);

    document.getElementById('banco_id').addEventListener('change', function (e) {

        let id = this.value
        let cuentas = cuentasBancarias.filter(c => c.banco_id == id)

        console.log(cuentas);

        let html = `<option value="">Elegir cuenta bancaria</option>`

        cuentas.forEach(c => {
            html += `
                <option value="${c.id}">${c.num_cuenta}</option>
            `
        })

        document.getElementById('cuenta_bancaria_id').innerHTML = html
    })

</script>
@endpush