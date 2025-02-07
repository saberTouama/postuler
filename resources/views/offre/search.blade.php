
<x-app-layout>
@if(isset($offres))
<h2>Search Results:</h2>
<ol>
    @foreach($offres as $offre)


    <a href="{{route("offre.detaille",$offre)}}">
        <div class="p-6 flex space-x-2" style="background-image: url('{{ asset('storage/' . $offre->image) }}');">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-800">{{ $offre->title }}</span>
                        <small class="ml-2 text-sm text-gray-600">{{ $offre->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($offre->created_at->eq($offre->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>
                   
                </div>
                
                <p class="mt-4 text-lg text-gray-900">{{ $offre->titre }}</p>
           <p class="mt-4 text-lg text-gray-900 ">{{ $offre->tools['tool1'] ?? '' }}</p>
           <p class="mt-4 text-lg text-gray-900 ">{{ $offre->description['points'] ?? '' }}</p>
                <p class="mt-4 text-lg text-gray-900">{{ $offre->company }}</p>
                <p class="mt-4 text-lg text-gray-900">{{ $offre->nb_post }}</p>
            </div>
        </div>
    </div>
    {{--@if ($offre->user->is(auth()->user()))--}}
        
    
</div>
<p class="mt-4 text-lg text-gray-900">{{ $offre->message }}</p>
</div>
</div>
</a><br><br><br><br>
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
    <x-dropdown-link :href="route('offre.workerinput',['id'=>$id])">{{--, $offre--}}
        {{ __('postuler') }}
    </x-dropdown-link>
    
</x-slot>
</x-dropdown>
<br><br><br><br> <hr>
        <li>{{ $offre->titre }} - {{ $offre->description['skills'] }}  - {{$offre->company}}</li>
    @endforeach
</ol>
@else
<p>No offers found.</p>
@endif
</x-app-layout>