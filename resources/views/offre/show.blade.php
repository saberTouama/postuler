

    @use('Illuminate\Support\Facades\DB')
    <x-app-layout>

        @section('users') @endsection
    @php
   // $workOwnerId = auth()->user()->id;
    @endphp

    <h1>Workers Registered for Your Offers</h1>
    <div class="sm:justify-center items-center pt-6 px-10" style="border-radius: 10px;">
        <table class="w-full bg-white border border-gray-300 text-gray-700 rounded-lg shadow-lg  border-separate">
   <thead class="bg-blue-400">
       <tr class="hover:bg-blue-200"> <th class="py-3 px-4 text-left">Name:</th><th class="py-3 px-4 text-left">Concerned Offre</th><th class="py-3 px-4 text-left">CV</th><th class="py-3 px-4 text-left">Email:</th> <th></th> <th></th></tr></thead>
       <tbody>
        @foreach ($workers as $worker)
            <tr class="border-b hover:bg-gray-100">
               <td class="py-3 px-4"> {{ $worker->name }}</td>
               @php
               $id=$worker->concernedoffre;
               $titre = DB::table('offres')
    ->where('id', $id)
    ->value('titre');
                @endphp
             <td class="py-3 px-4"> <a href="{{route('offre.detaille',$id)}}">{{$titre}}</a></td>
                @if ($worker->cv_path)
                    <!-- Correctly generate the URL for the CV -->
                   <td class="py-3 px-4 text-green-700"><a href="{{ asset('storage/' . $worker->cv_path) }}" target="_blank">View CV</a></td>

                @else
                    No CV uploaded
                @endif
                @if ($worker->email != null)
              <td class="py-3 px-4 text-blue-700"><a href="mailto:{{$worker->email}}">{{$worker->email}}</a></td>
              @endif
              <td class="py-3 px-4">
                <x-dropdown-link :href="route('worker.destroy', $worker->id)" class="text-red-500 hover:underline">
                    {{ __('Delete ❌') }}
                </x-dropdown-link>
            </td>
            <td>
                @if($worker->status =='filtred')
                <x-dropdown-link :href="route('worker.accept', $worker->id)" class="text-green-500 hover:underline">
                    {{ __('Accept ✔') }}
                </x-dropdown-link>
                @else
                <span class="text-green-600 font-semibold">Accepted ✔</span>
      @endif
            </td>
            </tr>
        @endforeach


       </tbody>
    </table>



</div>

</x-app-layout>
