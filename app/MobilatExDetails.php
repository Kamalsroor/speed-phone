<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilatExDetails extends Model
{
    protected $table = 'mobilat_ex_details';

    public $fillable = [
        'Prodact_name',
        'CustomerNames',
        'sirarnamber',
        'date',
        'qualityacc',
        'MobilatExID'
        

    ];

    public function MobilatEx() {
        return $this->belongsTo('App\MobilatEx', 'MobilatExID', 'id');
    }
    public function Mobilat() {
        return $this->belongsTo('App\Mobilat', 'Prodact_name', 'id');
    }
    public function Acc() {
        return $this->belongsTo('App\ACC', 'Prodact_name', 'id');
    }

}
