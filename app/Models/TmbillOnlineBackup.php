<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmbillOnlineBackup extends Model
{
    protected $table = 'tmbill_online_backup';
    protected $primaryKey = 'backup_id';
    public $timestamps = false;
    protected $fillable = ['tmbill_tracking_id', 'owner_mobile', 'backup_date', 'backup_time', 'backup_link', 'email'];
}
