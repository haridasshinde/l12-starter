<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillEnquiryDetail extends Model
{
    use HasFactory;

    protected $table = 'tmbill_enquiry_details';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['name', 'email', 'mobile', 'required_date', 'comment', 'trial_date', 'amount', 'ref_from', 'product_name', 'address', 'date', 'created_at'];
}
