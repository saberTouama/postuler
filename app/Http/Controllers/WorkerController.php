<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Models\offre;
use App\Jobs\CvFilter;
use App\Models\worker;
//use Illuminate\Queue\Worker;
//use Illuminate\Queue\Worker;
use App\Models\offreworker;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use InvalidArgumentException;
use App\Models\work_work_offer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Notifications\CondidatRejected;
use Illuminate\Support\Facades\Storage;
use App\Notifications\CandidateAccepted;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreworkerRequest;
use App\Http\Requests\UpdateworkerRequest;
use Illuminate\Support\Facades\Notification;

class WorkerController extends Controller
{

    function getEmbedding($text) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.env('HF_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://api-inference.huggingface.co/models/sentence-transformers/all-MiniLM-L6-v2', [
            'inputs' => $text
        ]);

        return $response->json()[0] ?? []; // Return first embedding vector
    }

public function evaluateCV($cvText, $jobDescription) {
    // Step 1: Get Embeddings
    $cvEmbedding = $this->getEmbedding($cvText);
    $jobEmbedding = $this->getEmbedding($jobDescription);

    // Step 2: Calculate Similarity
    $similarity = $this->cosineSimilarity($cvEmbedding, $jobEmbedding);

    // Step 3: Classify
    if ($similarity > 0.85) return 'perfect_match';
    if ($similarity > 0.65) return 'good_match';
    if ($similarity > 0.20) return 'partial_match';
    return 'no_match';
}



function cosineSimilarity($vecA, $vecB) {
    if (empty($vecA) || empty($vecB)) {
        return 0.0;
    }

    $dotProduct = 0.0;
    $normA = 0.0;
    $normB = 0.0;

    foreach ($vecA as $i => $val) {
        $dotProduct += $val * ($vecB[$i] ?? 0);
        $normA += $val ** 2;
        $normB += ($vecB[$i] ?? 0) ** 2;
    }

    // Prevent division by zero
    $denominator = (sqrt($normA) * sqrt($normB));
    return $denominator > 0 ? ($dotProduct / $denominator) : 0.0;
}
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
    /**
 * Calculates cosine similarity between two vectors.
 */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


      /*  $request->validate([
            'Cemail' => 'required|string|max:255',
            'Cname' => 'required|string|max:128',
            'user_id' => [
                'required',
                Rule::unique('workers')->where(function ($query) use ($request) {
                    return $query->where('concernedoffre', $request->concernedoffre);
                }),
            ],
            'concernedoffre' => 'required',
            'hire_date' => 'required|date',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'user_id.unique' => '⛔ You have already applied to this offer.',
        ]);*/


        $cvPath = $request->file('cv')->store('cvs', 'public');
$parser = new Parser();
$pdf = $parser->parseFile(storage_path("app/public/{$cvPath}"));
$cvText = $pdf->getText();
$jobDescription = "we are looking for an AI expert with 5 years experience with data analyse and ai APIs in web developement ";

// Debug: Verify CV text extraction
Log::debug('Extracted CV Text (First 500 chars):', ['text' => substr($cvText, 0, 500)]);

// Clean CV text
$cvText = preg_replace('/[^\w\s.-]/', ' ', $cvText);
$cvText = substr($cvText, 0, 3000);


// Returns: perfect_match/good_match/partial_match/no_match




    // Step 5: Create and save the Worker
    $worker = new Worker();
    $worker->email = $request->Cemail;
    $worker->name = $request->Cname;
    $worker->hire_date = $request->hire_date;
    $worker->cv_path = $cvPath;
    $worker->concernedoffre = $request->concernedoffre;
    $worker->user_id = $request->user_id;
    //$worker->AI_label = $aiLabel;
    $worker->save();
    CvFilter::dispatch(
        $worker->id,
        Offre::find($request->concernedoffre),
        $cvText
    )->onQueue('cv-processing');
       return redirect()->back()->with('success','your application created seccessfuly');
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
     session()->flash('offer_id',$request->offer_id);
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
    public function destroy( Request $request)
    {
        $id=$request->worker_id;

    $worker=worker::find($id);

    $offer=$worker->offre;

   Gate::authorize('delete', $worker);
   $user=User::find($worker->user_id);
   $user->notify(new CondidatRejected($offer));
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
    public function accept(Request $request){
        $id=$request->id;
        $candidat=worker::find($id);
        $candidat->status='accepted';
        $candidat->save();
        $user=User::find($candidat->user_id);
        $offre=$candidat->offre;
        $user->notify(new CandidateAccepted($offre));
        return redirect()->back();

    }
}
