<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id', 'siswa_id', 'isi_jawaban'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'siswa_id');
    }
}
