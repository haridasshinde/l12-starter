<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillTrackUser extends Model
{
    protected $table = 'tmbill_track_user';

    public $timestamps = false;

    protected $fillable = [
        0 => 'name',
        1 => 'mobile',
        2 => 'email',
        3 => 'LogInTime',
        4 => 'LogOutTime',
        5 => 'date',
        6 => 'macaddress',
    ];
}
