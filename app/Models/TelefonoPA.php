<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DatosGeneralesPA;

class TelefonoPA extends Model
{
    use HasFactory;
    protected $table = 'telefonos_pa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Numero',
        'Tipo',
        'DGPAid',
    ];
    public $timestamps = true;

    public function DatosGeneralesPA()
    {
        return $this->belongsTo(DatosGeneralesPA::class, 'DGPAid', 'id');
    }
}
