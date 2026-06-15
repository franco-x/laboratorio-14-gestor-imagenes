<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'album_id',
        'foto_nombre',
        'foto_descripcion',
        'foto_ruta',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}