<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillActivationExpiredHistory extends Model
{
    use HasFactory;

    protected $table = 'tmbill_activation_expired_history';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['product', 'name', 'mobile', 'email', 'start_date', 'end_date', 'duration', 'activation_status', 'mac_address', 'type_software', 'timeDate'];
}
