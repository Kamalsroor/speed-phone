<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customersfreight extends Model
{
    protected $table = 'customersfreight';

    public $fillable = [
        'name',
        'user_id',

    ];

    public function AccountCustomers() {
        return $this->hanMany('App\AccountCustomers', 'customersname', 'id');
   }

}
