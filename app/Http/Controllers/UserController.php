<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\SiswaDetail;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::where('level', 'siswa')->get();
        $data->map(function($a) {
            $a->action = '<span class="btn btn-warning edit mr-2" title="edit" data-id="'.$a->id.'">Edit</span><span class="btn btn-danger hapus" title="hapus" data-id="'.$a->id.'">Hapus</span>';
            return $a;
        });

        return response()->json(['data' => $data, 'status' => true]);
    }
    
    public function indexkelas()
    {
        $data = Kelas::get();
        return response()->json(['data' => $data, 'status' => true]);
    }

    public function tambah(Request $request)
    {
        $data = User::create([
            'name' => $request->data['name'],
            'password' => bcrypt($request->data['password']),
            'level' => 'siswa',
            'email' => $request->data['email']
        ]);

        if(!empty($data)){
            $siswadetail = SiswaDetail::create(['nisn' => $request->data['nisn'], 'alamat' => $request->data['alamat'], 'kelas_id' => $request->data['kelas_id'], 'deskripsi' => $request->data['deskripsi'], 'user_id' => $data->id]);
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
        $data = User::with('SiswaDetail')->find($id);

        $data->nisn = $data->SiswaDetail->nisn;
        $data->alamat = $data->SiswaDetail->alamat;
        $data->kelas_id = $data->SiswaDetail->kelas_id;
        $data->deskripsi = $data->SiswaDetail->deskripsi;

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function edit(Request $request)
    {
        
        $data = User::find($request->data['id']);
        $data->update([
            'name' => $request->data['name'],
            'email' => $request->data['email']
        ]);

        $detail = SiswaDetail::where('user_id', $request->data['id']);
        $detail->update(['nisn' => $request->data['nisn'], 'alamat' => $request->data['alamat'], 'kelas_id' => $request->data['kelas_id'], 'deskripsi' => $request->data['deskripsi'], 'user_id' => $data->id]);

        if($data){
            return response()->json(['status' => true]);
            
        }
        return response()->json(['status' => false], 400);
    }
}
