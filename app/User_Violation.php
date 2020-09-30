<?php

namespace App;



use Illuminate\Database\Eloquent\Model;


class User_Violation extends Model
{
    protected $fillable = [
        'user_id', 'note'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
