@extends('template')

@push('styles')
<link rel="stylesheet" href="{{ url('') }}/plugins/bootstrap-select/css/bootstrap-select.min.css">
@endpush

@section('main-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0">Transacciones</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/transacciones">Lista de transacciones</a></li>
                    <li class="breadcrumb-item active">Agregar transaccion</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <!-- Main content -->

        <form action="/transacciones/agregar" method="post">

            @csrf

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Datos generales</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="">Concepto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('concepto') is-invalid @enderror" name="concepto" id="concepto">
                                @error('concepto')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Monto <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" id="monto">
                                @error('monto')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Fecha <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha">
                                @error('fecha')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Tipo de transaccion</label>
                                <select class="form-control @error('tipo_transaccion') @enderror" name="tipo_transaccion" id="tipo_transaccion">
                                    <option value="">Elegir tipo de transaccion</option>
                                    <option value="Ingreso">Ingreso</option>
                                    <option value="Egreso">Egreso</option>
                                </select>
                                @error('tipo_transaccion')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Cuenta bancaria <span class="text-danger">*</span></label>
                                <select class="form-control @error('cuenta_bancaria_id') is-invalid @enderror" name="cuenta_bancaria_id" id="cuenta_bancaria_id">
                                    <option value="">Elegir cuenta bancaria</option>
                                    @foreach ($cuentasBancarias as $i)
                                        <option value="{{ $i->id }}" data-cb-codigo-conta="{{ $i->codigo_conta }}">{{ $i->banco->nombre }} | {{ $i->num_cuenta}}</option>
                                    @endforeach
                                </select>
                                @error('cuenta_bancaria_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-check"></i>
                                <span>Guardar</span>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-8 mb-3">

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="">Cuenta contable</label>
                                    <select class="form-control border selectpicker" id="codigo-cuenta-conta" data-live-search="true" data-style="bg-white">
                                        <option value="">Elegir cuenta contable</option>
                                        @foreach ($catalogo as $i)
                                        <option value="{{ $i->codigo }}-{{ $i->cuenta }}">{{ $i->codigo .' - '. $i->cuenta }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <label for="">Debe</label>
                                    <input type="number" class="form-control" id="debe" value="0">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <label for="">Haber</label>
                                    <input type="number" class="form-control" id="haber" value="0">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <button type="button" class="btn btn-light border btn-block" id="btnAgregarItem">Agregar item</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6>Items</h6>
                        </div>
                        <div class="card-body p-0 table-responsive">

                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Concepto</th>
                                        <th>Codigo contable</th>
                                        <th>Cuenta contable</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-items"></tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-right" colspan="4">Totales:</td>
                                        <td>
                                            <span id="total-debe">0</span>
                                        </td>
                                        <td colspan="2">
                                            <span id="total-haber">0</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">Diferencia:</td>
                                        <td colspan="3">
                                            <span id="dif">0</span>
                                        </td>
                                    </tr>
                                </tfoot>
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
<script src="{{ url('') }}/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script>
    $('#bancos-submenu').addClass('menu-open')
    $('#bancos-submenu > a').addClass('active')
    $('#transacciones-link').addClass('active')
    $('.selectpicker').selectpicker()

    const cuentasBancarias = @json($cuentasBancarias);
    const catalogo = @json($catalogo);
    let i = 0
    let last = 0

    function agregarItem(concepto, codigoConta, cuentaConta, debe, haber, last) {

        let html = `
            <tr data-index="${i}" data-last="${last}" data-debe="${debe}" data-haber="${haber}">
                <td>
                    ${i+1}
                </td>
                <td>
                    ${concepto}
                    <input type="hidden" name="conceptos[]" value="${concepto}">
                </td>
                <td>
                    ${codigoConta}
                    <input type="hidden" name="codigos_conta[]" value="${codigoConta}">
                </td>
                <td>
                    ${cuentaConta}
                    <input type="hidden" name="cuentas_conta[]" value="${cuentaConta}">
                </td>
                <td>
                    ${debe}
                    <input type="hidden" name="debes[]" value="${debe}">
                </td>
                <td>
                    ${haber}
                    <input type="hidden" name="haberes[]" value="${haber}">
                </td>
                <td>
                    <button type="button" class="btn btn-link" onclick="removerItem(${i})">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
        `

        document.getElementById('tbody-items').innerHTML += html
        i++

        actualizarTotales()
    }

    function removerItem(index) {

        let tr = document.querySelector(`#tbody-items [data-index="${index}"]`)

        tr.remove()

        actualizarTotales()
    }

    function actualizarTotales() {
        let trs = document.querySelectorAll('#tbody-items tr')

        let totalDebe = 0
        let totalHaber = 0
        let dif = 0

        trs.forEach(tr => {
            totalDebe += parseFloat(tr.getAttribute('data-debe'))
            totalHaber += parseFloat(tr.getAttribute('data-haber'))
        })

        if (totalDebe > totalHaber)
            dif = totalDebe - totalHaber
        else
            dif = totalHaber - totalDebe

        document.getElementById('total-debe').textContent = totalDebe
        document.getElementById('total-haber').textContent = totalHaber
        document.getElementById('dif').textContent = dif
    }

    document.getElementById('btnAgregarItem').addEventListener('click', function(e) {

        let concepto = document.getElementById('concepto').value
        let codigoCuentaConta = document.getElementById('codigo-cuenta-conta').value
        let debe = document.getElementById('debe').value
        let haber = document.getElementById('haber').value

        codigoCuentaConta = codigoCuentaConta.split('-')

        agregarItem(
            concepto,
            codigoCuentaConta[0],
            codigoCuentaConta[1],
            debe,
            haber,
            ""
        )

        $('.selectpicker').selectpicker('refresh');
        document.getElementById('debe').value = 0
        document.getElementById('haber').value = 0
    })

    document.getElementById('cuenta_bancaria_id').addEventListener('change', function(e) {

        // remover item anterior si selecciona otra cuenta
        let tr = document.querySelector(`#tbody-items [data-last="${last}"]`)

        if (tr != undefined) {
            removerItem(tr.getAttribute('data-index'))
        }

        let elm = e.target
        let selected = elm.options[elm.selectedIndex]

        let codigoCuenta = selected.getAttribute('data-cb-codigo-conta')
        let cuenta = catalogo.filter(c => c.codigo == codigoCuenta)[0]

        let concepto = document.getElementById('concepto').value
        let monto = document.getElementById('monto').value
        let tipoTransaccion = document.getElementById('tipo_transaccion').value

        let debe = 0
        let haber = 0

        if (tipoTransaccion === 'Ingreso') {
            debe = monto
        }

        if (tipoTransaccion === 'Egreso') {
            haber = monto
        }

        agregarItem(
            concepto,
            codigoCuenta,
            cuenta.cuenta,
            debe,
            haber,
            codigoCuenta
        )

        last = codigoCuenta
    })

</script>
@endpush