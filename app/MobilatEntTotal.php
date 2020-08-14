<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilatEntTotal extends Model
{
    protected $table = 'mobilatenttotal';

    public $fillable = [
        'MobilatEnttotalID',
        'Prodact_name',
        'totalss',

        

    ];

    public function MobilatEx() {
        return $this->belongsTo('App\MobilatEnt', 'MobilatEnttotalID', 'id');
    }
    public function Mobilat() {
        return $this->belongsTo('App\Mobilat', 'Prodact_name', 'id');
    }
    public function Acc() {
        return $this->belongsTo('App\ACC', 'Prodact_name', 'id');
    }

}
