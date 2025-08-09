<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskBillItem extends Model
{
    use HasFactory;

    protected $table = 'desk_bill_items';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['bill_no', 'item_id', 'item_name', 'qty', 'price', 'is_with_option', 'option_name'];
}
