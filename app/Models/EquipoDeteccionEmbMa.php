<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EquipoDeteccion;
use App\Models\DatosGeneralesEmbMa;

class EquipoDeteccionEmbMa extends Model
{
    use HasFactory;
    protected $table = 'equipos_deteccion_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'EqpoDeteccionid',
        'DGEMMAid',
    ];
    public $timestamps = true;

    public function EquipoDeteccion()
    {
        return $this->belongsTo(EquipoDeteccion::class, 'EqpoDeteccionid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
