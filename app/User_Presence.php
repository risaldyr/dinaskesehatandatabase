<?php

namespace App;



use Illuminate\Database\Eloquent\Model;


class User_Presence extends Model
{
    public $timestamps = false;
    public $table = 'user_presences';
    protected $fillable = [
        'user_id', 'type'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
