<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
        'concepto', 'monto', 'fecha', 'tipo_transaccion', 'cuenta_bancaria_id' 
    ];

    public function cuenta_bancaria()
    {
        return $this->belongsTo(CuentaBancaria::class);
    }

    public function transaccion_detalles()
    {
        return $this->hasMany(TransaccionDetalle::class);
    }
}
