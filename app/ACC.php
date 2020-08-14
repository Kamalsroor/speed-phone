<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ACC extends Model
{
    protected $table = 'accessories';

    public $fillable = [
        'name',
        'user_id',
    ];

    // public function permission_ex_Details_freight() {
    //     return $this->hanMany('App\permission_ex_Details_freight', 'permission_ex_id', 'id');
    // }

}
