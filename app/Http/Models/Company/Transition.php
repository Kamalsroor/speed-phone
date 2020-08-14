<?php

namespace App\Http\Models\Company;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    protected $table = 'transitions';

    protected $fillable = [
        'company_id',
        'comp_user_id',
        'amount',
        'description',
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    
    public function user() {
        return $this->belongsTo('App\CompUser', 'comp_user_id', 'id');
    }

    public function transition_details() {
        return $this->hasMany('App\Http\Models\Company\TransitionDetails', 'transition_id', 'id');
    }
}
