<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;

    protected $table = 'cheques';

    protected $fillable = [
        'beneficiario', 'concepto', 'monto', 'fecha', 'num_cheque', 'estado', 'chequera_id' 
    ];

    public function chequera()
    {
        return $this->belongsTo(Chequera::class);
    }

    public function cheque_detalles()
    {
        return $this->hasMany(ChequeDetalle::class);
    }
}
