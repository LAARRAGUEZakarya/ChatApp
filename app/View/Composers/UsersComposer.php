<?php

namespace App\View\Composers;

use App\Repositories\UserRepositoryInterface;
use Illuminate\View\View;

class UsersComposer
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function compose(View $view)
    {
        $data = $this->userRepository->allExceptAuth();
        $view->with('users' ,$data);
    }
}
