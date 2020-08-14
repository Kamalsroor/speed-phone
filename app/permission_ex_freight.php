<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission_ex_freight extends Model
{
    protected $table = 'permission_ex_freight';

    public $fillable = [
        'CustomerNames',
        'active',
        'user_id',
        'PermissionDate',
        'Total'
    ];

    public function permission_ex_Details_freight() {
        return $this->hanMany('App\permission_ex_Details_freight', 'permission_ex_id', 'id');
    }
    public function Customersed() {
        return $this->belongsTo('App\Customersfreight', 'CustomerNames', 'id');
    }
    public function UserMod() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
