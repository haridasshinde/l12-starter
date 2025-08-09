<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillPromocode extends Model
{
    protected $table = 'tmbill_promocodes';

    protected $primaryKey = 'promoCode';

    public $timestamps = false;

    protected $fillable = [
        0 => 'Id',
        1 => 'offerPromoName',
        2 => 'promoCodeType',
        3 => 'validity',
        4 => 'extendDays',
        5 => 'startDate',
        6 => 'expirationDate',
        7 => 'validForNumberOfUsers',
        8 => 'promoCodeUsedBy',
        9 => 'validPerUser',
        10 => 'time',
        11 => 'discountType',
        12 => 'discount',
    ];
}
