<div>
    {{-- Section for the form --}}
    @section('form')
    <div>
        <form wire:submit.prevent="submit">
            @csrf
            <input type="text" wire:model="titre" placeholder="Job Title">
            <input type="text" wire:model="company" placeholder="Company Name">
            <input type="text" wire:model="lieu" placeholder="Location">
            <button type="submit">Submit</button>
        </form>
    </div>

@endsection
  
@section('offers')
@use('App\Models\offre')

<div>
    <h2>Offers List</h2>
    <ul>
  
   @foreach ($offers as $offer)
            <li>{{ $offer->titre }} - {{ $offer->company }} ({{ $offer->lieu }})</li>
        @endforeach
    </ul>
</div>
@endsection
</div>
