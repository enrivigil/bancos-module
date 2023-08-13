<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    use HasFactory;

    protected $table = 'cuentas_bancarias';

    protected $fillable = [
        'num_cuenta', 'codigo_conta', 'banco_id' 
    ];

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function chequeras()
    {
        return $this->hasMany(Chequera::class);
    }
}
