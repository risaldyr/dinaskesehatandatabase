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
            'nama_mentor'=>'required'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->nama = $request->nama;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->alamat = $request->alamat;
        $user->no_telepon = $request->no_telepon;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->instansi = $request->instansi;
        $user->role = 'user';
        $user->nama_mentor = $request->nama_mentor;

        if($user->save()){
            return response()->json([
                'success' => true,
                'message' => 'Registrasi Berhasil!',
                'data' => $user
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Registrasi Gagal!',
                'data' => $user
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

    public function deleteUser($id)
    {
        $user = User::find($id);

        $user->delete();
        return response()->json($user);
    }
}

