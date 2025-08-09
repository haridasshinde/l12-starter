<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillPayment extends Model
{
    protected $table = 'tmbill_payments';

    protected $primaryKey = 'order_id';

    public $timestamps = false;

    protected $fillable = [
        0 => 'id',
        1 => 'mobile_no',
        2 => 'plan_id',
        3 => 'amount',
        4 => 'payment_mode',
        5 => 'payment_status',
        6 => 'transaction_id',
        7 => 'payment_date',
        8 => 'col1',
        9 => 'col2',
        10 => 'col3',
    ];
}
