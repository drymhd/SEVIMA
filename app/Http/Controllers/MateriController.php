<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Tugas;
use Illuminate\Http\Request as R;

class MateriController extends Controller
{
    public function index($id)
    {
        $data = Materi::with('tugas')->find($id);
        return response()->json(['data' => $data]);
    }

    public function tambah(R $request ,$id)
    {
        $data = Tugas::create([
            'id_materi' => $id,
            'nama_tugas' => $request->data['nama_tugas'],
            'isi_tugas' => $request->data['isi_tugas'],
        ]);
    }

    public function gettugas($id)
    {
        $data = Tugas::find($id);

        return response()->json(['data' => $data]);
    }

    public function edit(R $request)
    {
        $data = Tugas::find($request->data['id']);

        $data->update([
            'nama_tugas' => $request->data['nama_tugas'],
            'isi_tugas' => $request->data['isi_tugas'],
        ]);

        return response()->json(['status' => true]);
    }
}
