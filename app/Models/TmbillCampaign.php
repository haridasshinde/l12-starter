<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillCampaign extends Model
{
    protected $table = 'tmbill_campaign';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'restaurant_name', 'email', 'mobile', 'city', 'created_at'];
}
