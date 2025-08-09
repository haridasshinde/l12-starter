<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillRetailerRegistration extends Model
{
    protected $table = 'tmbill_retailer_registration';

    public $timestamps = false;

    protected $fillable = [
        0 => 'name',
        1 => 'email',
        2 => 'mobile',
        3 => 'address',
        4 => 'col1',
        5 => 'col2',
    ];
}
