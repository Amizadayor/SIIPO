<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArtePesca;
use App\Models\PermisoPescaPA;

class ArtePescaPermiso extends Model
{
    use HasFactory;
    protected $table = 'arte_pesca_permisos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'TPArtPescaid',
        'PPPAid'
    ];
    public $timestamps = true;

    public function ArtePesca()
    {
        return $this->belongsTo(ArtePesca::class, 'TPArtPescaid');
    }

    public function PermisoPescaPA()
    {
        return $this->belongsTo(PermisoPescaPA::class, 'PPPAid');
    }
}
