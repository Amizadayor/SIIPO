<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArteEquipoPescaEmbMe;

class DocRegtrArtePescaEmbMe extends Model
{
    use HasFactory;
    protected $table = 'docs_regtr_artespesca_emb_me';
    protected $primaryKey = 'id';
    protected $fillable = [
        'DocFacturaElectronica',
        'DocNotaRemision',
        'DocFacturaEndosada',
        'DocTestimonial',
        'ArteEquipoPescaEmbMeid',
    ];

    public $timestamps = true;

    public function ArteEquipoPescaEmbMe()
    {
        return $this->belongsTo(ArteEquipoPescaEmbMe::class, 'ArteEquipoPescaEmbMeid', 'id');
    }
}
