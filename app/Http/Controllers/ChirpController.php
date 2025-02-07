<?php

namespace App\Http\Controllers;
 
use App\Models\User;
use App\Models\Chirp;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
 
class ChirpController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function index(): View
    {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    
    }
    
    public function edit(Chirp $chirp): View
    {
        //
        Gate::authorize('update', $chirp);
 
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
  
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);
 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
       //
     
        Gate::authorize('delete', $chirp);
        $chirp->delete();
        return redirect()->back();
    }
    public function store(Request $request): RedirectResponse
    {
     
        $validated = $request->validate([
            'message' => 'required|string|max:255',
             'offer_id' => 'required|exists:offres,id',

        ]);

 
        $request->user()->chirps()->create($validated);
 
        return  redirect()->back();
    }
    
 
 
}