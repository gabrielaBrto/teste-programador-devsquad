<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [ 'nome', 'email', 'password' ];
    
    protected $hidden = [ 'password', 'remember_token', 'api_token' ];

    public $timestamps = false;

}