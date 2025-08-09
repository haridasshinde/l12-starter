<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillAppactivation extends Model
{
    protected $table = 'tmbill_appactivation';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['Product_key', 'name', 'mobile', 'start_date', 'end_date', 'durationIn_days', 'activation_status', 'Activate_trial_flag', 'deviceUseCount', 'IsExpired'];
}
