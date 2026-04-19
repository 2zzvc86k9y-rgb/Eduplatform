<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function SendMessage(Request $request){
        $request->validate([
            'message' => 'required'
        ]);

        ChatMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        return response()->json(['message' => 'Message sent successfully']);
    }// end method

    public function LiveChat(){
        return view('frontend.dashboard.live_chat');
    }//end method

    // public function GetAllUsers(){

    //     $chats = ChatMessage::orderBy('id','DESC')->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id())->get();
    //     $user = $chats->flatMap(function($chat){
    //         if ($chat->sender_id === auth()->id()) {
    //             return [$chat->sender, $chat->receiver];
    //         }
    //         return [$chat->receiver, $chat->sender];
    //     })->unique('id');
    //     return $chats;
    // }

    // public function GetAllUsers() {
    //     $chats = ChatMessage::orderBy('id', 'DESC')
    //                         ->where('sender_id', Auth::id())
    //                         ->orWhere('receiver_id', Auth::id())
    //                         ->get();

    //     $users = $chats->flatMap(function($chat) {
    //         if ($chat->sender_id === auth()->id()) {
    //             return [$chat->sender, $chat->receiver];
    //         }
    //         return [$chat->receiver, $chat->sender];
    //     })->unique('id');

    //     return [
    //         'chats' => $chats,
    //         'users' => $users,
    //     ];
    // }


    // ->with(['sender', 'receiver'])
    public function GetAllUsers() {
        $chats = ChatMessage::orderBy('id', 'DESC')
                            ->where('sender_id', Auth::id())
                            ->orWhere('receiver_id', Auth::id())
                             ->get();

        $users = $chats->flatMap(function($chat) {
            if ($chat->sender_id === auth()->id()) {
            return [$chat->sender, $chat->receiver];
            }
            return [ $chat->receiver, $chat->sender];
        })->unique('id'); 

        return $users;
    }//end method

    // public function GetUserMessage($userId){
    //     $user = User::find($userId );
    //     if ($user) {
    //         $messages = ChatMessage::where(function($q) use ($userId){
    //                   $q->where('sender_id',auth()->id());
    //                   $q->where('receiver_id',$userId);
    //                   })->orWhere(function($q) use ($userId){
    //                      $q->where('sender_id',$userId);
    //                      $q->where('receiver_id',auth()->id());
    //                   })->with('user')->get();

    //                   return response()->json([
    //                      'user' => $user,
    //                      'messages' => $messages,
    //                   ]);
    //      }else {
    //          abort(404);
    //      }
    // }


    
    
    public function GetUserMessage($userId) {
        $user = User::find($userId);
        if ($user) {
            $messages = ChatMessage::where(function($q) use ($userId) {
                $q->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
            })->orWhere(function($q) use ($userId) {
                $q->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
            })->with('user')->get();
    
            return response()->json([
                'user' => $user,
                'messages' => $messages,
            ]);
        } else {
            abort(404);
        }
    }
    
    

    //instructor live chat 
    public function InstructorLiveChat(){
        return view('instructor.chat.live_chat');
    }





    

}
