<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission_ent_freight extends Model
{
    protected $table = 'permission_ent_freight';

    public $fillable = [
        'CustomerNames',
        'PermissionDate',
        'Total',
        'TotalW',
        'Priceperkilo',
        'Policynumber',
        'weightawb',
        'invoicevalue',
        'rate',
        'user_id',
        'active',
        'extrafees',

    ];

    public function permission_ent_Details_freight() {
        return $this->hasMany('App\permission_ent_details_freight', 'permission_ent_id', 'id');
    }
    public function Customersed() {
        return $this->belongsTo('App\Customersfreight', 'CustomerNames', 'id');
    }
}
