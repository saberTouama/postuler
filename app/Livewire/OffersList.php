<?php

namespace App\Livewire;


use App\Models\offre;
use Livewire\Component;
use App\Models\category;
use Livewire\WithPagination;
class OffersList extends Component
{    use WithPagination;

    public $search = '';
    public $category='';
    public $region='';
    public $page = 1;
     protected $updatesQueryString = ['search',''];
     public function updatingSearch()
    {
        $this->reset('page');
    }

    public function render()
    {
        $query = Offre::where('state', 'published');
        if (!empty($this->search)) {
            $query->where('titre', 'like', '%' . $this->search . '%');
        }
        if(!empty($this->category)){
            $query->where('category_id',$this->category);
        }
        if(!empty($this->region)){
            $query->where('lieu',$this->region);
        }
        $catigories=category::all();
       /* if ($request->has('category') && $request->category != '') {

            $offres=Offre::where('category_id', $request->category)->paginate(10);
            return view('offre.home', ['offres'=>$offres,'catigories'=>$catigories]);
        }
        if ($request->has('region') && $request->region != '') {


            $offres=Offre::where('lieu', $request->region)->paginate(10);
            return view('offre.home', ['offres'=>$offres,'catigories'=>$catigories]);
        }*/
        $offres = $query->orderBy('created_at', 'desc')->paginate(10);



        // Pass the work offers to the view

        return view('livewire.offers-list', [
           'offres'=>$offres,'catigories'=>$catigories
        ])->extends('layouts.app');
    }
}
