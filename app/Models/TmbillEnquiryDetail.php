<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillEnquiryDetail extends Model
{
    protected $table = 'tmbill_enquiry_details';

    public $timestamps = false;

    protected $fillable = [
        0 => 'name',
        1 => 'email',
        2 => 'mobile',
        3 => 'required_date',
        4 => 'comment',
        5 => 'trial_date',
        6 => 'amount',
        7 => 'ref_from',
        8 => 'product_name',
        9 => 'address',
        10 => 'date',
        11 => 'created_at',
    ];
}
