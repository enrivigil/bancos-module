<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chequera;
use App\Models\CuentaBancaria;
use App\Models\Banco;

class ChequeraController extends Controller
{
    public function index()
    {
        $chequeras = Chequera::all();

        return view('chequera/index', [
            'chequeras' => $chequeras
        ]);
    }

    public function detalles($id)
    {
        $chequera = Chequera::find($id);

        return view('chequera/detalles', [
            'chequera' => $chequera
        ]);
    }

    public function agregar()
    {
        $bancos = Banco::all();
        $cuentasBancarias = CuentaBancaria::all();

        return view('chequera/agregar', [
            'bancos' => $bancos,
            'cuentasBancarias' => $cuentasBancarias
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'serie' => 'required',
            'num_inicial_cheque' => 'required',
            'num_final_cheque' => 'required',
            'cuenta_bancaria_id' => 'required'
        ]);

        $chequera = new Chequera();
        $chequera->nombre = $request->input('nombre');
        $chequera->serie = $request->input('serie');
        $chequera->num_inicial_cheque = $request->input('num_inicial_cheque');
        $chequera->num_final_cheque = $request->input('num_final_cheque');
        $chequera->num_actual_cheque = $request->input('num_inicial_cheque');
        $chequera->cuenta_bancaria_id = $request->input('cuenta_bancaria_id');

        if (!$chequera->save()) {

            // TODO: mensaje de no confirmacion

            return redirect('/chequeras/agregar');
        }

        // TODO: mensaje de confirmacion

        return redirect('/chequeras/agregar');
    }
}
