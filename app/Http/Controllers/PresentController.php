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
    public function index($token)
    {
        /*
        1. $Admin harus mendapatkan token
        2. true dapat melihat daftar absen (yang berisi nama, absen checkin dan checkout, berapa kali melakukan kesalahan)
            false 'tidak ada token'
        */
    }

    //checkin user
    public function checkin(Request $request)
    {
        // Assign User
        $user = Auth::user();

        // Validate Code
        $qrcode = Qrcode::where('code', $request->code)->first();
        if($qrcode->count() == 0){
            // Gagal
        }
        if(Carbon::now()->greaterThan($qrcode->valid_till)){
            // Gagal
        }

        // Check Violation
        $violation_check = $user->violations;
        if($violation_check->count() > 0 ){
            if($violation_check->last()->keterangan == 'on'){
                // Gagal
            }
        }

        // Check Yesterday Checkout
        if($user->presences->count() > 0 && $user->presences->last()->checkout == null){
            $violation = new User_Violation();
            $violation->user_id = $user->id;
            $violation->violation_at = $user->presences->last()->created_at;
            $violation->keterangan = 'on';
            $violation->save();

            // Gagal
        }

        //Create Presence
        $presence = new User_Presence();
        $presence->user_id = $user->id;
        $presence->checkin = Carbon::now();

        // Change Qrcode Use to TRUE
        $qrcode->used = true;
        $qrcode->save();

        // Success
        if($presence->save()){
            // Mantab
        }

    }




    //checkout user
    public function checkout($token, $qrcode)
    {
        /*
        1. $user harus mendapatkan token
        2. user harus mengirimkan tugas
        3. true akan mendapatkan qrcode
            false 'blm mendapatkan token' / 'limit code'/ 'tugas blm diterima'
        */
    }

    //melihat absen peruser
    public function listPresentUser(Request $request, $id)
    {
        /**1. $Admin harus mendapatkan token
         * 2. mencari $user
         * 3. true akan mendapatkan user
         *      false 'blm mendapatkan token' / 'user tidak ada'
         */
        //Mencari user
        $user = User::find($id);

        $shows = $user->user_presence()->get();

        foreach ($shows as $show)
            $data[] = [
                'name' => $show->user->nama,
                //absen berapa kali
                //kesalahan berapa kali
            ];
    }

    //melihat absen hari
    public function listPresentDay($token)
    {
        /**
         * 1. $admin harus mendapatkan token
         * 2. true mendapatkan list harian absen(yang berisi absen user dihari tertentu)
         *  false 'blm mendapatkan token'
         */
    }

    //melihat absen minggu
    public function listPresentWeek($token)
    {
        /**
         * 1. $admin harus mendapatkan token
         * 2. true mendapatkan list mingguan absen(yang berisi absen user dihari tertentu)
         *  false 'blm mendapatkan token'
         */
    }

    //melihat absen bulan
    public function listPresentMonth($token)
    {
        /**
         * 1. $admin harus mendapatkan token
         * 2. true mendapatkan list bulanan absen (yang berisi absen user dihari tertentu)
         *  false 'blm mendapatkan token'
         */
    }

    //alasan tidak absen
    public function userViolationAbsent($token)
    {
        /**
         * 1. $admin harus mendapatkan token
         * 2. user tidak absen di qrcode
         * 3. true admin dapat menulis note kesalahan yang dilakukan
         * false 'blm mendapatkan token' / 'absen memenuhi'
         */
    }

    //melihat daftar kesalahan disatu user
    public function userViolation($id)
    {
        /**
         * 1. $admin harus mendapatkan token
         */
    }
}
