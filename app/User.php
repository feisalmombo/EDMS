<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['remember_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public static function checkLogin($name, $password)
    {
        $user = User::whereName($name)->first();

        if (!$user) {
            return null;
        }

        if (Hash::check($password, $user->password)) {
            return $user;
        } else {
            return null;
        }
    }
}
