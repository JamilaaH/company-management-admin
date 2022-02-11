<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//notification coté vue
class NotificationController extends Controller
{
    public function readingMessage()
    {
        $messages = Notification::where('notifiable_id', Auth::user()->id)->where('type', 'like', '%NewMessage')->get();
        foreach ($messages as $message ) {
            $message->read_at = now();
            $message->save();
        }

        return response()->json([
            'success'=> 'toutes les notifications "messages" lues',
        ]);

    }

    public function readingTask()
    {
        $taches = Notification::where('notifiable_id', Auth::user()->id)->where('type', 'like', '%NewTask')->get();
        foreach ($taches as $tache ) {
            $tache->read_at = now();
            $tache->save();
        }

        return response()->json([
            'success'=> 'toutes les notifications "taches" lues',
        ]);
    }
}
