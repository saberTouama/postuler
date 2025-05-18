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
        $query = Offre::select('id','workowner','titre','lieu','company','image','created_at','updated_at')->where('state', 'published');
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

        $offres = $query->orderBy('created_at', 'desc')->paginate(10);


        return view('livewire.offers-list', [
           'offres'=>$offres,'catigories'=>$catigories
        ])->extends('layouts.app');
    }
}
