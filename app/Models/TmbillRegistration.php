<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillRegistration extends Model
{
    protected $table = 'tmbill_registration';

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
        13 => 'registration_flag',
        14 => 'token',
        15 => 'isEdgeAppBlocked',
        16 => 'password',
    ];
}
