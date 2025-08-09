<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillPayment extends Model
{
    use HasFactory;

    protected $table = 'tmbill_payments';

    protected $primaryKey = 'order_id';

    public $timestamps = false;

    protected $fillable = ['id', 'mobile_no', 'plan_id', 'amount', 'payment_mode', 'payment_status', 'transaction_id', 'payment_date', 'col1', 'col2', 'col3'];
}
