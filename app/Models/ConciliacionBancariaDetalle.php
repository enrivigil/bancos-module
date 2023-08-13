<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciliacionBancariaDetalle extends Model
{
    use HasFactory;

    protected $table = 'conciliacion_bancaria_detalles';

    protected $fillable = [
        'conciliacion_bancaria_id', 'movimiento_bancario_id' 
    ];

    public function conciliacion_bancaria()
    {
        return $this->belongsTo(ConciliacionBancaria::class);
    }

    public function movimiento_bancario()
    {
        return $this->belongsTo(MovimientoBancario::class);
    }
}
