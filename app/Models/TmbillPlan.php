<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmbillPlan extends Model
{
    use HasFactory;

    protected $table = 'tmbill_plans';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['plan_id', 'plan_name', 'validity', 'amount', 'col1', 'col2', 'col3'];
}
