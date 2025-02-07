

<div>

    
    <form wire:submit.prevent="submitJobOffer" class="mb-6">
        <div>
            <label for="title">Job Title</label>
            <input type="text" id="titre" wire:model="titre" placeholder="Enter job title" required>
        </div>
        <div>
            <label for="company">Company</label>
            <input type="text" id="company" wire:model="company" placeholder="Enter company name" required>
        </div>
        <div>
            <label for="lieu">Location</label>
            <input type="text" id="lieu" wire:model="lieu" placeholder="Enter location" required>
        </div>
        <div>
            <label for="nb_post">Number of Posts</label>
            <input type="number" id="nb_post" wire:model="nb_post" placeholder="Enter number of posts" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">
            Publish
        </button>
    </form>
   

    @section('content')
    @if(session()->has('message'))
        <div class="text-green-500 mb-4">{{ session('message') }}</div>
    @endif

   
    <div>
        <h2 class="text-xl font-bold mb-4">Job Offers</h2>
        <div id="work-offers-list" class="mx-4 colored lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 ">
            @foreach($offers as $offre)
          
              <x-card class="p-10 bg-slate-300">
                  <div class="" style="display: inline; margin-left: 5px;">
                  <ul>
      
                   <li> <img class="w-14 mr-3 mb-3"
                          src="{{$offre->image ? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" style="border-radius: 50%"/></li>
                         <li> <img class="w-14 mr-3 mb-3"
                          src="{{$offre->image ? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" style="border-radius: 50%"/></li>
                        <li> <img class="w-14 mr-3 mb-3"
                          src="{{$offre->image ? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" style="border-radius: 50%"/></li>
                      
                  </ul>
              </div>
                @auth
                  <x-dropdown>
      
                      <x-slot name="trigger">
                  
                         
                          <button>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                              </svg>
                          </button>
                      </x-slot>
                      <x-slot name="content">
                          @php
                          $id=$offre->id;
                      session()->put('id', $id);
                          
                          @endphp
                          
                               
                          <x-dropdown-link :href="route('offre.workerinput')" >
                              {{ __('Send CV') }}
                          </x-dropdown-link>
                                   
                              
                              
                                   @php
                                   $id=$offre->id;
                               session()->put('id', $id);
                                   
                                   @endphp
                                   
                                   
                               
                         
                          
                          
                      </x-slot>
                  </x-dropdown>
                  <x-dropdown-link :href="route('offre.workerinput')" >
                      {{ __('Send CV') }}
                  </x-dropdown-link>
                  @endauth  
                <div class="flex flex-col items-center justify-center text-center">
                  <a href="{{route("offre.detaille", $offre)}}"> <img class="w-60 mr-6 mb-6"
                    src="{{$offre->image ? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" style="border-radius: 50%"/>
                  </a>
                  <h3 class="text-2xl mb-2">{{$offre->title}}</h3>
                  <div class="text-xl font-bold mb-4">{{$offre->company}}</div>
        
                  <x-listing-tags :tagsCsv="$offre->tags" />
        
                      <div class="text-lg my-4">
                          <i class="fa-solid fa-location-dot"></i> {{$offre->lieu}}
                        </div>
                 
                  <div>
                     
                    <div class="text-lg space-y-6"> 
                      {{-- $offre->description['points'] ?? '' }}                {{ $offre->description['skills'] ?? '' }}
                         {{$offre->description['works'] ?? ''--}}
                       </div>
      @auth
                   @php
                    $employer = Illuminate\Support\Facades\Auth::user()->find($offre->workowner);
                 @endphp
                    <a href="mailto:{{$employer->email}}" class="block bg-green-300 text-white mt-6 py-2 rounded-xl hover:opacity-80">
                      <i class="fa-solid fa-envelope bg-green-300"></i> Contact Employer
                    </a> @endauth
        
                    <a href="{{$offre->website}}" target="_blank" class="block bg-black text-white py-2 rounded-xl hover:opacity-80">
                      <i class="fa-solid fa-globe"></i> Visit Website
                    </a>
                  </div>
                </div>
      
                
              </x-card>
          
            @endforeach
            
          
          
          </div>
    </div>
    @endsection
</div>