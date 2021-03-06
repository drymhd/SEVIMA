<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_room', 'id_guru', 'id_kelas'
    ];

    public function RoomKelas()
    {
        return $this->belongsToMany(Kelas::class, 'room_kelas', 'room_id', 'kelas_id');
    }

    public function Materi()
    {
        return $this->hasMany(Materi::class, 'id_room', 'id');
    }
}
