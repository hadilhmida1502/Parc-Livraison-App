<?php

namespace App\Http\Controllers;

use App\Models\Notifications;

class NotificationsController extends Controller
{
	public function notif_ass() {
        $Notifications = Notifications::all();
		return view('pages.notif_ass',compact('Notifications'));
	}
}
