<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionDetalle extends Model
{
    use HasFactory;

    protected $table = 'transaccion_detalles';

    protected $fillable = [
        'concepto', 'codigo_conta', 'cuenta_conta', 'debe', 'haber', 'transaccion_id' 
    ];

    public function transaccion()
    {
        return $this->belongsTo(Transaccion::class);
    }
}
