<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillCountry extends Model
{
    use HasFactory;

    protected $table = 'tmbill_country';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['iso', 'name', 'nicename', 'iso3', 'numcode', 'phonecode', 'phone_length'];
}
