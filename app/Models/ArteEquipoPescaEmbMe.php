<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArtePesca;
use App\Models\Especie;
use App\Models\DatosGeneralesEmbMe;

class ArteEquipoPescaEmbMe extends Model
{
    use HasFactory;
    protected $table = 'artes_equipo_pesca_emb_me';
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
        'DGEMMEid',
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

    public function DatosGeneralesEmbMe()
    {
        return $this->belongsTo(DatosGeneralesEmbMe::class, 'DGEMMEid', 'id');
    }
}
