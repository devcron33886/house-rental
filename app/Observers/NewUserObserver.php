<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\NewUserRegisteredNotification;
use Illuminate\Support\Facades\Notification;

class NewUserObserver
{
    /**
     * @param User $user
     */
    public function created(User $user)
    {
        $users = User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users,new NewUserRegisteredNotification($user));
    }
}
