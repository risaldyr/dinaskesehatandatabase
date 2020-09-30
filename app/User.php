<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements  AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'nama', 'jenis_kelamin', 'no_telepon', 'instansi', 'role', 'deleted_at', 'nama_mentor', 'alamat', 'tgl_lahir'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    use SoftDeletes;

    protected $dates = ['deleted_at'];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function remember_token()
    {
        return $this->hasOne(Remember_Token::class);
    }
    public function user_presences()
    {
        return $this->hasMany(User_Presence::class);
    }
    public function user_tasks()
    {
        return $this->hasMany(User_Task::class);
    }
    public function user_Violations()
    {
        return $this->hasMany(User_Violation::class);
    }
}
