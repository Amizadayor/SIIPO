<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EquipoNavegacion;
use App\Models\DatosGeneralesEmbMa;

class EquipoNavegacionEmbMa extends Model
{
    use HasFactory;
    protected $table = 'equipos_navegacion_emb_ma';

    protected $primaryKey = 'id';
    protected $fillable = [
        'EqpoNavegacionid',
        'DGEMMAid',
    ];

    public $timestamps = true;

    public function EquipoNavegacion()
    {
        return $this->belongsTo(EquipoNavegacion::class, 'EqpoNavegacionid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
