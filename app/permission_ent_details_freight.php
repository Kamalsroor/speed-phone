<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission_ent_details_freight extends Model
{
    protected $table = 'permission_ent_details_freight';

    public $fillable = [
        'permission_ent_id',
        'ProductName',
        'QuantityCharged',
        'Quantityrecipient',
        'Forlack',
        'type_id',
        'user_id',
        'customernames',
        'Tcotpiece',
        'cost',
        'commission',
        'Clearanceprice',
        'totalcost',
        'profit',
        'nitprofit',
        'Flightcost',
        'Weightbearing',
        'othercost',
        'Weightratio',
        'quantitydelivered',
        'wight'
    ];

    public function permission_ent_freight() {
        return $this->belongsTo('App\permission_ent_freight', 'permission_ent_id', 'id');
    }

    
    public function TypeOfProduct() {
        return $this->belongsTo('App\TypeOfProduct', 'type_id', 'id');
    }

    public function Customersed() {
        return $this->belongsTo('App\Customersfreight', 'customernames', 'id');
    }
    public function UserMod() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
