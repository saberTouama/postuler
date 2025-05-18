

    @use('Illuminate\Support\Facades\DB')
    <x-app-layout>

        @section('users') @endsection
    @php
   // $workOwnerId = auth()->user()->id;
    @endphp

    <h1>Candidates for Your Offers</h1>
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
                <x-danger-button  x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-condidat-deletion');  document.getElementById('worker_id').value = {{ $worker->id }}; " id="{{$worker->id}}.delete" href="delete-condidate/{{$worker->id}}" class="text-red-500 hover:underline" >
                    {{ __('Delete ❌') }}
                </x-danger-button>
            </td>
            <td>
                @if($worker->status =='filtred')
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-condidat-accept'); document.getElementById('id').value={{$worker->id}};" :href="route('worker.accept', $worker->id)" class="text-green-500 hover:underline">
                    {{ __('Accept ✔') }}
                </button>
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
<x-modal name="confirm-condidat-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="/delete-condidate" class="p-6">
        @csrf
      @method('post')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete condidator?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once  condidator is deleted, all of its resources and data will be permanently deleted.') }}
        </p>

        <div class="mt-6">
              <input  id="worker_id" name="worker_id" type="hidden" value="" />
       </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Condidator') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
<x-modal name="confirm-condidat-accept">
    <form method="post" action="{{route('worker.accept', $worker->id) }}" class="p-6">
        @csrf
      @method('post')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to accept condidator?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('You can send recrutment interview Time and location ') }}
        </p>
        <input type="hidden" name="id" id="id">



            <x-danger-button class="ms-3">
                {{ __('Accept Condidator') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
