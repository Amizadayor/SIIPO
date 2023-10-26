<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesEmbMa;

class MotorEmbMa extends Model
{
    use HasFactory;
    protected $table = 'motores_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Marca',
        'Modelo',
        'Serie',
        'Potencia',
        'MtrPrincipal',
        'DGEMMAid'
    ];
    public $timestamps = true;

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
