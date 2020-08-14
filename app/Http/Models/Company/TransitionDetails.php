<?php

namespace App\Http\Models\Company;

use Illuminate\Database\Eloquent\Model;

class TransitionDetails extends Model
{
    protected $table = 'transition_details';

    protected $fillable = [
        'company_id',
        'comp_user_id',
        'transition_id',
        'account_type_id',
        'account_name_id',
        'action',
        'amount'
    ];

    public function company() {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\CompUser', 'comp_user_id', 'id');
    }

    public function transition() {
        return $this->belongsTo('App\Http\Models\Company\Transition', 'transition_id', 'id');
    }

    public function account_type() {
        return $this->belongsTo('App\Http\Models\Company\AccountType', 'account_type_id', 'id');
    }

    public function account_name() {
        return $this->belongsTo('App\Http\Models\Company\AccountName', 'account_name_id', 'id');
    }
}
