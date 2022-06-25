<?php

namespace App\Http\Controllers;

use App\Models\GuruKelas;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruKelasController extends Controller
{
    public function index()
    {
        $data = User::with('GuruKelas')->where('id', Auth::user()->id)->first();

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function klik($idg, $idk)
    {
        $data = GuruKelas::where([['guru_id', $idg], ['kelas_id', $idk]])->first();
        if (!empty($data)) {
            $data->delete();
            return response()->json(false);
        } else {
            $data = GuruKelas::create(['kelas_id' => $idk, 'guru_id' => $idg]);
            return response()->json(true);
        }
    }

    public function indexkelas()
    {
        $oi = User::with('GuruDetail')->find(Auth::user()->id);
        $data = Kelas::whereHas('kelasmapel', function ($q) use ($oi) {
            $q->where('mapel_id', $oi->GuruDetail->mapel_id);
        })->get();

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function tambah(Request $request)
    {
        $data = User::create([
            'nama_kelas' => $request->data['nama_kelas']
        ]);

        if (!empty($data)) {
            return response()->json(['status' => true]);
        }
    }
}
