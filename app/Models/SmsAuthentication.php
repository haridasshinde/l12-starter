<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsAuthentication extends Model
{
    protected $table = 'sms_authentication';

    public $timestamps = false;

    protected $fillable = [
        0 => 'username',
        1 => 'api_key',
        2 => 'sender_id',
        3 => 'peid',
        4 => 'tempid',
        5 => 'api_flag',
        6 => 'author_name',
        7 => 'total_sms',
        8 => 'total_used_sms',
        9 => 'total_left_sms',
        10 => 'user_id',
        11 => 'created_by',
        12 => 'updated_by',
        13 => 'is_active',
        14 => 'remark',
        15 => 'created_at',
        16 => 'updated_at',
    ];
}
