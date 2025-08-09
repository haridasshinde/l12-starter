<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillAppregistration extends Model
{
    use HasFactory;

    protected $table = 'tmbill_appregistration';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['Name', 'Mobile', 'Email', 'Business name', 'Address', 'CurrrentActiveDevice', 'ActiveDeviceLimit', 'OTP'];
}
