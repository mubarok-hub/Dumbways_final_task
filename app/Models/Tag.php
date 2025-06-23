<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['nama'];

    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'kegiatan_tag');
        // relasi many-to-many ke model Kegiatan lewat tabel pivot 'kegiatan_tag'
    }
}