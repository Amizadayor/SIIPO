<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesEmbMa;
use App\Models\MotorEmbMA;

class MotorPorEmbMa extends Model
{
    use HasFactory;
    protected $table = 'motores_por_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'DGEMMAid',
        'MtrEmbMaid',
    ];
    public $timestamps = true;

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }

    public function MotorEmbMA()
    {
        return $this->belongsTo(MotorEmbMA::class, 'MtrEmbMaid', 'id');
    }
}
