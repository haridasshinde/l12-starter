<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillKappcurrentlogindevice extends Model
{
    protected $table = 'tmbill_kappcurrentlogindevices';

    public $timestamps = false;

    protected $fillable = [
        0 => 'Product_key',
        1 => 'DeviceIMEI',
        2 => 'Usermobile',
        3 => 'isActive',
        4 => 'LogInTime',
        5 => 'LogOutTime',
        6 => 'Manufacturer',
        7 => 'AndroidVersion',
        8 => 'model',
        9 => 'location',
        10 => 'osName',
    ];
}
