<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas'];

    public function kelasmapel()
    {
        return $this->belongsToMany(Mapel::class, 'kelas_mapels', 'kelas_id', 'mapel_id');
    }

}
