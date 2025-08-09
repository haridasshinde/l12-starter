<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillPlan extends Model
{
    protected $table = 'tmbill_plans';

    public $timestamps = false;

    protected $fillable = [
        0 => 'plan_id',
        1 => 'plan_name',
        2 => 'validity',
        3 => 'amount',
        4 => 'col1',
        5 => 'col2',
        6 => 'col3',
    ];
}
