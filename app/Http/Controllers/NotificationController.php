<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotif() {
        if(Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2) {
            $data = Notification::with('user')->get();
        } else {
            $id = Auth::user()->id;
            $data = Notification::with('user')->whereUserId($id)->get();
        }
        
        return response()->json($data);
    }
}
