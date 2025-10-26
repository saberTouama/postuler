<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\email;
use App\Models\offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Queue\SerializesModels;
use App\Notifications\OffreNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class sendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $request)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
 Log::info('request',$this->request);
        $offre = new Offre();
         //   $imagePath = null;
       /* if ($this->request->hasFile('image')) {
            // Store the file in the 'public/cv' directory
            $imagePath = $this->request->file('image')->store('images', 'public');
            $offre->image= $imagePath;
        }*/

            $offre->site=$this->request['website'];

            $offre->titre = $this->request['titre'];
            $offre->company = $this->request['company'];
            $offre->lieu= $this->request['lieu'];
            $offre->nb_post = $this->request['nb_post'];
            $offre->description = $this->request['points'];
            $offre->workowner= $this->request['workowner'];
            $offre->skills = $this->request['skills'];
            $offre->works = $this->request['works'];
            $offre->points=$this->request['points'];
            $offre->tool1= $this->request['tool1'];
            $offre->tool2= $this->request['tool2'];
            $offre->tool3= $this->request['tool3'];
            $offre->image=$this->request['imagePath'];
            $offre->category_id= $this->request['category'];
            $offre->latitude = $this->request['latitude'];
            $offre->longitude = $this->request['longitude'];
           // $offre->tools = json_encode($this->request->tools);

           // Gate::authorize('create',$offre);
 Log:info('offer',$offre->toArray());
            $offre->save();
            $offre->tools()->sync($this->request['tools']);
        $users = User::where('notified',true)->get();
           foreach ($users as $user) {
           $user->notify(new OffreNotification($offre));
           }
    $emails=email::select('email');
    foreach($emails as $email){
    Notification::route('mail', $email)->notify(new OffreNotification($offre));}


    }
}
