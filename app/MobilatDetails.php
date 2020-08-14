<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilatDetails extends Model
{
    protected $table = 'mobilat_details';

    public $fillable = [
        'Prodact_name',
        'CustomerNames',
        'sirarnamber',
        'date',
        'MobilatExID',
        'MobilatEntID',
        'MobilatRecallID',
        'action',
        'user_id',
        'active',
        'ACC',
    ];


    public function MobilatEnt() {
        return $this->belongsTo('App\MobilatEnt', 'MobilatEntID', 'id');
    }
    public function MobilatEx() {
        return $this->belongsTo('App\MobilatEx', 'MobilatExID', 'id');
    }
    public function MobilatMod() {
        return $this->belongsTo('App\Mobilat', 'Prodact_name', 'id');
    }
    public function CustomersMod() {
        return $this->belongsTo('App\Customers', 'CustomerNames', 'id');
    }
    public function UserMod() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function ACCtest() {
        return $this->belongsTo('App\ACC', 'Prodact_name', 'id');
    }

    

    
}
