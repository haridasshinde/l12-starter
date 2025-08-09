<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillPromocodehistory extends Model
{
    protected $table = 'tmbill_promocodehistory';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = [
        0 => 'orderId',
        1 => 'customerName',
        2 => 'customerMobile',
        3 => 'address',
        4 => 'offerPromoName',
        5 => 'promoCode',
        6 => 'promoCodeType',
        7 => 'date',
        8 => 'time',
        9 => 'discountType',
        10 => 'discountedAmount',
        11 => 'totalAmount',
        12 => 'validity',
        13 => 'status',
    ];
}
