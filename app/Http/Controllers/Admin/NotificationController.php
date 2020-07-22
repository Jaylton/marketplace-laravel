<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(){
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', compact('notifications'));
    }

    public function readAll(){
        $notifications = auth()->user()->unreadNotifications;
        $notifications->each(function($n){
            $n->markAsRead();
        });
        flash('Notificações lidas com sucesso')->success();
        return redirect()->back();
    }

    public function readNotification($id){
        $notifications = auth()->user()->notifications()->find($id);
        $notifications->markAsRead();
        flash('Notificação marcada como lida')->success();
        return redirect()->back();
    }
}
