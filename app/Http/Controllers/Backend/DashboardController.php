<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\RoomInfo;
use App\Models\RoomClass;
use App\Models\User;
class DashboardController extends Controller
{
    public function index():View
    {

        return view("backend.pages.dashboard",[
            'total_rooms' => RoomInfo::get()->count(),
            'total_room_class' => RoomClass::get()->count(),
            'users' => User::get()->count(),
        ]);
    }
}
