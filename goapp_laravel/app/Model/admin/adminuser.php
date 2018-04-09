<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatale;
class adminuser extends Authenticatale
{
    protected  $fillable=[
        'username','password'
    ];
}
