<?php

namespace App\Http\Controllers;

use App\User;
use App\Qrcode;
use Carbon\Carbon;
use App\User_Presence;
use App\User_Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentController extends Controller
{

    //melihat daftar absen
    public function index()
    {
        // $present = User::with(['presences'])->get();

        // return response()->json($present);
        // dd($user);

        return response()->json(User_Presence::all());


    }

    //checkin user
    public function checkin(Request $request)
    {
        // Assign User
        $user = Auth::user();

        // Validate Code
        // $qrcode = Qrcode::where('code', $request->code)->first();
        // if($qrcode->count() == 0){
        //     //gagal
        //     return response()->json('Gagal mendapatkan code', 403);
        // }
        // if(Carbon::now()->greaterThan($qrcode->valid_till)){
        //     // Gagal
        //     return response()->json('Gagal mendapatkan code', 403);
        // }

        // Check Violation
        $violation_check = $user->violations;
        if ($violation_check->count() > 0) {
            if ($violation_check->last()->keterangan == 'on') {
                // Gagal
                return response()->json('Gagal Checkin mohon ke admin', 403);
            }
        }

        // Check Yesterday Checkout
        if ($user->presences->count() > 0 && $user->presences->last()->checkout == null) {
            $violation = new User_Violation();
            $violation->user_id = $user->id;
            $violation->violation_at = $user->presences->last()->created_at;
            $violation->keterangan = 'on';
            $violation->save();

            // Gagal
            return response()->json('Gagal Checkin mohon ke admin', 403);
        }

        //Create Presence
        $presence = new User_Presence();
        $presence->user_id = $user->id;
        $presence->checkin = Carbon::now();

        // Change Qrcode Use to TRUE
        // $qrcode->used = true;
        // $qrcode->save();

        // Success
        if ($presence->save()) {
            // Mantab
            return response()->json('Berhasil', 202);
        }
    }




    //checkout user
    public function checkout(Request $request)
    {

        // Assign User
        $user = Auth::user();

        //Validate Code
        // $qrcode = Qrcode::where('code', $request->code)->first();
        // if($qrcode->count() == 0){
        //     //gagal
        //     return response()->json('Gagal mendapatkan code', 403);
        // }
        // if(Carbon::now()->greaterThan($qrcode->valid_till)){
        //     //gagal
        //     return response()->json('Gagal mendapatkan code', 403);
        // }

        // Check Checkin

        if ($user->presences->count() > 0 && $user->presences->last()->checkin == null) {
            $id = $user->id;
            $presence = User_Presence::where('user_id', $id)->first();
            if (Carbon::today()->greaterThan($presence->checkin))
                //gagal
                return response()->json('Gagal, belum checkin', 403);
        }


        //mengambil data user

        $idUser = $user->id;
        $idPresence = $user->presences->last()->id;
        $presence = User_Presence::where([
            ['user_id', $idUser],
            ['id', $idPresence]
        ])->first();



        //mengubah checkout

        $presence->checkout = Carbon::now();


        // Change Qrcode Use to TRUE
        // $qrcode->used = true;
        // $qrcode->save();

        // Success
        if ($presence->save()) {
            // Mantab
            return response()->json('Berhasil', 202);
        }
    }

    //melihat absen peruser
    public function listPresentUser($id)
    {
        $user = User::find($id);

        $shows = $user->presences()->get();

        foreach ($shows as $show) {
            $data[] = [
                'name' => $show->user->nama,
                'checkin' => $show->checkin,
                'checkout' => $show->checkout,
                'presentId' => $show->id
            ];
        }
        return response()->json($data);
    }

}
