<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillActivationStatus extends Model
{
    protected $table = 'tmbill_activation_status';

    protected $primaryKey = 'product';

    public $timestamps = false;

    protected $fillable = [
        0 => 'id',
        1 => 'name',
        2 => 'mobile',
        3 => 'email',
        4 => 'start_date',
        5 => 'end_date',
        6 => 'duration',
        7 => 'activation_status',
        8 => 'mac_address',
        9 => 'type_software',
        10 => 'col1',
        11 => 'col2',
        12 => 'col3',
    ];
}
