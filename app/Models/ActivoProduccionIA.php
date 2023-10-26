<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesIA;
use App\Models\TipoActivo;

class ActivoProduccionIA extends Model
{
    use HasFactory;
    protected $table = 'activos_produccion_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Clave',
        'Cantidad',
        'Largo',
        'Ancho',
        'Altura',
        'Capacidad',
        'UnidadMedida',
        'DGIAid',
        'TPActivoid'
    ];

    public $timestamps = true;
    public function DatosGeneralesIA()
    {
        return $this->belongsTo(DatosGeneralesIA::class, 'DGIAid', 'id');
    }

    public function TipoActivo()
    {
        return $this->belongsTo(TipoActivo::class, 'TPActivoid', 'id');
    }
}
