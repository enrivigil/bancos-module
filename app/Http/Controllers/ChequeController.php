<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Cheque;
use App\Models\ChequeDetalle;
use App\Models\Chequera;
use App\Models\MovimientoBancario;

class ChequeController extends Controller
{
    public function index()
    {
        $cheques = Cheque::all();

        return view('cheque/index', [
            'cheques' => $cheques
        ]);
    }

    public function detalles($id)
    {
        $cheque = Cheque::with('cheque_detalles')
            ->where('id', $id)
            ->first();

        return view('cheque/detalles', [
            'cheque' => $cheque
        ]);
    }

    public function agregar()
    {
        $chequeras = Chequera::all();
        $catalogo = DB::table('catalogo')
            ->get();

        return view('cheque/agregar', [
            'chequeras' => $chequeras,
            'catalogo' => $catalogo,
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'beneficiario' => 'required',
            'concepto' => 'required',
            'monto' => 'required',
            'estado' => 'required',
            'fecha' => 'required',
            'chequera_id' => 'required',
            'num_cheque' => 'required'
        ]);

        try {

            DB::beginTransaction();

            $num_cheque = $request->input('num_cheque');

            $cheque = new Cheque();
            $cheque->beneficiario = $request->input('beneficiario');
            $cheque->concepto = $request->input('concepto');
            $cheque->monto = $request->input('monto');
            $cheque->estado = $request->input('estado');
            $cheque->fecha = $request->input('fecha');
            $cheque->num_cheque = $num_cheque;
            $cheque->chequera_id = $request->input('chequera_id');

            $cheque->save();

            // Actualizar el numero de cheque actual

            DB::table('chequeras')
                ->where('id', $cheque->chequera_id)
                ->update(['num_actual_cheque' => ($num_cheque + 1)]);

            // Agregar los items del cheque

            $i = 0;

            $conceptos = $request->input('conceptos');
            $codigos_conta = $request->input('codigos_conta');
            $cuentas_conta = $request->input('cuentas_conta');
            $debes = $request->input('debes');
            $haberes = $request->input('haberes');
            $refs = $request->input('refs');

            while ($i < count($conceptos)) {
                $chequeItem = new ChequeDetalle();
                $chequeItem->concepto = $conceptos[$i];
                $chequeItem->codigo_conta = $codigos_conta[$i];
                $chequeItem->cuenta_conta = $cuentas_conta[$i];
                $chequeItem->debe = $debes[$i];
                $chequeItem->haber = $haberes[$i];
                $chequeItem->ref = $refs[$i];
                $chequeItem->cheque_id = $cheque->id;

                $chequeItem->save();

                $i++;
            }

            $movimientoBancario = new MovimientoBancario();
            $movimientoBancario->descripcion = $cheque->concepto;
            $movimientoBancario->monto = $cheque->monto;
            $movimientoBancario->fecha = $cheque->fecha;
            $movimientoBancario->ref = 'Ch-'. $cheque->num_cheque;
            $movimientoBancario->tipo_movimiento = 'Egreso';
            $movimientoBancario->conciliado = false;
            $movimientoBancario->cuenta_bancaria_id = $cheque->chequera->cuenta_bancaria->id;

            $movimientoBancario->save();

            // TODO: contabilizar este cheque

            DB::commit();

            // TODO: agregar mensaje de confirmacion

            return redirect('/cheques/agregar');
        } catch (\Throwable $th) {
            DB::rollBack();

            // TODO: mensaje de no confirmacion
            
            throw $th;
        }
    }
}
