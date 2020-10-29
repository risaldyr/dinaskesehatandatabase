<?php

namespace App;



use Illuminate\Database\Eloquent\Model;


class User_Violation extends Model
{
    protected $table = 'user_violations';
    protected $fillable = [
        'user_id', 'note', 'keterangan'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
