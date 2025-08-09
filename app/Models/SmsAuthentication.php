<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsAuthentication extends Model
{
    protected $table = 'sms_authentication';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['username', 'api_key', 'sender_id', 'peid', 'tempid', 'api_flag', 'author_name', 'total_sms', 'total_used_sms', 'total_left_sms', 'user_id', 'created_by', 'updated_by', 'is_active', 'remark', 'created_at', 'updated_at'];
}
