<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillPromocodehistory extends Model
{
    protected $table = 'tmbill_promocodehistory';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = ['orderId', 'customerName', 'customerMobile', 'address', 'offerPromoName', 'promoCode', 'promoCodeType', 'date', 'time', 'discountType', 'discountedAmount', 'totalAmount', 'validity', 'status'];
}
