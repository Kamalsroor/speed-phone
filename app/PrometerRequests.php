<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrometerRequests extends Model
{
    protected $table = 'prometerrequests';

    public $fillable = [
        'CustomerNames',
        'Prodact_name',
        'acc_name',
        'accormobiles',
        'totals',
        'user_id',
        'active',
    ];



    // public function permission_ex_Details_freight() {
    //     return $this->hanMany('App\permission_ex_Details_freight', 'permission_ex_id', 'id');
    // }
    public function Customersed() {
        return $this->belongsTo('App\Customers', 'CustomerNames', 'id');
    }
    public function UserMod() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
