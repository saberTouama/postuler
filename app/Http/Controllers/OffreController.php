<?php

namespace App\Http\Controllers;
use App\Models\tool;
use App\Models\User;
use App\Models\Chirp;
use App\Models\email;
use App\Models\offre;
use App\Events\MyEvent;

use App\Models\category;
use App\Models\catigory;
use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Events\JobOfferCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreoffreRequest;
use App\Notifications\OffreNotification;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateoffreRequest;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Routing\Attribute\Route;

class OffreController extends Controller
{

     /* Display a listing of the resource.
     */


        public function index(Request $request)
    {
        // Retrieve all work offers from the database

        $catigories=category::all();
        if ($request->has('category') && $request->category != '') {

            $offres=Offre::where('category_id', $request->category)->paginate(10);
            return view('offre.home', ['offres'=>$offres,'catigories'=>$catigories]);
        }
        if ($request->has('region') && $request->region != '') {


            $offres=Offre::where('lieu', $request->region)->paginate(10);
            return view('offre.home', ['offres'=>$offres,'catigories'=>$catigories]);
        }
        $offres = offre:: where('state','published')->orderBy('created_at', 'desc')->paginate(10);



        // Pass the work offers to the view
        return view('offre.home', ['offres'=>$offres,'catigories'=>$catigories]);
    }

    public function display($id){
        $offres = Offre::where('workowner',$id)->orderBy('created_at', 'desc')->get();

        return view('offre.youroffres', compact('offres'));
    }
public function home(){
    return view('offre.index');
}
    /**
     * Show the form for creating a new resource.
     */


            public function create()
            {   $tools=tool::all();
                $catigories=category::all();
                return view('offre.create', compact('catigories','tools'));

            }


    /**
     * Store a newly created resource in storage.
     */


     public function step1( Request $request){

        $data=$request->validate(
            [
                'titre' =>'required|string|max:255',
                'company' =>'required|string|max:255',
                'lieu' =>'required|string|max:255',
                'nb_post' =>'required|integer|min:1',


            ]);
            Session::put('step1',$data);
            return redirect()->back();


     }
     public function step2( Request $request){
        $data=Session::get('step1');

        $data['skills'] = $request->input('skills');
        $data['works'] = $request->input('works');
        $data['points'] = $request->input('points');

        Session::put('step2',$data);
        return redirect()->back();
     }
     public function step3( Request $request){

            // Store the file in the 'public/cv' directory
            $imagePath = $request->file('image')->store('images', 'public');
        $data=Session::get('step2');
        $data['tool1'] = $request->input('tool1');
        $data['tool2'] = $request->input('tool2');
        $data['tool3'] = $request->input('tool3');
        $data['website'] = $request->input('websilte');
        $data['workowner']=Auth::user()->id;
        $data['image'] = $imagePath;
       Session::forget($data);
       $offre= offre::create($data);
       $offre->workowner=Auth::user()->id;
       $offre->image= $imagePath;
       $offre->save();
       event(new JobOfferCreated($offre));
       // event(new JobOfferCreated($data));
       return redirect('/#'.$offre->id);


    }


    public function store(StoreoffreRequest $request)
    {{

          /*  $request->validate([
                'titre' => 'sometimes|string|max:255',
                'company' => 'string|max:255',
                'lieu' => 'string|max:255',
                'nb_post' => 'integer|min:1',

                'website'=>'url',
                'image' => 'image|mimes:jpg,jfif,png|max:1024'

            ]);*/


         //   $imagePath = null;
        if ($request->hasFile('image')) {
            // Store the file in the 'public/cv' directory
            $imagePath = $request->file('image')->store('images', 'public');}
            $offre = new Offre();
            $offre->site=$request->input('website');
            $offre->image= $imagePath;
            $offre->titre = $request->input('titre');
            $offre->company = $request->input('company');
            $offre->lieu= $request->input('lieu');
            $offre->nb_post = $request->input('nb_post');
            $offre->description = $request->input('description');
            $offre->workowner= $request->input('workowner');
            $offre->skills = $request->skills;
            $offre->works = $request->works;
            $offre->points=$request->points;
            $offre->tool1= $request->tool1;
            $offre->tool2= $request->tool2;
            $offre->tool3= $request->tool3;
            $offre->category_id= $request->category;
            $offre->latitude = $request->latitude;
            $offre->longitude = $request->longitude;
            $offre->tools = json_encode($request->tools);

            Gate::authorize('create',$offre);

            $offre->save();
            $userId=Auth::user()->id;
            $users = User::where('notified',true)->get();


           foreach ($users as $user) {
           $user->notify(new OffreNotification($offre));
           }
           $emails=email::select('email');

foreach($emails as $email){
    Notification::route('mail', $email)->notify(new OffreNotification($offre));
}
           event(new JobOfferCreated($offre));


        }
        return redirect('/#'.$offre->id);
    }


    /**
     * Display the specified resource.
     */
    public function show(offre $offre)
    {
        $chirps=Chirp::where('offer_id',$offre->id)->get();

        return view('offre.detaille', [
            'offre' => $offre,'chirps' => $chirps,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(offre $offre)
    {
        Gate::authorize('update', $offre);

        $tools=tool::all();
        $catigories=category::all();
        return view('offre.edit', compact('catigories','tools','offre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, offre $offre){

        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($offre->image && Storage::disk('public')->exists($offre->image)) {
                Storage::disk('public')->delete($offre->image);
            }


            $imagePath = $request->file('image')->store('images', 'public');
            $offre->image = $imagePath;
        }




     //$offre->tools=json_encode($request->tools);


        $validated = $request->validate([
            'titre' => 'sometimes|string|max:255',
          'skills' => 'sometimes|string',
            'works' => 'sometimes|string',
            'points' => 'sometimes|string',
            'company' => 'sometimes|string|max:255',
            'lieu' => 'sometimes|string|max:255',
            'nb_post' => 'sometimes|integer|min:1',
            'site' => 'sometimes|url',
         // 'image' => 'sometimes|image',
            'tool1' => 'sometimes|string',
            'tool2' => 'sometimes|string',
            'tool3' => 'sometimes|string',
            'category_id' => 'sometimes|integer',
            'tools' => 'sometimes|array',
        ]);
        Gate::authorize('update', $offre);

      $offre->update($validated);
     if($request->tools){      $offre->tools = json_encode($request->tools);}
      $offre->save();

        return redirect()->back();

    }
    /**
     * Remove the specified resource from storage.
     */

/**
 * Deletes the specified work offer from the database.//+
 *
 * @param offre $offre The work offer to be deleted.//+
 * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page.//+
 * @throws \Exception If the work offer cannot be deleted.//+
 */
public function destroy(Request $request)
    {

        $id=$request->offre_id;
        $offre = offre::find($id);

  Gate::authorize('delete', $offre);
    if ($offre->image) {
      Storage::disk('public')->delete($offre->image);
   }
        $offre->delete();
        return redirect()->back();
    }

  public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Query the 'offres' table for records where 'titre' matches the search term
        $offres = Offre::where('titre', 'LIKE', '%' . $searchTerm . '%')->orderBy('created_at', 'desc')->paginate(10);
    $catigories=category::all();
        // Return the view with the search results
        return view('offre.home', ['offres'=>$offres,'catigories'=>$catigories]);
    }

    public function all(){
        $offres = Offre::orderBy('created_at', 'desc')->get();
        return view('offre.admin.manage', compact('offres'));
    }
    public function addEmail($email){

        DB::table('emails')->insert($email);

    }

    public function cancel($id){
        $offer=offre::find($id);

        $offer->state="canceled";

        $offer->save();
        return redirect()->back();
    }
    public function republish($id){
        $offer=offre::find($id);
        $offer->state="published";
        $offer->save();
        return redirect()->back();

    }
}
