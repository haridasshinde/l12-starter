<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillKappregistration extends Model
{
    protected $table = 'tmbill_kappregistration';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['Name', 'Mobile', 'Email', 'Business name', 'Address', 'CurrrentActiveDevice', 'ActiveDeviceLimit', 'OTP'];
}
