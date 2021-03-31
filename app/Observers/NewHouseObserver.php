<?php

namespace App\Observers;

use App\Models\House;
use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\NewPostNotification;

class NewHouseObserver
{
    /**
     * Handle the House "created" event.
     *
     * @param House $house
     * @return void
     */
    public function created(House $house)
    {
        User::all()->except($house->user->id)->each(function(User $user) use ($house){
            $user->notify(new NewPostNotification($house));
        });
        Subscriber::all()->each(function (Subscriber $subscriber) use ($house){
            $subscriber->notify(new NewPostNotification($house));
        });

    }


}
