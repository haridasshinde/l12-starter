<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeskBillCustomer extends Model
{
    protected $table = 'desk_bill_customers';
    protected $primaryKey = 'tracking_id';
    public $timestamps = false;
    protected $fillable = ['id', 'customer_name', 'address', 'time'];
}
