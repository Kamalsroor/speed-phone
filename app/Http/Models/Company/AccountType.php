<?php

namespace App\Http\Models\Company;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $table = 'account_types';

    protected $fillable = [
        'company_id',
        'comp_user_id',
        'name'
    ];

    public function sub_accounts() {
        return $this->hasMany('App\Http\Models\Company\AccountName', 'account_type_id', 'id');
    }

    public function company() {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\CompUser', 'comp_user_id', 'id');
    }
}
