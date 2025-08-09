<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillSmsUsage extends Model
{
    protected $table = 'tmbill_sms_usages';

    protected $primaryKey = 'tracking_id';

    public $timestamps = false;

    protected $fillable = [
        0 => 'id',
        1 => 'name',
        2 => 'api_key',
        3 => 'sender_id',
        4 => 'username',
        5 => 'sms_count_initial',
        6 => 'sms_count_remaining',
        7 => 'sms_count_used',
        8 => 'timestamp',
    ];
}
