<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillTrackUser extends Model
{
    protected $table = 'tmbill_track_user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'mobile', 'email', 'LogInTime', 'LogOutTime', 'date', 'macaddress'];
}
