<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';

    public $fillable = [
        'name',
        'user_id',

    ];


    // public function permission_ex_Details_freight() {
    //     return $this->hanMany('App\permission_ex_Details_freight', 'permission_ex_id', 'id');
    // }

}
