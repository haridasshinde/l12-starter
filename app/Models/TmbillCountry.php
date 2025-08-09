<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillCountry extends Model
{
    protected $table = 'tmbill_country';

    public $timestamps = false;

    protected $fillable = [
        0 => 'iso',
        1 => 'name',
        2 => 'nicename',
        3 => 'iso3',
        4 => 'numcode',
        5 => 'phonecode',
        6 => 'phone_length',
    ];
}
