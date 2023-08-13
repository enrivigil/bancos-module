<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CuentaBancaria;
use App\Models\Banco;

class CuentaBancariaController extends Controller
{
    public function index()
    {
        $cuentasBancarias = CuentaBancaria::all();

        return view('cuenta_bancaria/index', [
            'cuentasBancarias' => $cuentasBancarias
        ]);
    }

    public function detalles($id)
    {
        $cuentaBancaria = CuentaBancaria::find($id);

        return view('cuenta_bancaria/detalles', [
            'cuentaBancaria' => $cuentaBancaria
        ]);
    }

    public function agregar()
    {
        $bancos = Banco::all();

        return view('cuenta_bancaria/agregar', [
            'bancos' => $bancos
        ]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'num_cuenta' => 'required',
            'codigo_conta' => 'required',
            'banco_id' => 'required'
        ]);

        $cuentaBancaria = new CuentaBancaria();
        $cuentaBancaria->num_cuenta = $request->input('num_cuenta');
        $cuentaBancaria->codigo_conta = $request->input('codigo_conta');
        $cuentaBancaria->banco_id = $request->input('banco_id');

        if (!$cuentaBancaria->save()) {

            // TODO: mensaje de no confirmacion

            return redirect('/cuentas-bancarias/agregar');
        }

        // TODO: mensaje de confirmacion

        return redirect('/cuentas-bancarias/agregar');
    }
}
