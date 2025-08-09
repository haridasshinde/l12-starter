<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillKappcurrentlogindevice extends Model
{
    use HasFactory;

    protected $table = 'tmbill_kappcurrentlogindevices';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['Product_key', 'DeviceIMEI', 'Usermobile', 'isActive', 'LogInTime', 'LogOutTime', 'Manufacturer', 'AndroidVersion', 'model', 'location', 'osName'];
}
