<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillProductKeyHistory extends Model
{
    protected $table = 'tmbill_product_key_history';

    public $timestamps = false;

    protected $fillable = [
        0 => 'name',
        1 => 'email',
        2 => 'mobile',
        3 => 'product_key',
        4 => 'time',
        5 => 'date',
        6 => 'payment_mode',
        7 => 'product_type',
        8 => 'order_id',
        9 => 'col2',
        10 => 'col3',
    ];
}
