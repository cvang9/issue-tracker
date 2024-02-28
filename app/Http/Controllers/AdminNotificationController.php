<?php

namespace App\Http\Controllers;

use App\Models\AdminNotifications;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    
    public function getLatestNotifications()
    {
        $notifications = AdminNotifications::latest()->limit(5)->get();

        return response()->json($notifications);
    }
}
