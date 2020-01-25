<?php

namespace App\Listeners;

use App\Events\User\LoggedIn;


class UserEventsSubscriber
{
    public function __construct(){}

    public function onLogin(LoggedIn $event)
    {
        $user = $event->getLoginUser();
        $userDetails = [
            'firstname'     =>  $user->firstname,
            'lastname'      =>  $user->lastname,
            'email'         =>  $user->email
        ];
        
        // Set user details to session
        session($userDetails);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'App\Listeners\UserEventsSubscriber';

        $events->listen(LoggedIn::class, "{$class}@onLogin");
    }
}
