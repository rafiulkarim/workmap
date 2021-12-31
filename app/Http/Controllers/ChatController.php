<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function chat_request(Request $request){
        $chatRequest = new ChatRequest;
        $chatRequest->client_id = $request->client_id;
        $chatRequest->freelancer_id = $request->freelancer_id;

        $checkChatList = ChatRequest::where(['client_id'=>$request->client_id, 'freelancer_id'=>$request->freelancer_id])
            ->first();
        if (!$checkChatList){
            $query = $chatRequest->save();
            if ($query){
                return response()->json(array('data'=>200));
            }
        }else{
            return response()->json(array('error'=>200));
        }
    }

    public function message(Request $request, $id=null){
        $title = 'Message';
        $messages = [];
        $user_id = Auth::user()->id;
        $other_user = null;
        if ($id){
            $other_user = User::findOrFail($id);
            $group_id = (Auth::user()->id > $id)?Auth::user()->id.$id:$id.Auth::user()->id;
            $messages = Chat::where('group_id','=', $group_id)->get()->toArray();
            Chat::where(['user_id'=>$id, 'other_user_id'=>$user_id, 'is_read'=>0])->update(['is_read'=>1]);
        }
        $freelancers = ChatRequest::where(['client_id'=>Auth::user()->id])
            ->select('*', DB::raw("(SELECT count(id) from chats where chats.other_user_id = $user_id and chats.user_id = chat_requests.client_id and is_read = 0) as unread_message"))
            ->get();
        $clients = ChatRequest::where(['freelancer_id'=>Auth::user()->id])
            ->get();
        return view('message', compact(['title', 'freelancers', 'clients', 'other_user', 'messages', 'id']));
    }

}
