<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillAppactivation extends Model
{
    protected $table = 'tmbill_appactivation';

    public $timestamps = false;

    protected $fillable = [
        0 => 'Product_key',
        1 => 'name',
        2 => 'mobile',
        3 => 'start_date',
        4 => 'end_date',
        5 => 'durationIn_days',
        6 => 'activation_status',
        7 => 'Activate_trial_flag',
        8 => 'deviceUseCount',
        9 => 'IsExpired',
    ];
}
