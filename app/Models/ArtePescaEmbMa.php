<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArtePesca;
use App\Models\DatosGeneralesEmbMa;

class ArtePescaEmbMa extends Model
{
    use HasFactory;
    protected $table = 'artes_pesca_emb_ma';
    protected $primaryKey = 'id';

    protected $fillable = [
        'TPArtPescaid',
        'DGEMMAid',
    ];

    public $timestamps = true;

    public function ArtePesca()
    {
        return $this->belongsTo(ArtePesca::class, 'TPArtPescaid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
