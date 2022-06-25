<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\SiswaDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarKelasSiswa extends Controller
{
    public function index(Request $request)
    {
        if (request()->wantsJson() && request()->ajax()) {
            // Set Request Per Page
            $per = (($request->per) ? $request->per : 10);
            

            $check = SiswaDetail::where('user_id',Auth::user()->id)->first();
            // Get User By Search And Per Page
            $user = Room::where('id_kelas', $check->kelas_id)->where(function($q) use ($request) {
                $q->where('nama_room', 'LIKE', '%'.$request->search.'%');
            })->orderBy('id','asc')->paginate($per);

            // Add Columns
            $user->map(function($a) {
                $a->action = '<span class="btn btn-success masuk" title="masuk" data-id="'.$a->id.'">masuk</span>';
                return $a;
            });
            return response()->json($user);

        }else{
            abort(404);
        }
    }
}
