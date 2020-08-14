<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission_ex_details_freight extends Model
{
    protected $table = 'permission_ex_details_freight';

    public $fillable = [
        'permission_ex_id',
        'user_id',
        'active',
        'TypeOfProduct',
        'ProductName',
        'CustomerNames',
        'Quantity'
    ];

    public function permission_ex_freight() {
        return $this->belongsTo('App\permission_ex_freight', 'permission_ex_id', 'id');
    }
    public function Customersed() {
        return $this->belongsTo('App\Customersfreight', 'CustomerNames', 'id');
    }
    
    public function TypeOfProducttest() {
        return $this->belongsTo('App\TypeOfProduct', 'TypeOfProduct', 'id');
    }


}
