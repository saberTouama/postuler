<?php

namespace App\Http\Controllers;

use App\Models\workowner;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class WorkownerController extends Controller
{
  public function index(){
    return view('offre.workowner');
  }
    public function store(Request $request):RedirectResponse
    {
    $workowner=new workowner;
    $workowner->name=$request->name;
    $workowner->email=$request->email;
    $workowner->phone=$request->phone;
    $workowner->address=$request->address;
    $workowner->company=$request->company;
    $workowner->save();
    return redirect()->route('workowner.index')->with('success','Workowner added successfully');

    }
    public function showCandidates($offerId)
{
    $workOwner = auth()->user(); // Assuming the work owner is authenticated
    $workOffer = $workOwner->workOffers()->findOrFail($offerId);
    $candidates = $workOffer->candidates;

    return view('workowner.candidates', compact('candidates'));
}
}
