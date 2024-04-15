<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Message;
use App\Http\Controllers\Controller;
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
        return view('pages/chat', compact('receiver'));
    }
}
