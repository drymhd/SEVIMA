<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Materi;
use App\Models\Tugas;
use Illuminate\Http\Request as R;

class MateriController extends Controller
{
    public function index($id)
    {
        $data = Materi::with(['tugas', 'jawaban'])->find($id);
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
    public function jawaban(R $request,$id)
    {
        if (request()->wantsJson() && request()->ajax()) {
            // Set Request Per Page
            $per = (($request->per) ? $request->per : 10);
            
            // Get User By Search And Per Page
            $user = Jawaban::with('user')->where('materi_id', $id)->where(function($q) use ($request) {
                $q->where('isi_jawaban', 'LIKE', '%'.$request->search.'%');
                // ->orWhere('email', 'LIKE', '%'.$request->search.'%');
            })->orderBy('id','asc')->paginate($per);

            // Add Columns
            $user->map(function($a) {
                $a->action = '<span class="btn btn-sm btn-clean btn-icon btn-icon-md btn-detail" title="Detail" data-id="'.$a->uuid.'"><i class="la la-eye kt-font-info"></i></span>';
                return $a;
            });
            return response()->json($user);

        }else{
            abort(404);
        }

    }
}
