<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeskBillItem extends Model
{
    protected $table = 'desk_bill_items';

    public $timestamps = false;

    protected $fillable = [
        0 => 'bill_no',
        1 => 'item_id',
        2 => 'item_name',
        3 => 'qty',
        4 => 'price',
        5 => 'is_with_option',
        6 => 'option_name',
    ];
}
