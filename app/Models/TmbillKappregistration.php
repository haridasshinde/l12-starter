<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillKappregistration extends Model
{
    protected $table = 'tmbill_kappregistration';

    public $timestamps = false;

    protected $fillable = [
        0 => 'Name',
        1 => 'Mobile',
        2 => 'Email',
        3 => 'Business name',
        4 => 'Address',
        5 => 'CurrrentActiveDevice',
        6 => 'ActiveDeviceLimit',
        7 => 'OTP',
    ];
}
