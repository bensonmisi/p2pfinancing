<?php

namespace App\Notifications;

use App\Models\withdrawals;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class disbursementNotification extends Notification
{
    use Queueable;

    private $withdrawable;
    private $name;
    public function __construct(withdrawals $withdrawable,$name)
    {
        $this->withdrawable = $withdrawable;
        $this->name = $name;
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
            ->greeting('Dear  '.$this->name)
            ->subject('Cash Collection Notification')
            ->line('Collector Name: '.$this->withdrawable->collector_name)
            ->line('Collector Surname: '.$this->withdrawable->collector_surname)
            ->line('Collector Phone: '.$this->withdrawable->collector_phone)
            ->line('Collector National ID: '.$this->withdrawable->collector_natid)
            ->line('Collection Code: '.$this->withdrawable->collection_code)
            ->line('Amount Collect USD$ '.$this->withdrawable->amount)
            ->line('Collection Date '.$this->withdrawable->update_at)
             ->line('Thank you for using our application!');;
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
