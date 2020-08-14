<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class operation extends Model
{
    protected $table = 'operation';

    public $fillable = [
        'policyID',
        'resourceinvoiceID',
        'resourceinvoiceAmount',
        'CCOTEC',
        'resourceinvoiceCCOTECAmount',
        'policyWeight',
        'kiloAmount',
        'AllAmount',
    ];

    public function operationDetails() {
        return $this->hanMany('App\operationDetails', 'operationID', 'id');
    }

}
