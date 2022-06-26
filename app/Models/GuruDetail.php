<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruDetail extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'alamat', 'deskripsi', 'foto', 'user_id', 'mapel_id'];

    public function mapel()
    {
        return $this->hasOne(Mapel::class, 'id', 'mapel_id');
    }
}
