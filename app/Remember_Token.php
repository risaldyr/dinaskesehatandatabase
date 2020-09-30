<?php

namespace App;



use Illuminate\Database\Eloquent\Model;


class Remember_Token extends Model
{
    protected $fillable = [
        'user_id', 'token'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
