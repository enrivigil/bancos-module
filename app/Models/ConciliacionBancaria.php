<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConciliacionBancaria extends Model
{
    use HasFactory;

    protected $table = 'conciliaciones_bancarias';

    protected $fillable = [
        'descripcion', 'fecha', 
    ];

    public function conciliacion_bancaria_detalles()
    {
        return $this->hasMany(ConciliacionBancariaDetalle::class);
    }
}
