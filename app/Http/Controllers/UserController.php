<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\hash;
use App\User;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request,[
            'username'=>'required|unique:users',
            'password'=>'required|min:6',
            'nama'=>'required',
            'jenis_kelamin'=>'in:pria,wanita',
            'alamat'=>'required',
            'no_telepon'=>'required',
            'tgl_lahir'=>'required',
            'instansi'=>'required',
            'role'=>'in:admin,house,user',
            'nama_mentor'=>'required'
        ]);

        $username = $request->input('username');
        $password = Hash::make($request->input('password'));
        $nama = $request->input('nama');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $alamat = $request->input('alamat');
        $no_telepon = $request->input('no_telepon');
        $tgl_lahir = $request->input('tgl_lahir');
        $instansi = $request->input('instansi');
        $role = $request->input('role');
        $nama_mentor = $request->input('nama_mentor');

        $register = User::create([
            'username'=>$username,
            'password'=>$password,
            'nama'=>$nama,
            'jenis_kelamin'=>$jenis_kelamin,
            'alamat'=>$alamat,
            'no_telepon'=>$no_telepon,
            'tgl_lahir'=>$tgl_lahir,
            'instansi'=>$instansi,
            'role'=>$role,
            'nama_mentor'=>$nama_mentor
        ]);
            if($register){
                return response()->json([
                    'success' => true,
                    'message' => 'Registrasi Berhasil!',
                    'data' => $register
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Registrasi Gagal!',
                    'data' => $register
                ], 404);
            }

    }

    public function allshow()
    {
        return response()->json(User::all());
    }

    public function oneshow($id)
    {
        return response()->json(User::find($id));
    }
}

