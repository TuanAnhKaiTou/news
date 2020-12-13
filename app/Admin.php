<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Admin extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'password',
        'full_name',
        'role_id'
    ];
    protected $hidden = ['password'];
}
