<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrometerRequestsDetails extends Model
{
    protected $table = 'prometerrequests_details';

    public $fillable = [
        'Prodact_name',
        'prometerrequestsID',
        'CustomerNames',
        'sirarnamber',
        'qualityacc',
    ];



    public function PrometerRequests() {
        return $this->belongsTo('App\PrometerRequests', 'prometerrequestsID', 'id');
    }

    public function Mobilat() {
        return $this->belongsTo('App\Mobilat', 'Prodact_name', 'id');
    }
}
