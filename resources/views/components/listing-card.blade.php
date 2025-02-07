@props(['offre'])

<x-card>
  <div class="flex">
    <img class="hidden w-48 mr-6 md:block"
      src="{{$offre->image ? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" />
    <div>
      <h3 class="text-2xl">
        <a href="/offres/{{$offre->id}}">{{$offre->title}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$offre->company}}</div>
      <x-listing-tags :tagsCsv="$offre->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$offre->location}}
      </div>
    </div>
  </div>
</x-card>