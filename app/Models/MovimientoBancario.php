<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoBancario extends Model
{
    use HasFactory;

    protected $table = 'movimientos_bancarios';

    protected $fillable = [
        'descripcion', 'monto', 'fecha', 'ref', 'tipo_movimiento', 'conciliado', 'cuenta_bancaria_id' 
    ];

    public function cuenta_bancaria()
    {
        return $this->belongsTo(CuentaBancaria::class);
    }
}
