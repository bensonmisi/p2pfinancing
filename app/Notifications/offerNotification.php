<?php

namespace App\Notifications;

use App\Models\loan_offers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class offerNotification extends Notification
{
    use Queueable;
   private $offer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(loan_offers $offer)
    {
      $this->offer = $offer;
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
                   ->line('An offer  has been made for your loan application')
                   ->line('Amount Offer: USD'.$this->offer->amount)
                   ->line('Interest Rate: '.$this->offer->percentage.'%')
                   ->line('Please login to you account to accept or deny loan application')
                    ->action('Goto Portal', url('/'))
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
