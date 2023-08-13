<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Transaccion;
use App\Models\TransaccionDetalle;
use App\Models\CuentaBancaria;
use App\Models\MovimientoBancario;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::all();

        return view('transaccion/index', [
            'transacciones' => $transacciones
        ]);
    }

    public function detalles($id)
    {
        $transaccion = Transaccion::with('transaccion_detalles')
            ->where('id', $id)
            ->first();

        return view('transaccion/detalles', [
            'transaccion' => $transaccion
        ]);
    }

    public function agregar()
    {
        $cuentasBancarias = CuentaBancaria::all();
        $catalogo = DB::table('catalogo')
            ->get();

        return view('transaccion/agregar', [
            'cuentasBancarias' => $cuentasBancarias,
            'catalogo' => $catalogo,
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'concepto' => 'required',
            'monto' => 'required',
            'fecha' => 'required',
            'tipo_transaccion' => 'required',
            'cuenta_bancaria_id' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $transaccion = new Transaccion();
            $transaccion->concepto = $request->input('concepto');
            $transaccion->monto = $request->input('monto');
            $transaccion->fecha = $request->input('fecha');
            $transaccion->tipo_transaccion = $request->input('tipo_transaccion');
            $transaccion->cuenta_bancaria_id = $request->input('cuenta_bancaria_id');

            $transaccion->save();

            // Agregar los items de la transaccion

            $i = 0;

            $conceptos = $request->input('conceptos');
            $codigos_conta = $request->input('codigos_conta');
            $cuentas_conta = $request->input('cuentas_conta');
            $debes = $request->input('debes');
            $haberes = $request->input('haberes');

            while ($i < count($conceptos)) {
                $transaccionItem = new TransaccionDetalle();
                $transaccionItem->concepto = $conceptos[$i];
                $transaccionItem->codigo_conta = $codigos_conta[$i];
                $transaccionItem->cuenta_conta = $cuentas_conta[$i];
                $transaccionItem->debe = $debes[$i];
                $transaccionItem->haber = $haberes[$i];
                $transaccionItem->transaccion_id = $transaccion->id;

                $transaccionItem->save();

                $i++;
            }

            $movimientoBancario = new MovimientoBancario();
            $movimientoBancario->descripcion = $transaccion->concepto;
            $movimientoBancario->monto = $transaccion->monto;
            $movimientoBancario->fecha = $transaccion->fecha;
            $movimientoBancario->ref = 'Tr-' . $transaccion->id;
            $movimientoBancario->tipo_movimiento = $transaccion->tipo_transaccion;
            $movimientoBancario->conciliado = false;
            $movimientoBancario->cuenta_bancaria_id = $transaccion->cuenta_bancaria->id;

            $movimientoBancario->save();

            // TODO: contabilizar esta transaccion

            DB::commit();

            // TODO: agregar mensaje de confirmacion

            return redirect('/transacciones/agregar');
        } catch (\Throwable $th) {
            DB::rollBack();

            // TODO: mensaje de no confirmacion
            
            throw $th;
        }
    }
}
