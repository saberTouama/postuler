<?php

namespace App\Notifications;

use App\Models\offre;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OffreNotification extends Notification
{
    use Queueable;

    protected $offre;
    /**
     * Create a new notification instance.
     */
    public function __construct(offre $offre )
    {
       $this->offre=$offre;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

            return ['mail']; // Use 'broadcast' for real-time notifications


    }

    /**
     * Get the mail representation of the notification.
     */

    public function toMail(object $notifiable): MailMessage
    { $offre=$this->offre;
  $tools = DB::table('tools')
    ->join('offer_tools', 'tools.id', '=', 'offer_tools.tool_id')
    ->where('offer_tools.offer_id', $offre->id)
    ->select('tools.*')
    ->get();
        return (new MailMessage)
        ->subject(' new job offer')
                    ->line('A new Job offre published for : '.$this->offre->titre)
                    ->action('View offre details', url('/offre-detaille/'.$this->offre->id))
                    ->line('Can be Your dream job!')
                    ->view('offre.offerMail',[
            'offre' => $this->offre,
            'tools'=>$tools,
        ]); // Ble view for the email content
                  //  ->with(['offre' => $this->offre]); // Pass data to the view
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [

        ];
    }
}
