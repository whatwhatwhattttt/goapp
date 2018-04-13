<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
class adminuser extends User
{
    protected $fillable = [
        'username','password',
    ];
}
