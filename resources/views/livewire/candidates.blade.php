<div>

    @use ('Illuminate\Support\Facades\DB')
    <x-app-layout>
    @section('users') @endsection




        @php



    $workOwnerId = auth()->user()->id;

    /*$workers = DB::table('workers')
        ->whereIn('concernedoffre', function ($query) use ($workOwnerId) {
            $query->select('id')
                  ->from('offres')
                  ->where('workowner', $workOwnerId);
        })
        ->get();*/

        @endphp
       {{-- @extends('layouts.app')--}}

       <div class="sm:justify-center items-center pt-6 px-10" style="border-radius: 10px" wire:poll.1s >
        <table class="w-full bg-white border border-gray-300 text-gray-700 rounded-lg shadow-lg border-separate ">
            <thead class="bg-blue-500 text-white border-separate ">
                <tr>
                    <th class="py-3 px-4 text-left">Candidate</th>
                    <th class="py-3 px-4 text-left">Concerned Offer</th>
                    <th class="py-3 px-4 text-left">CV</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">AI label</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                    @php
                        $id = $worker->concernedoffre;
                        $titre = DB::table('offres')->where('id', $id)->value('titre');
                    @endphp
                    <tr class="border-b hover:bg-blue-200">
                        <td class="py-3 px-4">{{ $worker->name }}</td>
                        <td class="py-3 px-4">
                            @if($titre)
                                <a href="{{ route('offre.detaille', $id) }}"  target="_blank" class="text-blue-500 hover:underline">
                                    {{ $titre ?? 'Offer deleted' }}
                                </a>
                            @else
                                Offer deleted
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if ($worker->cv_path)
                                <a href="{{ asset('storage/' . $worker->cv_path) }}" target="_blank" class="text-blue-500 hover:underline">
                                    View CV
                                </a>
                            @else
                                No CV uploaded
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if ($worker->status =='new')
                                <button    wire:click="markAsFiltered({{ $worker->id }})"  id="{{$worker->id}}" class="text-green-500 bg-green-200 rounded-full" >
                                    {{ __('Mark as Filtred CV') }}
                                </button>
                            @else
                                <span class="text-green-600 font-semibold">{{$worker->status}} ✔</span>
                            @endif
                        </td>
                        <td>{{$worker->AI_label}}</td>
                        <td class="py-3 px-4">
                            <x-danger-button wire:click="confirmDelete({{ $worker->id }}); $dispatch('open-modal','confirm-condidat-deletion');"

                                class="text-red-500 hover:underline">
                                {{ __('Delete ❌') }}
                            </x-danger-button>

                        </td>

                    </tr>
                                    @endforeach
            </tbody>
        </table>


        <br><br><br><br><br><br><br><br><br>
      <script>
        $('#title').html('CV filter');
      </script>

<x-modal name="confirm-condidat-deletion" wire:show="showModal" >


    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Are you sure you want to delete candidate?') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __('Once candidate is deleted, all of its resources and data will be permanently deleted.') }}
    </p>

    <div class="mt-6">

    </div>

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button  wire:click="deleteWorker" class="ms-3" >
            {{ __('Delete Candidate') }}
        </x-danger-button>
    </div>

</x-modal>
</div>
    </x-app-layout>


</div>
