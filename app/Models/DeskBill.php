<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeskBill extends Model
{
    protected $table = 'desk_bill';
    protected $primaryKey = 'tracking_id';
    public $timestamps = false;
    protected $fillable = ['id', 'total_person', 'bill_date1', 'bill_time', 'total_amount', 'table_no', 'discount_amt', 'igst', 'cgst', 'sgst', 'tax_rate', 'order_type', 'tax_amount', 'discount_id', 'customer_id', 'delivery_boy_id', 'payment_id', 'employee_id', 'bill_status', 'taken_by', 'paid_by', 'comment', 'dummy_no', 'online_order_id', 'sync_time'];
}
