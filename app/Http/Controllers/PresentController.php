<?php

namespace App\Http\Controllers;

use App\User;
use App\User_Presence;
use App\User_Violation;
use Illuminate\Http\Request;

class PresentController extends Controller
{

    //melihat daftar absen
    public function index($token){
        /*
        1. $Admin harus mendapatkan token
        2. true dapat melihat daftar absen
            false 'tidak ada token'
        */
    }

    //checkin user
    public function checkin($token, $qrcode){
        /*
        1. $user harus mendapatkan token
        2. true akan mendapatkan qrcode
        3. false 'blm ada tokennya' / 'limit code' / 'harus validasi ke admin'
        */
    }

    //checkout user
    public function checkout($token, $qrcode){
        /*
        1. $user harus mendapatkan token
        2. user harus mengirimkan tugas
        3. true akan mendapatkan qrcode
            false 'blm mendapatkan token' / 'limit code'/ 'tugas blm diterima'
        */
    }

    //melihat absen peruser
    public function listPresentUser($token){
        /**1. $Admin harus mendapatkan token
         * 2. mencari $user
         * 3. true akan mendapatkan user
         *      false 'blm mendapatkan token' / 'user tidak ada'
         */
    }

    //melihat absen hari
    public function listPresentDay($token){
        /**
         * 1. $admin harus mendapatkan token
         * 2. true mendapatkan list harian absen
         *  false 'blm mendapatkan token'
         */
    }

    //melihat absen minggu
    public function listPresentWeek($token){
        /**
         * 1. $admin harus mendapatkan token
         * 2. true mendapatkan list mingguan absen
         *  false 'blm mendapatkan token'
         */
    }

    //melihat absen bulan
    public function listPresentMonth($token){
        /**
         * 1. $admin harus mendapatkan token
         * 2. true mendapatkan list bulanan absen
         *  false 'blm mendapatkan token'
         */
    }

    //alasan tidak absen
    public function userViolationAbsent($token){
        /**
         * 1. $admin harus mendapatkan token
         * 2. user tidak absen di qrcode
         * 3. true admin dapat menulis note
         * false 'blm mendapatkan token' / 'absen memenuhi'
         */
    }


}
