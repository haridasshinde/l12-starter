<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillRegistrationdemo extends Model
{
    use HasFactory;

    protected $table = 'tmbill_registrationdemo';

    protected $primaryKey = 'mobile';

    public $timestamps = false;

    protected $fillable = ['id', 'name', 'email', 'address', 'blockingId', 'RecoveryId', 'blockingFlag', 'ResonForBlocking', 'UnblockTime', 'StartDate', 'EndDate', 'DemoTime', 'DemoFreeDays'];
}
