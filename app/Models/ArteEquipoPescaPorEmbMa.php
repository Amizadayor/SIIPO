<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArteEquipoPescaEmbMa;
use App\Models\DatosGeneralesEmbMa;

class ArteEquipoPescaPorEmbMa extends Model
{
    use HasFactory;
    protected $table = 'artes_equipopescapor_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ArteEquipoPescaEmMaid',
        'DGEMMAid'];
    public $timestamps = true;

    public function ArteEquipoPescaEmbMa()
    {
        return $this->belongsTo(ArteEquipoPescaEmbMa::class, 'ArteEquipoPescaEmbMaid', 'id');
    }

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
