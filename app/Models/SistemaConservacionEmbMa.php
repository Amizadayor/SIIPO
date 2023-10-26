<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SistemaConservacion;
use App\Models\DatosGeneralesEmbMa;

class SistemaConservacionEmbMa extends Model
{
    use HasFactory;
    protected $table = 'sistemas_conservacion_emb_ma';

    protected $primaryKey = 'id';

    protected $fillable = [
        'SisConservacionid',
        'DGEMMAid',
    ];

    public $timestamps = true;
    public function SistemaConservacion()
    {
        return $this->belongsTo(SistemaConservacion::class, 'SisConservacionid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
