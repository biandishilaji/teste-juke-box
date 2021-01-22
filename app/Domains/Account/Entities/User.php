<?php

namespace App\Domains\Account\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    public $module = 'account';

    protected $table = 'users';

    protected $guarded = [];

    protected $fillable = [
        'id',
        'document',
        'login',
        'password',
        'name',
        'email',
        'accountant',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $hidden = [
        'password',
    ];

    protected $dates = [
        'deleted_at'
    ];

//    public function getJWTIdentifier()
//    {
//        return $this->getKey();
//    }

//    public function getJWTCustomClaims()
//    {
//        return [];
//    }


}
