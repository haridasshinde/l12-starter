<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeskBillPayment extends Model
{
    protected $table = 'desk_bill_payment';

    protected $primaryKey = 'payment_time';

    public $timestamps = false;

    protected $fillable = [
        0 => 'id',
        1 => 'desk_bill_id',
        2 => 'bill_type',
        3 => 'amount',
        4 => 'category',
        5 => 'remaining_amount',
    ];
}
