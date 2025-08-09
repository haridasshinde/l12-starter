<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeskBillPayment extends Model
{
    protected $table = 'desk_bill_payment';

    protected $primaryKey = 'tracking_id';

    public $timestamps = false;

    protected $fillable = ['id', 'desk_bill_id', 'bill_type', 'amount', 'category', 'remaining_amount'];
}
