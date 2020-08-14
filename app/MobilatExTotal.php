<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilatExTotal extends Model
{
    protected $table = 'mobilatextotal';

    public $fillable = [
        'MobilatExtotalID',
        'Prodact_name',
        'totalss',

        

    ];

    public function MobilatEx() {
        return $this->belongsTo('App\MobilatEx', 'MobilatExtotalID', 'id');
    }
    public function Mobilat() {
        return $this->belongsTo('App\Mobilat', 'Prodact_name', 'id');
    }
    public function Acc() {
        return $this->belongsTo('App\ACC', 'Prodact_name', 'id');
    }

}
