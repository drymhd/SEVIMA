<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id', 'kelas_id'
    ];
}
