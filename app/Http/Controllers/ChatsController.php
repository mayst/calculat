<?php

namespace App\Http\Controllers;

//use LRedis;
use App\User;
use App\Message;
use App\Dialog;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessageAdded;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function listDialogs()
    {
        $user = Auth::user();
//        ->where('talkers', 'like', "$user->id %")->orWhere('talkers', 'like', "% $user->id")
//        $list_dialogs = Dialog::where('talkers', 'like', "$user->id %")->orWhere('talkers', 'like', "% $user->id")->paginate(1);
        /*$sort_d = Dialog::with(['lastMsg' => function($query) {
                $query->orderBy('created_at', 'asc');
            }]);*/
//        $list_dialogs = Dialog::with('lastMsg')->where('talkers', 'like', "$user->id %")->orWhere('talkers', 'like', "% $user->id")->paginate(1);
//        $list_dialogs = $sort_d->paginate(10);

        $dialogs = Dialog::where('talkers', 'like', "$user->id %")->orWhere('talkers', 'like', "% $user->id")->get();

        $mass = [];
        foreach($dialogs as $dialog) {
            $mass[] = $dialog->lastMsg->id;
        }

        $list_dialogs = Dialog::join('messages', 'dialogs.id', '=', 'messages.dialog_id')
                            ->select('messages.*', 'dialogs.*')
                            ->whereIn('messages.id', $mass)
//                            ->whereIn('dialogs.id', [1, 2, 3])
                            ->orderBy('messages.created_at', 'desc')
                            ->paginate(1);

        $recipients = [];
        foreach($list_dialogs as $dialog) {
            $recipient = ($dialog->lastMsg->receiver == $user->id) ? $dialog->lastMsg->user : $dialog->lastMsg->recipient;
            $recipient->avatar = $recipient->avatar();
            $recipients[] = $recipient;
        }

        /* Send as JSON */
        header("Content-Type: application/json", true);

        echo json_encode(['dialogs' => $list_dialogs, 'recipients' => $recipients, 'asd' => $dialogs]);
    }

    public function history(Request $request)
    {
        $user = Auth::user();

        $unread = Message::where([
            ['user_id', '=', $user->id],
            ['receiver', '=', $request->rec_id],
            ['status', '=', false]
        ])
            ->orWhere([
                ['user_id', '=', $request->rec_id],
                ['receiver', '=', $user->id],
                ['status', '=', false]
            ])
            ->orderBy('created_at', 'desc');

        $unread_sort_m = $unread->get();
        $unread->update(['status' => true]);

        $read_sort_m = Message::where([
                ['user_id', '=', $user->id],
                ['receiver', '=', $request->rec_id],
                ['status', '=', true]
            ])
            ->orWhere([
                ['user_id', '=', $request->rec_id],
                ['receiver', '=', $user->id],
                ['status', '=', true]
            ])->orderBy('created_at', 'desc');

        $messages = $read_sort_m->paginate(3);

        return response()->json([ 'avatar' => User::find($request->rec_id)->avatar(), 'read_messages' => $messages, 'unread_messages' =>$unread_sort_m ]);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */

    public function SENDm(Request $request) {
        $user = Auth::user();

        $message = Message::create([
            'user_id' => $user->id,
            'message' => $request->input('message'),
            'receiver' => $request->input('receiver')
        ]);

        event(
            new NewMessageAdded($user, $message)
        );

        return  response()->json([$message]);
    }
}
