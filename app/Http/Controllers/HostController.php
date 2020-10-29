<?php

namespace App\Http\Controllers;

use App\Qrcode;
use Carbon\Carbon;

class HostController extends Controller
{
    public function showQrcode(){
        $code = $this->randomCode(6);

        while(Qrcode::where('code', $code)->get()->count() != 0){
            $code = $this->randomCode(6);
        }

        $qrcode = new Qrcode();
        $qrcode->code = $code;
        $qrcode->valid_till = Carbon::now()->addSeconds(20);
        $qrcode->save();

        return $qrcode->code;
    }

    public function randomCode($length)
    {
        $base = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($base), 1, $length);
    }
}
