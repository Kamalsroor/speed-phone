<?php

namespace App;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    public $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'lang',
        'rule',
        'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function companies() {
        return $this->hanMany('App\Company', 'user_id', 'id');
    }

    public function companies_users() {
        return $this->hanMany('App\CompUser', 'user_id', 'id');
    }
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
}
