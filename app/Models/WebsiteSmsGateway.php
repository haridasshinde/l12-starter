<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSmsGateway extends Model
{
    protected $table = 'website_sms_gateway';

    public $timestamps = false;

    protected $fillable = [
        0 => 'user',
        1 => 'api_key',
        2 => 'sender_id',
        3 => 'col1',
        4 => 'col2',
        5 => 'col3',
        6 => 'isActive',
    ];
}
