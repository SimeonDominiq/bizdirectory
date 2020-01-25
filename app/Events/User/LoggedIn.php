<?php

namespace App\Events\User;

use App\User;

class LoggedIn 
{
    /**
     * @var User
     */
    private $loggedInUser;

    /**
     * Registered constructor.
     * @param User $LoginUser
     */
    public function __construct(User $loggedInUser)
    {
        $this->LoginUser = $loggedInUser;
    }

    /**
     * @return User
     */
    public function getLoginUser()
    {
        return $this->LoginUser;
    }
}
