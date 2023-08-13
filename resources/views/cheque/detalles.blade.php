@extends('template')

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
                    <li class="breadcrumb-item active">Detalles cheque</li>
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
                            <p class="mb-0 text-muted">Beneficiario</p>
                            <p>{{ $cheque->beneficiario }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Concepto</p>
                            <p>{{ $cheque->concepto }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Monto</p>
                            <p>{{ $cheque->monto }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Fecha</p>
                            <p>{{ $cheque->fecha }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Estado</p>
                            <p>{{ $cheque->estado }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Num. de cheque</p>
                            <p>{{ $cheque->num_cheque }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="mb-0 text-muted">Cuenta/Banco</p>
                            <p>{{ $cheque->chequera->cuenta_bancaria->num_cuenta }} | {{ $cheque->chequera->cuenta_bancaria->banco->nombre }}</p>
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
                                    <th>Codigo contable</th>
                                    <th>Cuenta contable</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                    <th>Ref</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $debes = 0;
                                    $haberes = 0;
                                @endphp

                                @foreach ($cheque->cheque_detalles as $i)
                                <tr>
                                    <td>{{ $i->id }}</td>
                                    <td>{{ $i->concepto }}</td>
                                    <td>{{ $i->codigo_conta }}</td>
                                    <td>{{ $i->cuenta_conta }}</td>
                                    <td>{{ $i->debe }}</td>
                                    <td>{{ $i->haber }}</td>
                                    <td>{{ $i->ref }}</td>

                                    @php
                                        $debes += $i->debe;
                                        $haberes += $i->haber;
                                    @endphp

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                                @php
                                
                                    $dif = $debes - $haberes

                                @endphp

                                <tr>
                                    <td colspan="4" class="text-right">Totales:</td>
                                    <td>{{ $debes }}</td>
                                    <td colspan="2">{{ $haberes }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Diferencia:</td>
                                    <td colspan="3">{{ abs($dif) }}</td>
                                </tr>
                            </tfoot>
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
    $('#cheques-link').addClass('active')
</script>
@endpush