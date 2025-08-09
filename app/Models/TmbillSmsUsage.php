<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillSmsUsage extends Model
{
    protected $table = 'tmbill_sms_usages';
    protected $primaryKey = 'tracking_id';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'api_key', 'sender_id', 'username', 'sms_count_initial', 'sms_count_remaining', 'sms_count_used', 'timestamp'];
}
