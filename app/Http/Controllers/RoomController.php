<?php

namespace App\Http\Controllers;

use App\Models\GuruKelas;
use App\Models\Kelas;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $data = Room::where('id_guru', Auth::user()->id)->get();
        return response()->json(['data' => $data]);
    }

    public function indexkelas()
    {
        $data = GuruKelas::with('kelas')->where('guru_id', Auth::user()->id)->get();

        return response()->json(['data' => $data]);
    }

    public function tambah(Request $request)
    {
        $chek = Room::where([['id_kelas', $request->data['kelas_id']], ['id_guru', Auth::user()->id]])->get();

        if (!count($chek) == 0) {

            return response()->json(['status' => false], 400);
        }

        $data = Room::create([
            'nama_room' => $request->data['nama_kelas'],
            'id_kelas' => $request->data['kelas_id'],
            'id_guru' => Auth::user()->id,
        ]);
        return response()->json(['status' => true]);
    }
}
