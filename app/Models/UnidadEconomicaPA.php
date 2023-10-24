<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Oficina;

class UnidadEconomicaPA extends Model
{
    use HasFactory;
    protected $table = 'unidadeconomica_pa';
    protected $primaryKey = 'id';
    protected $fillable = ['Ofcid', 'FechaRegistro', 'RNPA'];
    public $timestamps = true;

    public function Oficina()
    {
        return $this->belongsTo(Oficina::class, 'Ofcid', 'id');
    }
}
