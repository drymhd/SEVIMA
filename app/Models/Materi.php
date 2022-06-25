<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = ['id_room', 'nama_materi', 'isi_materi'];

    public function tugas()
    {
        return $this->hasOne(Tugas::class, 'id_materi', 'id');
    }

    
    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'materi_id', 'id');
    }
}
