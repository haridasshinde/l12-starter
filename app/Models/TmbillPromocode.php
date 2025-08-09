<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillPromocode extends Model
{
    use HasFactory;

    protected $table = 'tmbill_promocodes';

    protected $primaryKey = 'promoCode';

    public $timestamps = false;

    protected $fillable = ['Id', 'offerPromoName', 'promoCodeType', 'validity', 'extendDays', 'startDate', 'expirationDate', 'validForNumberOfUsers', 'promoCodeUsedBy', 'validPerUser', 'time', 'discountType', 'discount'];
}
