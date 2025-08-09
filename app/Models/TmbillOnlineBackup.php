<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillOnlineBackup extends Model
{
    protected $table = 'tmbill_online_backup';

    protected $primaryKey = 'backup_id';

    public $timestamps = false;

    protected $fillable = [
        0 => 'tmbill_tracking_id',
        1 => 'owner_mobile',
        2 => 'backup_date',
        3 => 'backup_time',
        4 => 'backup_link',
        5 => 'email',
    ];
}
