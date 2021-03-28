<?php

namespace App\Notifications;

use App\Models\loan_installment_repayments;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class repaymentNotification extends Notification
{
    use Queueable;

     private $installment;
     private $user;
     private $balance;
    public function __construct(loan_installment_repayments $installment,User $user,$balance)
    {
        $this->installment = $installment;
        $this->user = $user;
        $this->balance = $balance;
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
                    ->greeting('Dear '.$this->user->name.' '.$this->user->surname)
                    ->line('You have successfully made a loan repayment of: '.$this->installment->amount)
                    ->line('Remaining loan balance: '.$this->balance)
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
