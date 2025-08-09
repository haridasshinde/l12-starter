<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeskBillCustomer extends Model
{
    protected $table = 'desk_bill_customers';

    protected $primaryKey = 'cust_mobile';

    public $timestamps = false;

    protected $fillable = [
        0 => 'id',
        1 => 'customer_name',
        2 => 'address',
        3 => 'time',
    ];
}
