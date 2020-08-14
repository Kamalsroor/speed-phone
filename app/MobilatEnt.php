<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilatEnt extends Model
{
    protected $table = 'mobilat_ent';

    public $fillable = [
        'CustomerNames',
        'premission_id',
        'order_id',
        'date',
        'accormobiles',
        'totals',
        'user_id',
    ];
    public function CustomersMod() {
        return $this->belongsTo('App\Customers', 'CustomerNames', 'id');
    }
    public function MobilatEntDetails() {
        return $this->hasMany('App\MobilatDetails', 'MobilatEntID', 'id');
    }
    public function UserMod() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
