<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banco;

class BancoController extends Controller
{
    public function index()
    {
        $bancos = Banco::all();

        return view('banco/index', [
            'bancos' => $bancos
        ]);
    }

    public function agregar()
    {
        return view('banco/agregar');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $banco = new Banco();
        $banco->nombre = $request->input('nombre');

        if (!$banco->save()) {
            
            // TODO: mensaje de no confirmacion

            return redirect('/bancos/agregar');
        }

        // TODO: mensaje de confirmacion

        return redirect('/bancos/agregar');
    }
}
