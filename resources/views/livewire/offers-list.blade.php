<div>
    <div id="work-offers-list">
        @foreach($offers as $offer)
            <div class="offer-card p-4 bg-gray-100 rounded shadow mb-4">
                <h3 class="text-lg font-bold">{{ $offer->title }}</h3>
                <p class="text-sm">{{ $offer->company }}</p>
                <p class="text-sm text-gray-600">{{ $offer->lieu }}</p>
            </div>
        @endforeach
    </div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
