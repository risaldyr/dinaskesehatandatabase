<?php

namespace App;



use Illuminate\Database\Eloquent\Model;


class Qrcode extends Model
{
    protected $fillable = [
        'user_id', 'code', 'use'
    ];


}
