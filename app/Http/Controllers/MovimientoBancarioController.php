<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MovimientoBancario;

class MovimientoBancarioController extends Controller
{
    public function index()
    {
        $movimientosBancarios = MovimientoBancario::all();

        return view('movimiento_bancario/index', [
            'movimientosBancarios' => $movimientosBancarios
        ]);
    }
}
