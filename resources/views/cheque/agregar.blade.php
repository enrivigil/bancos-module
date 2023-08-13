@extends('template')

@push('styles')
<link rel="stylesheet" href="{{ url('') }}/plugins/bootstrap-select/css/bootstrap-select.min.css">
@endpush

@section('main-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0">Cheques</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/cheques">Lista de cheques</a></li>
                    <li class="breadcrumb-item active">Agregar cheque</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <!-- Main content -->

        <form action="/cheques/agregar" method="post">

            @csrf

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Datos generales</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="">Beneficiario <span class="text-danger">*</span></label>
                                <select class="form-control @error('beneficiario') is-invalid @enderror" name="beneficiario">
                                    <option value="">Elegir benenficiario</option>
                                    <option value="Anulado">Anulado</option>
                                    <option value="Polar S.A. de C.V.">Polar S.A. de C.V.</option>
                                    <option value="Codex Inc SA.">Codex Inc SA.</option>
                                </select>
                                @error('beneficiario')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

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
                                <label for="">Estado <span class="text-danger">*</span></label>
                                <select class="form-control @error('estado') is-invalid @enderror" name="estado">
                                    <option value="">Elegir estado</option>
                                    <option value="Girado">Girado</option>
                                    <option value="Anulado">Anulado</option>
                                </select>
                                @error('estado')
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
                                <label for="">Chequera <span class="text-danger">*</span></label>
                                <select class="form-control @error('chequera') is-invalid @enderror" name="chequera_id" id="chequera_id">
                                    <option value="">Elegir chequera</option>
                                    @foreach ($chequeras as $i)
                                    <option value="{{ $i->id }}" data-num-actual-cheque="{{ $i->num_actual_cheque }}" data-cb-codigo-conta="{{ $i->cuenta_bancaria->codigo_conta }}">
                                        {{ $i->nombre }} |
                                        {{ $i->cuenta_bancaria->banco->nombre }} -
                                        {{ $i->cuenta_bancaria->num_cuenta }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('chequera')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Num. de cheque <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('fecha') is-invalid @enderror" name="num_cheque" id="num_cheque">
                                @error('fecha')
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
                                        <th>Ref</th>
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
                                        <td colspan="3">
                                            <span id="total-haber">0</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">Diferencia:</td>
                                        <td colspan="4">
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
    $('#cheques-link').addClass('active')
    $('.selectpicker').selectpicker()

    const catalogo = @json($catalogo);
    let i = 0
    let last = 0

    function agregarItem(concepto, codigoConta, cuentaConta, debe, haber, ref, last) {

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
                    ${ref}
                    <input type="hidden" name="refs[]" value="${ref}">
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
        let numCheque = document.getElementById('num_cheque').value
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
            `Ch-${numCheque}`,
            ""
        )

        $('.selectpicker').selectpicker('refresh');
        document.getElementById('debe').value = 0
        document.getElementById('haber').value = 0
    })

    document.getElementById('chequera_id').addEventListener('change', function(e) {

        // remover item anterior si selecciona otra cuenta
        let tr = document.querySelector(`#tbody-items [data-last="${last}"]`)

        if (tr != undefined) {
            removerItem(tr.getAttribute('data-index'))
        }

        let elm = e.target
        let selected = elm.options[elm.selectedIndex]

        let numCheque = selected.getAttribute('data-num-actual-cheque')
        let codigoCuenta = selected.getAttribute('data-cb-codigo-conta')
        let cuenta = catalogo.filter(c => c.codigo == codigoCuenta)[0]

        let concepto = document.getElementById('concepto').value
        let monto = document.getElementById('monto').value

        document.getElementById('num_cheque').value = numCheque;

        agregarItem(
            concepto,
            codigoCuenta,
            cuenta.cuenta,
            0,
            monto,
            `Ch-${numCheque}`,
            codigoCuenta
        )

        last = codigoCuenta
    })
</script>
@endpush