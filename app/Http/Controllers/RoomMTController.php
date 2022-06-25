<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Room;
use Illuminate\Http\Request as R;

class RoomMTController extends Controller
{
    public function index($id)
    {
        $data = Room::with('materi')->find($id);
        return response()->json(['data' => $data]);
    }

    public function tambah(R $request ,$id)
    {
        $data = Materi::create([
            'id_room' => $id,
            'nama_materi' => $request->data['nama_materi'],
            'isi_materi' => $request->data['isi_materi'],
        ]);
    }
}
