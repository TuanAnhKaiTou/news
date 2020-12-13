<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens;

    protected $fillable = [
        'username',
        'password',
        'full_name',
        'email',
        'phone',
        'avatar',
        'role_id'
    ];
    protected $hidden = ['password'];

    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function getFullAvatarAttribute() {
        if (empty($this->avatar)) {
            return null;
        }

        return request()->getSchemeAndHttpHost(). '/avatar_user/'. $this->avatar;
    }
}
