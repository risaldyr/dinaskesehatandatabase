<?php

namespace App;



use Illuminate\Database\Eloquent\Model;


class User_Task extends Model
{
    public $table = 'user_tasks';

    protected $fillable = [
        'user_id', 'task'
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
