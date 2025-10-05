<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('exports', function ($user) {
    return $user !== null; // only authenticated users
});
