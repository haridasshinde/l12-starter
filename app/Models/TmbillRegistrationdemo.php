<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillRegistrationdemo extends Model
{
    protected $table = 'tmbill_registrationdemo';

    protected $primaryKey = 'mobile';

    public $timestamps = false;

    protected $fillable = [
        0 => 'id',
        1 => 'name',
        2 => 'email',
        3 => 'address',
        4 => 'blockingId',
        5 => 'RecoveryId',
        6 => 'blockingFlag',
        7 => 'ResonForBlocking',
        8 => 'UnblockTime',
        9 => 'StartDate',
        10 => 'EndDate',
        11 => 'DemoTime',
        12 => 'DemoFreeDays',
    ];
}
