<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCustomers extends Model
{
    protected $table = 'account_customers';

    public $fillable = [
        'customersname',
        'account',
        'user_id',
        'accountss',
        'permissionEntId',
        'Notes',
        'date',
        

    ];

    // public function permission_ex_Details_freight() {
    //     return $this->hanMany('App\permission_ex_Details_freight', 'permission_ex_id', 'id');
    // }
    
    public function Customersfreight() {
        return $this->belongsTo('App\Customersfreight', 'customersname', 'id');
    }
}
