<?php

namespace App\Notifications;

use App\Models\House;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification
{
    use Queueable;

    /** @var User */

    private $houseUser;

    /** @var House */
    private $house;

    /**
     * Create a new notification instance.
     *
     * @param House $house
     */
    public function __construct(House $house)
    {
        $this->house = $house;
        $this->houseUser = $house->user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New posts from'.trans('site_title'))
                    ->line($this->houseUser->name.'has posted new.'.$this->house->title)
                    ->action('Notification Action', url('Check it out','http:://house.test/house'.$this->house->id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'level'=> 'info',
            'message' => 'New House'.$this->house->title,
            'url' => ' http://house.test/house'.$this->house->id,
            'target' => '_self',
        ];
    }
}
