<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnidadEconomicaPA;

class UnidadEconomicaEmbMe extends Model
{
    use HasFactory;
    protected $table = 'unidadeconomica_emb_me';
    protected $primaryKey = 'id';
    protected $fillable = [
        'RNPA',
        'Nombre',
        'UEDueno',
    ];
    public $timestamps = true;
    public function UnidadEconomicaPA()
    {
        return $this->belongsTo(UnidadEconomicaPA::class, 'UEDueno', 'id');
    }
}
