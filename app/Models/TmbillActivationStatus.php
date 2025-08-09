<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillActivationStatus extends Model
{
    use HasFactory;

    protected $table = 'tmbill_activation_status';

    protected $primaryKey = 'product';

    public $timestamps = false;

    protected $fillable = ['id', 'name', 'mobile', 'email', 'start_date', 'end_date', 'duration', 'activation_status', 'mac_address', 'type_software', 'col1', 'col2', 'col3'];
}
