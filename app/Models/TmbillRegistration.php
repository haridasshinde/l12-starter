<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillRegistration extends Model
{
    protected $table = 'tmbill_registration';
    protected $primaryKey = 'mobile';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'email', 'address', 'blockingId', 'RecoveryId', 'blockingFlag', 'ResonForBlocking', 'UnblockTime', 'StartDate', 'EndDate', 'DemoTime', 'DemoFreeDays', 'registration_flag', 'token', 'isEdgeAppBlocked', 'password'];
}
