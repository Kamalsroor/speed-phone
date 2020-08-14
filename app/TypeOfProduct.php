<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfProduct extends Model
{
    protected $table = 'typeofproducts';

    public $fillable = [
        'name',

    ];

    // public function permission_ex_Details_freight() {
    //     return $this->hanMany('App\permission_ex_Details_freight', 'permission_ex_id', 'id');
    // }

}
