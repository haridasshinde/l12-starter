<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillFeedback extends Model
{
    protected $table = 'tmbill_feedback';

    public $timestamps = false;

    protected $fillable = [
        0 => 'category',
        1 => 'name',
        2 => 'mobile',
        3 => 'email',
        4 => 'msg',
        5 => 'type_software',
        6 => 'date',
        7 => 'col3',
    ];
}
