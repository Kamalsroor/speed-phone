<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilatEntDetails extends Model
{
    protected $table = 'mobilat_ent_details';

    public $fillable = [
        'Prodact_name',
        'CustomerNames',
        'sirarnamber',
        'date',
        'qualityacc',
        'MobilatEntID'
        

    ];

    public function MobilatEx() {
        return $this->belongsTo('App\MobilatEnt', 'MobilatEntID', 'id');
    }
    public function Mobilat() {
        return $this->belongsTo('App\Mobilat', 'Prodact_name', 'id');
    }
    public function Acc() {
        return $this->belongsTo('App\ACC', 'Prodact_name', 'id');
    }

}
