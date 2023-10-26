<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesEmbMa;

class CaractrsFisEmbMa extends Model
{
    use HasFactory;
    protected $table = 'caractrsfis_emb_ma';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Eslora',
        'Manga',
        'Puntal',
        'Calado',
        'ArqueoNeto',
        'DGEMMAid',
    ];

    public $timestamps = true;

    public function DatosGeneralesEmbMa()
    {
        return $this->belongsTo(DatosGeneralesEmbMa::class, 'DGEMMAid', 'id');
    }
}
