<?php

namespace App\Http\Controllers;

use App\Models\GuruDetail;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $data = User::where('level', 'guru')->get();
        $data->map(function($a) {
            $a->action = '<span class="btn btn-warning edit mr-2" title="edit" data-id="'.$a->id.'">Edit</span><span class="btn btn-danger hapus" title="hapus" data-id="'.$a->id.'">Hapus</span>';
            return $a;
        });

        return response()->json(['data' => $data, 'status' => true]);
    }
    
    public function indexkelas()
    {
        $data = Mapel::get();
        return response()->json(['data' => $data, 'status' => true]);
    }

    public function tambah(Request $request)
    {
        $data = User::create([
            'name' => $request->data['name'],
            'password' => bcrypt($request->data['name']),
            'level' => 'guru',
            'email' => $request->data['email']
        ]);

        if(!empty($data)){
            $siswadetail = GuruDetail::create(['nip' => $request->data['nip'], 'alamat' => $request->data['alamat'], 'mapel_id' => $request->data['mapel_id'], 'deskripsi' => $request->data['deskripsi'], 'user_id' => $data->id]);
            if(!empty($siswadetail)){
                return response()->json(['status' => true]);
            }
            return response()->json(['status' => false], 400);
        }
        return response()->json(['status' => false], 400);
        
    }
    
    public function hapus($id)
    {
        $data = User::find($id);
        $data = $data->delete();
        
        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }

    public function get($id)
    {
        $data = User::with('GuruDetail')->find($id);

        $data->nisn = $data->GuruDetail->nisn;
        $data->alamat = $data->GuruDetail->alamat;
        $data->mapel_id = $data->GuruDetail->mapel_id;
        $data->deskripsi = $data->GuruDetail->deskripsi;

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function edit(Request $request)
    {
        
        $data = User::find($request->data['id']);
        $data->update([
            'name' => $request->data['name'],
            'email' => $request->data['email']
        ]);

        $detail = GuruDetail::where('user_id', $request->data['id']);
        $detail->update(['nisn' => $request->data['nisn'], 'alamat' => $request->data['alamat'], 'mapel_id' => $request->data['mapel_id'], 'deskripsi' => $request->data['deskripsi'], 'user_id' => $data->id]);

        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }
}