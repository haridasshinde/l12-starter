<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillCampaign extends Model
{
    protected $table = 'tmbill_campaign';

    public $timestamps = false;

    protected $fillable = [
        0 => 'name',
        1 => 'restaurant_name',
        2 => 'email',
        3 => 'mobile',
        4 => 'city',
        5 => 'created_at',
    ];
}
