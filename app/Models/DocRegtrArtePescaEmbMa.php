<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArteEquipoPescaEmbMa;

class DocRegtrArtePescaEmbMa extends Model
{
    use HasFactory;
    protected $table = 'docs_regtr_artespesca_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'DocFacturaElectronica',
        'DocNotaRemision',
        'DocFacturaEndosada',
        'DocTestimonial',
        'ArteEquipoPescaEmbMaID',
    ];
    public $timestamps = true;

    public function ArteEquipoPescaEmbMa()
    {
        return $this->belongsTo(ArteEquipoPescaEmbMa::class, 'ArteEquipoPescaEmMaID', 'id');
    }
}
