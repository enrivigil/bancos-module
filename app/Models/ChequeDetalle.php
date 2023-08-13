<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChequeDetalle extends Model
{
    use HasFactory;

    protected $table = 'cheque_detalles';

    protected $fillable = [
        'concepto', 'codigo_conta', 'cuenta_conta', 'debe', 'haber', 'ref', 'cheque_id' 
    ];

    public function cheque()
    {
        return $this->belongsTo(Cheque::class);
    }
}
