<?php

namespace App\Notifications;

use App\Models\offre;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;

class CandidateAccepted extends Notification
{
    use Queueable;
    public $offer;

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
        return ['vonage','database'];
    }

     public function toVonage($notifiable)
    {
        return (new VonageMessage)
                    ->content('you are accepted in the offer '.$this->offer->titre                );
    }
    public function routeNotificationForVonage()
{
     return '213675518700';
}
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
          'message' => 'You are accepted in the offer : ' . $this->offer->titre,
            'offer_id' => $this->offer->id,
        ];
    }
}
