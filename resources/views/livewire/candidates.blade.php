<div>

    @use ('Illuminate\Support\Facades\DB')
    <x-app-layout>

    @section('users') @endsection




        @php



    $workOwnerId = auth()->user()->id;



        @endphp


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
                            <x-danger-button wire:click="confirmDelete({{ $worker->id }});"

                                class="text-red-500 hover:underline">
                                {{ __('Delete ❌') }}
                            </x-danger-button>

                        </td>

                    </tr>
                                    @endforeach


                                    <x-danger-button wire:click.prevent="deleteWorker"
                                        class="fixed ml-4 transition-all duration-300 ease-in-out
                                          right-10
                                               enabled:hover:bg-red-700 enabled:hover:shadow-lg
                                               disabled:hidden
               disabled:opacity-60 disabled:cursor-not-allowed
               disabled:bg-gray-400 disabled:text-gray-700
               disabled:border-gray-400 disabled:hover:shadow-none " :disabled="$deleteDesabled">
                                        {{ __('Confirm Delete ❌') }}
                                    </x-danger-button>

            </tbody>
        </table>

        <br><br><br><br><br><br><br><br><br>

<x-modal x-data="" name="confirm-condidat-deletion" >
<div class="mx-5 my-5">





    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button  wire:click="deleteWorker" class="ms-3" >
            {{ __('Delete Candidate') }}
        </x-danger-button>
    </div>
</div>
</x-modal>
</div>
<div class="mt-8">
    {{ $workers->links() }}
</div>
    </x-app-layout>


</div>
