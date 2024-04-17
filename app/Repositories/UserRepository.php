<?php
namespace App\Repositories;

use App\Events\ChatSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    protected $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function all()
    {
        return $this->user->all();
    }
    public function allExceptAuth()
    {
        return $this->user->all()->where('id','!=',Auth::user()->id);
    }

    public function get($user_id)
    {
        return $this->user->find($user_id);
    }
    public function sendMessage($user_id, $message)
    {
        $data['sender_id'] = Auth::user()->id;
        $data['receiver_id'] = $user_id;
        $data['content'] = $message;


        Message::create($data);

        $receiver = $this->get($user_id);
        \broadcast(new ChatSent($receiver,$message));
    }
}
