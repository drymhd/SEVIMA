<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::get();
        $data->map(function($a) {
            $a->action = '<span class="btn btn-warning edit mr-2" title="edit" data-id="'.$a->id.'">Edit</span><span class="btn btn-danger hapus" title="hapus" data-id="'.$a->id.'">Hapus</span>';
            return $a;
        });

        return response()->json(['data' => $data, 'status' => true]);
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
