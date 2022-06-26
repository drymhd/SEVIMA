<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if (request()->wantsJson() && request()->ajax()) {
            // Set Request Per Page
            $per = (($request->per) ? $request->per : 10);
            
            // Get User By Search And Per Page
            $user = Kelas::where(function($q) use ($request) {
                $q->where('nama_kelas', 'LIKE', '%'.$request->search.'%');
            })->orderBy('id','asc')->paginate($per);

            // Add Columns
            $user->map(function($a) {
                $a->action = '<span class="btn btn-warning edit mr-2" title="edit" data-id="'.$a->id.'">Edit</span><span class="btn btn-danger hapus" title="hapus" data-id="'.$a->id.'">Hapus</span>';
                return $a;
            });
            return response()->json($user);

        }else{
            abort(404);
        }
    }

    public function tambah(Request $request)
    {
        $data = Kelas::create([
            'nama_kelas' => $request->data['nama_kelas']
        ]);

        if(!empty($data)){
            return response()->json(['status' => true]);
        }
        
    }
    
    public function hapus($id)
    {
        $data = Kelas::find($id);
        $data = $data->delete();
        
        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }

    public function get($id)
    {
        $data = Kelas::find($id);

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function edit(Request $request)
    {
        
        $data = Kelas::find($request->data['id']);
        $data->update(['nama_kelas' => $request->data['nama_kelas']]);

        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }
}
