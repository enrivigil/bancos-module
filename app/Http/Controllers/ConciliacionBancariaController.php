<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ConciliacionBancaria;
use App\Models\ConciliacionBancariaDetalle;
use App\Models\MovimientoBancario;
use App\Models\CuentaBancaria;

class ConciliacionBancariaController extends Controller
{
    public function index()
    {
        $conciliacionesBancarias = ConciliacionBancaria::all();

        return view('conciliacion/index', [
            'conciliacionesBancarias' => $conciliacionesBancarias
        ]);
    }

    public function detalles($id)
    {
        $conciliacionBancaria = ConciliacionBancaria::with('conciliacion_bancaria_detalles')
            ->where('id', $id)
            ->first();

        return view('conciliacion/detalles', [
            'conciliacionBancaria' => $conciliacionBancaria
        ]);
    }

    public function agregar()
    {
        $cuentasBancarias = CuentaBancaria::all();
        $movimientosBancarios = MovimientoBancario::where('conciliado', false)
            ->get();

        return view('conciliacion/agregar', [
            'cuentasBancarias' => $cuentasBancarias,
            'movimientosBancarios' => $movimientosBancarios,
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'fecha' => 'required',
            'movimientos_id' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $conciliacionBancaria = new ConciliacionBancaria();
            $conciliacionBancaria->descripcion = $request->input('descripcion');
            $conciliacionBancaria->fecha = $request->input('fecha');

            $conciliacionBancaria->save();

            // Agregar los items de la conciliacion

            $i = 0;

            $movimientos_id = $request->input('movimientos_id');
         
            while ($i < count($movimientos_id)) {
                $conciliacionBancariaItem = new ConciliacionBancariaDetalle();
                $conciliacionBancariaItem->movimiento_bancario_id = $movimientos_id[$i];
                $conciliacionBancariaItem->conciliacion_bancaria_id = $conciliacionBancaria->id;

                $conciliacionBancariaItem->save();

                DB::table('movimientos_bancarios')
                    ->where('id', $movimientos_id[$i])
                    ->update(['conciliado' => true]);

                $i++;
            }

            DB::commit();

            // TODO: mensaje de confirmacion

            return redirect('/conciliaciones-bancarias/agregar');
        } catch (\Throwable $th) {
            DB::rollBack();

            // TODO: mensaje de no confirmacion

            throw $th;
        }

        return $request->all();
    }
}
