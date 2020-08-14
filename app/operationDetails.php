<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class operationDetails extends Model
{
    protected $table = 'operationdetails';

    public $fillable = [
        'operationID',
        'typeID',
        'Product',
        'ChargedAmount',
        'CustomerName',
        
    ];

    public function operation() {
        return $this->belongsTo('App\operation', 'operationID', 'id');
    }

}
