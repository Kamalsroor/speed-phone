<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilatEx extends Model
{
    protected $table = 'mobilat_ex';

    public $fillable = [
        'CustomerNames',
        'premission_id',
        'order_id',
        'date',
        'accormobiles',
        'totals',
        'active',
        'note',
        'user_id'
    ];

    public function MobilatExDetails() {
        return $this->hasMany('App\MobilatDetails', 'MobilatExID', 'id');
    }
    public function Customersed() {
        return $this->belongsTo('App\Customers', 'CustomerNames', 'id');
    }

}
