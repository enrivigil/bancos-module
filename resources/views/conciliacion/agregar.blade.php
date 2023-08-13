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
                    <li class="breadcrumb-item active">Agregar conciliacion bancaria</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <!-- Main content -->

        <form action="/conciliaciones-bancarias/agregar" method="post">

            @csrf

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Datos generales</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" class="form-control" name="fecha">
                            </div>

                            <div class="form-group">
                                <label for="">Cuenta bancaria</label>
                                <select class="form-control" id="cuenta_bancaria">
                                    <option value="">Elegir cuenta bancaria</option>
                                    @foreach ($cuentasBancarias as $i)
                                    <option value="{{ $i->id }}">
                                        {{ $i->num_cuenta }} |
                                        {{ $i->banco->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-check"></i>
                                <span>Guardar</span>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h6>Lista de movimientos no conciliados</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Concepto</th>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Referencia</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-items"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#bancos-submenu').addClass('menu-open')
    $('#bancos-submenu > a').addClass('active')
    $('#conciliaciones-bancarias-link').addClass('active')

    const movimientosBancarios = @json($movimientosBancarios);

    document.getElementById('cuenta_bancaria').addEventListener('change', function(e) {

        let id = this.value
        let movimientos = movimientosBancarios.filter(mb => mb.cuenta_bancaria_id == id);
        let html = ''

        movimientos.forEach(mb => {
            html += `
            <tr>
                <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input rounded-0"
                            name="movimientos_id[]"
                            value="${ mb.id }"
                            style="height: 15px; width: 15px;">
                    </div>
                </td>
                <td>${mb.id}</td>
                <td>${ mb.descripcion }</td>
                <td>${ mb.monto }</td>
                <td>${ mb.fecha }</td>
                <td>${ mb.tipo_movimiento }</td>
                <td>${ mb.ref }</td>
            </tr>
            `

        })

        if (html === '')
            html = `<tr>
                <td colspan="7" class="text-center">
                    No hay movimientos para conciliar en esta cuenta
                </td>
            </tr>`
        
        document.getElementById('tbody-items').innerHTML = html
        console.log(html);
    })
</script>
@endpush