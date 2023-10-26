<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArtePesca;
use App\Models\Especie;
use App\Models\DatosGeneralesEmbMa;

class ArteEquipoPescaEmbMa extends Model
{
    use HasFactory;
    protected $table = 'artes_equipo_pesca_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'TPArtPescaid',
        'TPEspecieid',
        'Cantidad',
        'Longitud',
        'Altura',
        'Malla',
        'Material',
        'Reinales',
        'DGEMMAid',
    ];
    public $timestamps = true;

    public function ArtePesca()
    {
        return $this->belongsTo(ArtePesca::class, 'TPArtPescaid', 'id');
    }

    public function Especie()
    {
        return $this->belongsTo(Especie::class, 'TPEspecieid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
