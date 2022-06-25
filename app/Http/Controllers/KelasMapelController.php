<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\KelasMapel;
use Illuminate\Http\Request;

class KelasMapelController extends Controller
{
    public function index()
    {
        $data = Kelas::get();
        $data->map(function($a) {
            $a->action = '<span class="btn btn-primary edit mr-2" title="Tambah Mapel" data-id="'.$a->id.'">Tambah Mapel</span>';
            return $a;
        });

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function klik($idk, $idm)
    {
        $data = KelasMapel::where([['kelas_id', $idk], ['mapel_id', $idm]])->first();
        if(!empty($data)){
            $data->delete();
            return response()->json(false);
        } else {
            $data = KelasMapel::create(['kelas_id' => $idk, 'mapel_id' => $idm]);
            return response()->json(true);
        }
    }

    public function indexmapel()
    {
        $data = Mapel::get();

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
        $data = Kelas::with('kelasmapel')->find($id);

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function edit(Request $request)
    {
        
        $data = Kelas::with('kelas_mapel')->find($request->data['id']);
        $data->update(['nama_kelas' => $request->data['nama_kelas']]);

        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }
}
