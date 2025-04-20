<?php

namespace App\Notifications;

use App\Models\offre;
use App\Models\worker;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CondidatRejected extends Notification
{
    use Queueable;
 protected $offer;
    /**
     * Create a new notification instance.
     */
    public function __construct(offre $offer)
    {
        $this->offer=$offer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Your condidation to  '.$this->offer->titre.'  ,because it does not virify offer conditions ')
                    ->action('Notification Action', url('/'))
                    ->line('Try and apply for other offers ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           'message' => 'Your postulation is rejected  in the offer : ' . $this->offer->titre,
            'offer_id' => $this->offer->id,
        ];
    }
}
