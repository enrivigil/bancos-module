<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chequera extends Model
{
    use HasFactory;

    protected $table = 'chequeras';

    protected $fillable = [
        'nombre', 'serie', 'num_inicial_cheque', 'num_final_cheque', 'num_actual_cheque', 'cuenta_bancaria_id' 
    ];

    public function cuenta_bancaria()
    {
        return $this->belongsTo(CuentaBancaria::class);
    }
}
