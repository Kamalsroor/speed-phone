<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompUser extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $fillable = [
        'company_id',
        'user_id',
        'name',
        'email',
        'password',
        'phone',
        'work_place',
        'job',
        'lang',
        'rule',
        'status',
        'approved',
        'date_approved',
        'date_expire'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}
