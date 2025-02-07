<?php

namespace App\Http\Controllers;
use App\Models\offre;
use App\Models\worker;
use App\Models\offreworker;
use Illuminate\Http\Request;
use App\Models\work_work_offer;
//use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Notifications\CondidatRejected;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreworkerRequest;
use App\Http\Requests\UpdateworkerRequest;
use Illuminate\Support\Facades\Notification;


class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        return view('offre.workerinput',compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreworkerRequest $request)
    {
        $request->validate([
            'email'=>'required|string|max:255',
            'name'=>'required|string|max:255',

            'hire_date'=>'required|date',
'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'


        ]);

        $filePath = null;
        if ($request->hasFile('cv')) {
            // Store the file in the 'public/cv' directory
            $filePath = $request->file('cv')->store('cvs', 'public');}
        $worker = new worker();
        $worker->email = $request->input('email');
        $worker->name = $request->input('name');

        $worker->hire_date = $request->input('hire_date');
        $worker->cv_path = $filePath;
        $worker->concernedoffre=$request->input('concernedoffre');
        $worker->save();



        return redirect()->back();
    }
    public function applyForOffer(Request $request)    {
        // Validate the incoming request data
       $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'offre_id' => 'required|exists:offres,id',        ]);
        // Find the worker and work offer
       /* $work_offre=new offreworker();
        $worker = Worker::find($request->worker_id);
        $offre_id = $request->offre_id;
        $work_offre->offre_id = 88;
        $work_offre->worker_id = 18;
        $work_offre->save();*/
        $work_offre = offreworker::find(6);

        $work_offre->offre_ids()->createMany([
    ['offre_id' => 55],

]);
        // Attach the worker to the work offer
       // $worker->offres()->attach($offre_id);
        // Redirect or return a response
        return redirect()->back()->with('success', 'You have successfully applied for the work offer.');
    }
    /**
     * Display the specified resource.
     */
    public function mydisplay($id){
        $workers = DB::table('workers')
    ->whereIn('concernedoffre', function ($query) use ($id) {
        $query->select('id')
              ->from('offres')
              ->where('workowner', $id)->where('status','filtred')->orwhere('status', 'accepted');
    })
    ->get();
    return view('offre.show', compact('workers'));

    }
    public function all(Request $request){
        $workers = DB::table('workers')->get();
        if($request->offer_id){
            $workers = DB::table('workers')->where('concernedoffre',$request->offer_id)->get() ;

        }
        return view('offre.admin.cvfilter', compact('workers'));
    }


     public function show($id)
    {
        return view('offre.workerinput');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateworkerRequest $request, worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $worker=worker::find($id);
    $offer=offre::find($worker->concernedoffre);
    //$offer=Offre::find($worker->concernedoffre);
    Gate::authorize('delete', $worker);
   // Notification::route('mail', $worker->email)->notify(new CondidatRejected($offer));
    if ($worker->cv_path) {
        Storage::disk('public')->delete($worker->cv_path);
    }
    $worker->delete();
    return redirect()->back();

    }

    public function filtred($id){
        $condidat=worker::find($id);
        $condidat->status='filtred';
        $condidat->save();
        return redirect()->back();
    }
    public function accept($id){
        $condidat=worker::find($id);
        $condidat->status='accepted';
        $condidat->save();
        return redirect()->back();

    }
}
