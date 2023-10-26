<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnidadEconomicaPA;

class UnidadEconomicaEmbMa extends Model
{
    use HasFactory;
    protected $table = 'unidadeconomica_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'RNPA',
        'Nombre',
        'ActivoPropio',
        'UEDuenoid',
    ];

    public $timestamps = true;

    public function UnidadEconomicaPA()
    {
        return $this->belongsTo(UnidadEconomicaPA::class, 'UEDuenoid', 'id');
    }
}
