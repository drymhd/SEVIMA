<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn', 'alamat', 'deskripsi', 'foto', 'user_id'
    ];
}
