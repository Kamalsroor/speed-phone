<?php

namespace App\Http\Models\Company;

use Illuminate\Database\Eloquent\Model;

class AccountName extends Model
{
    protected $table = 'account_names';

    protected $fillable = [
        'company_id',
        'comp_user_id',
        'account_type_id',
        'name'
    ];

    public function account_type() {
        return $this->belongsTo('App\Http\Models\Company\AccountType', 'account_type_id', 'id');
    }
    public function company() {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }
    public function user() {
        return $this->belongsTo('App\CompUser', 'comp_user_id', 'id');
    }
}
