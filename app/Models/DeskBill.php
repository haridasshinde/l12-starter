<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeskBill extends Model
{
    protected $table = 'desk_bill';

    protected $primaryKey = 'bill_date';

    public $timestamps = false;

    protected $fillable = [
        0 => 'id',
        1 => 'total_person',
        2 => 'bill_date1',
        3 => 'bill_time',
        4 => 'total_amount',
        5 => 'table_no',
        6 => 'discount_amt',
        7 => 'igst',
        8 => 'cgst',
        9 => 'sgst',
        10 => 'tax_rate',
        11 => 'order_type',
        12 => 'tax_amount',
        13 => 'discount_id',
        14 => 'customer_id',
        15 => 'delivery_boy_id',
        16 => 'payment_id',
        17 => 'employee_id',
        18 => 'bill_status',
        19 => 'taken_by',
        20 => 'paid_by',
        21 => 'comment',
        22 => 'dummy_no',
        23 => 'online_order_id',
        24 => 'sync_time',
    ];
}
