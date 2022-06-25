<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $data = Mapel::get();
        $data->map(function($a) {
            $a->action = '<span class="btn btn-warning edit mr-2" title="edit" data-id="'.$a->id.'">Edit</span><span class="btn btn-danger hapus" title="hapus" data-id="'.$a->id.'">Hapus</span>';
            return $a;
        });

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function tambah(Request $request)
    {
        $data = Mapel::create([
            'nama_mapel' => $request->data['nama_mapel']
        ]);

        if(!empty($data)){
            return response()->json(['status' => true]);
        }
        
    }
    
    public function hapus($id)
    {
        $data = Mapel::find($id);
        $data = $data->delete();
        
        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }

    public function get($id)
    {
        $data = Mapel::find($id);

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function edit(Request $request)
    {
        
        $data = Mapel::find($request->data['id']);
        $data->update(['nama_mapel' => $request->data['nama_mapel']]);

        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }
}
