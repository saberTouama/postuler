<div>
    @if (session()->has('success'))
    <div class="bg-green-500 text-white p-2 mb-4">
        {{ session('success') }}
    </div>
    
        
    @else
       <h1>not seccess</h1> 
    
@endif
    <h2>Offers</h2>
    <ul>
        @foreach ($offers as $offer)
            <li>
                <strong>{{ $offer->titre }}</strong> - {{ $offer->company }} ({{ $offer->location }})
            </li>
        @endforeach
    </ul>
</div>
