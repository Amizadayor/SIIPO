<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Especie;
use App\Models\DatosGeneralesEmbMa;

class EspecieEmbMa extends Model
{
    use HasFactory;
    protected $table = 'especies_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'TPEspecieid',
        'DGEMMAid',
    ];
    public $timestamps = true;

    public function Especie()
    {
        return $this->belongsTo(Especie::class, 'TPEspecieid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
