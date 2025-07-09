<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($action, $target = null, $description = null)
    {
        $user = Auth::user();

        ActivityLog::create([
            'user_id'     => $user?->id,
            'user_name'   => $user?->name,
            'action'      => $action,
            'target_type' => $target ? get_class($target) : null,
            'target_id'   => $target->id ?? null,
            'description' => $description,
        ]);
    }
}
