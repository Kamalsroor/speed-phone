<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public $fillable = [
        'user_id',
        'name',
        'address',
        'employment',
        'description',
        'company_logo',
        'phone',
        'email',
        'website',
        'status',
        'approved',
        'date_approved',
        'date_expire',
        'sort'
    ];

    public function companies_users() {
        return $this->hanMany('App\CompUser', 'company_id', 'id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
