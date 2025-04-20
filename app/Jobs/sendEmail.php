<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\email;
use App\Models\offre;
use Illuminate\Queue\SerializesModels;
use App\Notifications\OffreNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class sendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public offre $offre)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::where('notified',true)->get();
           foreach ($users as $user) {
           $user->notify(new OffreNotification($this->offre));
           }
    $emails=email::select('email');
    foreach($emails as $email){
    Notification::route('mail', $email)->notify(new OffreNotification($this->offre));}
    }
}
