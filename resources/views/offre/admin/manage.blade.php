
<x-app-layout>
    <div class=" fixed flex  top-1/4 right-10">
    <button  x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-tool')" class=" hover:bg-blue-400 hover:text-black  bg-black text-white py-2 px-5 rounded-full flex items-center gap-2" > Add Tool </button>
    <button class=" hover:bg-blue-400 hover:text-black bg-black text-white py-2 px-5 rounded-full flex items-center gap-2"  x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-catigory')"  > Add Catigory </button></div>

    <div class="mx-4 colored lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 text-white">
      @foreach($offres as $offre)

      <x-card class="p-10">
        <div class="flex">
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


                       <x-dropdown-link class="flex" :href="route('offre.edit', $offre)">
                           {{ __('Edit') }} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none">
                              <path fill="currentColor" d="m5 16l-1 4l4-1L18 9l-3-3z" opacity="0.16" />
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 16l-1 4l4-1L19.586 7.414a2 2 0 0 0 0-2.828l-.172-.172a2 2 0 0 0-2.828 0zM15 6l3 3m-5 11h8" />
                            </g>
                          </svg>
                       </x-dropdown-link>
                       <form method="get" action="{{ route('offre.destroy', $offre) }}">
                           @csrf
                           @method('get')
                           <x-dropdown-link :href="route('offre.destroy', $offre)" onclick="event.preventDefault(); this.closest('form').submit();">
                               {{ __('Delete') }}
                           </x-dropdown-link>
                       </form>


                       @php
                       $id=$offre->id;
                   session()->put('id', $id);

                       @endphp






          </x-slot>
      </x-dropdown>
        <x-dropdown-link class="flex" :href="route('offre.edit', $offre)">
        {{ __('Edit') }} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <g fill="none">
            <path fill="currentColor" d="m5 16l-1 4l4-1L18 9l-3-3z" opacity="0.16" />
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 16l-1 4l4-1L19.586 7.414a2 2 0 0 0 0-2.828l-.172-.172a2 2 0 0 0-2.828 0zM15 6l3 3m-5 11h8" />
          </g>
        </svg>
    </x-dropdown-link>
    @if($offre->state=='published')
    <x-dropdown-link :href="route('offre.cancel', $id)">
      {{ __('Cancel') }}
  </x-dropdown-link>
  @else
  <x-dropdown-link :href="route('offre.republish', $id)">
    {{ __('Republish') }}
</x-dropdown-link>
@endif

 <form class="hover:bg-white" method="get" action="{{route('cvs')}}">
<input type="hidden" name="offer_id" value="{{$id}}">
<input class="text-gray-300 hover:bg-white" type="submit" value="candidates">
 </form>



        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion');
                            document.getElementById('offre_id').value = {{$id}};"
        >{{ __('Delete offer') }}</x-danger-button>
        </div>
        <a href="{{route("offre.detaille",$offre)}}">
        <div class="flex flex-col items-center justify-center text-center">
            <img class="w-48 mr-6 mb-6"
            src="{{$offre->image? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" />

          <h3 class="text-2xl mb-2 text-slate-400">
            {{$offre->titre}}
          </h3>
          <div class="text-xl font-bold mb-4">{{$offre->company}}</div>

          <x-listing-tags :tagsCsv="$offre->tags" />

          <div class="text-lg my-4">
            <i class="fa-solid fa-location-dot"></i> {{$offre->lieu}}
          </div>



  @php $employer = Illuminate\Support\Facades\Auth::user()->find($offre->workowner) @endphp
  <div class="lg:grid lg:grid-cols-2">  <div>
    <a href="mailto:{{$employer->email}}"
      class=" bg-blue-300 text-black  py-2 rounded-xl hover:opacity-80 items-center gap-2 flex "> Contact Employer<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width={512} height={512} viewBox="0 0 512 512">
        <path fill="currentColor" fillRule="evenodd" d="M356.3 234.667q48.224 0 79.707 25.985q15.665 12.992 24.419 31.92q8.907 19.568 8.907 43.147q0 37.374-20.733 59.67q-18.582 19.89-41.926 19.89q-24.88 0-27.337-22.617q-15.358 22.616-41.466 22.616q-21.04 0-33.326-12.19q-13.362-13.154-13.362-36.09q0-15.239 6.067-29.915q6.067-14.678 16.816-25.424q20.426-20.37 52.524-20.37q24.266 0 45.305 7.859l-10.29 66.727q-1.535 9.784-1.535 14.275q0 11.068 9.368 11.068q12.285 0 21.962-14.917q11.825-18.126 11.825-42.988q0-34.166-23.037-53.253q-25.493-21.012-63.274-21.012q-29.18 0-53.137 14.436q-22.577 13.635-33.941 36.892q-9.06 18.928-9.061 42.025q0 43.79 30.408 69.454q26.722 22.616 67.882 22.616q23.496 0 49.759-8.982l4.453 24.701q-27.796 9.144-56.67 9.143q-53.137 0-86.464-30.957q-35.476-32.722-35.476-86.617q0-50.847 33.633-83.569q34.71-33.523 88-33.523m10.75 78.917q-8.753 0-17.354 4.571q-8.6 4.572-14.743 12.592q-12.594 16.2-12.593 36.25q0 11.229 5.528 17.725q5.53 6.495 15.05 6.496q13.823 0 22.884-11.87q4.76-6.095 7.525-23.579l6.45-39.94q-7.832-2.245-12.746-2.245M448 64l.003 187.94a138.8 138.8 0 0 0-42.668-27.978L405.333 128L289.171 228.35a139.1 139.1 0 0 0-35.913 26.293L106.667 128v192l110.377-.001a139 139 0 0 0-3.71 32.001q.001 5.386.404 10.668L64 362.667V64zm-80 42.667H144l112 96z"></path>
      </svg>
     </a></div>


      <div>    <a href="{{$offre->site}}" target="_blank"
      class=" bg-black text-white py-2 rounded-xl hover:opacity-80 items-center gap-2 flex ">
      Visit Website <svg  class="h-6 w-6"  xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" strokeWidth={1.5}>
          <path strokeLinecap="round" strokeLinejoin="round" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10"></path>
          <path strokeLinecap="round" strokeLinejoin="round" d="M13 2.05S16 6 16 12m-5 9.95S8 18 8 12s3-9.95 3-9.95M2.63 15.5H12m-9.37-7h18.74"></path>
          <path d="M21.879 17.917c.494.304.463 1.043-.045 1.101l-2.567.291l-1.151 2.312c-.228.459-.933.234-1.05-.334l-1.255-6.116c-.099-.48.333-.782.75-.525z" clipRule="evenodd"></path>
        </g>
      </svg></a></div>


          </div>
        </div>

      </a>

      </x-card>



      @endforeach
    </div>
    <div class="items-center flex  justify-center h-screen">
        {{ $offres->links() }}
   </div>
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
      <form method="post" action="{{ route('offre.destroy') }}" class="p-6">
          @csrf
        @method('post')

          <h2 class="text-lg font-medium text-gray-900">
              {{ __('Are you sure you want to delete offer?') }}
          </h2>

          <p class="mt-1 text-sm text-gray-600">
              {{ __('Once  offre is deleted, all of its resources and data will be permanently deleted.') }}
          </p>

          <div class="mt-6">


              <input

              id="offre_id"
              name="offre_id"
              type="hidden"
            value=""

              />


          </div>

          <div class="mt-6 flex justify-end">
              <x-secondary-button x-on:click="$dispatch('close')">
                  {{ __('Cancel') }}
              </x-secondary-button>


              <x-danger-button class="ms-3">
                  {{ __('Delete offer') }}
              </x-danger-button>
          </div>
      </form>
  </x-modal>

  @php
    $showElement =true;
@endphp

@section('custom_element')
  <div class=" items-center flex justify-center h-screen">

  <x-modal name="add-catigory">
    <x-guest-layout>
      <h1 >Add Catigory</h1>
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('catigory.store') }}"  enctype="multipart/form-data" >
      @csrf

      <!-- Email Address -->
      <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
          <x-input-label for="description" :value="__('description')" />

          <x-text-input id="description" class="block mt-1 w-full"
                          type="text"
                          name="description"
                           autocomplete="description" />

          <x-input-error :messages="$errors->get('description')" class="mt-2" />
      </div>

      <!-- Remember Me -->


      <div class="flex items-center justify-end mt-4">



          <x-primary-button class="ms-3">
              {{ __('Add') }}
          </x-primary-button>
      </div>
  </form>
</x-guest-layout>
</x-modal>

<x-modal name="add-tool">
<x-guest-layout>
  <h1 >Add Tools</h1>
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('tool.store') }}"  enctype="multipart/form-data" >
      @csrf

      <!-- Email Address -->
      <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
      <br><br>

      <!-- Password -->

      <input type="file" name="path" required>

      <div class="flex items-center justify-end mt-4">



          <x-primary-button class="ms-3">
              {{ __('Add') }}
          </x-primary-button>
      </div>
  </form>
</x-guest-layout>
</x-modal>
</div>
@show


</x-app-layout>


