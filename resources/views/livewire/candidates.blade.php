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
                            <x-danger-button id="delete" wire:click="confirmDelete({{ $worker->id }});showConfirmation = true ;"
                                   x-on:click.prevent="showConfirmation = true ;"
                                class="text-red-500 hover:underline">
                                {{ __('Delete ❌') }}
                            </x-danger-button>

                        </td>

                    </tr>
                                    @endforeach


                                   <x-danger-button
    wire:click.prevent="deleteWorker"
    class="items-center flex  justify-center    active:translate-y-0
           disabled:opacity-50 disabled:transform-none disabled:hover:shadow-md
           disabled:bg-red-600 disabled:cursor-not-allowed"
    :disabled="$deleteDesabled">
    {{ __('Confirm Delete') }} <span class="ml-1">🗑</span>
</x-danger-button>

            </tbody>
        </table>

        <br><br><br><br><br><br><br><br><br>

<!-- Confirmation Modal (Hidden by Default) -->
<div x-data="{ showConfirmation: false }">
<div
 id="confirm"
  x-show="deleteDesabled"
    class="hidden fixed inset-0 z-50  items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">

    <!-- Modal Container -->
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Are you sure?</h3>
        <p class="text-gray-600 mb-6">This action cannot be undone.</p>

        <!-- Confirmation Button (Large & Destructive) -->
        <x-danger-button
            wire:click.prevent="deleteWorker"
            class="w-full py-3 px-6 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg
                   shadow-md hover:shadow-lg transition-all transform hover:scale-[1.02]">
            {{ __('Permanently Delete') }} <span class="ml-2">🗑</span>
        </x-danger-button>

        <!-- Cancel Button -->
        <button
            :click="$deleteDesabled = true"
            class="mt-3 w-full py-2 px-4 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
            Cancel
        </button>
    </div>
</div>
</div>
</div>
<div class="mt-8">
    {{ $workers->links() }}
</div>
 <script>
   $("#delete").click(function(){

     $("#confirm").css('display','flex');
   });


       </script>
    </x-app-layout>


</div>
