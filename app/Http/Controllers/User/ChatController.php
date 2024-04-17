<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendMessageRequest;
use App\Repositories\UserRepositoryInterface;

class ChatController extends Controller
{
    protected $userRepository ;
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function chatForm($user_id)
    {
        $receiver = $this->userRepository->get($user_id);
        $messages = Message::where(function($query) use ($user_id) {
            $query->where('receiver_id', $user_id)
                  ->where('sender_id', Auth::user()->id);
        })
        ->orWhere(function($query) use ($user_id) {
            $query->where('receiver_id', Auth::user()->id)
                  ->where('sender_id', $user_id);
        })
        ->get();

        return view('chatForm', compact('receiver','messages'));
    }
    public function sendMessage(SendMessageRequest $request)
    {
        $data = $request->validated();
        $this->userRepository->sendMessage($data['user_id'],$data['message']);
        return response()->json('Message Sent');
    }
}
