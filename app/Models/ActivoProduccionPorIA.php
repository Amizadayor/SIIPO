<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesIA;
use App\Models\ActivoProduccionIA;

class ActivoProduccionPorIA extends Model
{
    use HasFactory;
    protected $table = 'activos_produccion_por_ia';
    protected $primaryKey = 'id';
    protected $fillable = [
        'DGIAid',
        'APIAid'
    ];
    public $timestamps = true;

    public function DatosGeneralesIA()
    {
        return $this->belongsTo(DatosGeneralesIA::class, 'DGIAid', 'id');
    }

    public function ActivoProduccionIA()
    {
        return $this->belongsTo(ActivoProduccionIA::class, 'APIAid', 'id');
    }
}
