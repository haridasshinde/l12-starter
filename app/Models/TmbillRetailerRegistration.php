<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillRetailerRegistration extends Model
{
    protected $table = 'tmbill_retailer_registration';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'mobile', 'address', 'col1', 'col2'];
}
