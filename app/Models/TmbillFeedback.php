<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillFeedback extends Model
{
    protected $table = 'tmbill_feedback';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['category', 'name', 'mobile', 'email', 'msg', 'type_software', 'date', 'col3'];
}
