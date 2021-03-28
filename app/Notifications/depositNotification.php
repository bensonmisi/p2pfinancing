<?php

namespace App\Notifications;

use App\Models\currency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class depositNotification extends Notification
{
    use Queueable;

    private  $amount;
    private  $receiptnumber;

    public function __construct($amount,$receiptnumber)
    {

         $this->amount = $amount;
         $this->receiptnumber = $receiptnumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have successfully deposited funds into  your account ')
                    ->line('Receipt number:'.$this->receiptnumber)
                    ->line('Amount: $'.$this->amount)
                    ->action('Visit Account', url('/'))
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
            //
        ];
    }
}
