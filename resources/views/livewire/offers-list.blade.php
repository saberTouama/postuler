<div>
    @use('App\Models\tool')
    <x-app-layout>
    <style>
        img:hover {
            transform: scale(1.2);
        }
#card:hover{
    transform: scale(1.05);

}  select option:disabled {
  color: gray; /* Style the disabled option */
}

</style>



        <div class="max-w-2xl mx-auto p-4 sm:p-6  lg:p-8 lg:grid lg:grid-cols-3 " >
            <!-- Search Form -->
            <div class="flex">
            <form   method="GET">
                <div class="flex">
                <div >

                    <x-text-input id="search" wire:model.debounce.500ms="search" class=" rounded-3xl hover:bg-white   mt-1  l w-full  bg-green-300" style="border-radius:30px;" type="text" name="search" :value="old('search')" required autofocus autocomplete="search" placeholder=" 🔍 Search for offers..." required  />
                    <x-input-error :messages="$errors->get('search')" class="mt-2"  />

                </div>
            </div>

         {{--   <x-primary-button class="ms-4">
                {{ __('Search') }} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                </svg>
            </x-primary-button>--}}
        </form></div>
        <div>
                <form id="categoryForm" method="get" class="rounded-lg">
                    @csrf

                <select wire:model="category" name="category" id="category" class="bg-transparent hover:bg-white text-gray-400 hover:text-slate-950  border-gray-300 focus:border-indigo-500   shadow-sm w-full border-0 border-b-2  focus:ring-0 rounded-3xl"  >
                 <div  class="rounded-lg">  <option disabled selected class="text-gray-400" value="">Filter By Categories</option></div>
                 <option  class="text-gray-400" value="">All Categories</option>
                    @foreach ($catigories as $category)
                    <div  class="rounded-lg">     <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option></div>
                    @endforeach
                </select>
                </form>
        </div>

                <div >

                    <select wire:model="region" name="region" class="bg-transparent text-gray-400 hover:text-slate-950 border-gray-300 focus:border-indigo-500 hover:bg-white    shadow-sm w-full border-0 border-b-2  focus:ring-0 rounded-3xl" onchange="this.form.submit()" >

                    <option disabled selected  class="text-white" ><p class="text-white">{{__('Filter By Region')}}</p></option>
                    <option  class="text-gray-600" value="">All Regions</option>
                        <option class="text-gray-600" value="Alger" {{ request('region') =="Alger" ? 'selected' : '' }}>Alger </option>
                        <option class="text-gray-600 " value="Boumerdes" {{ request('region') == "Boumerdes" ? 'selected' : '' }}> Boumerdes</option>
                        <option class="text-gray-600 " value="Annaba" {{ request('region') =="Annaba" ? 'selected' : '' }}> Annaba</option>
                        <option class="text-gray-600 " value="Oran" {{ request('region') == "Oran" ? 'selected' : '' }}>oran </option>
                        <option class="text-gray-600" value="Bejaia" {{ request('region') == "Bejaia"? 'selected' : '' }}>Bejaia </option>
                        <option class="text-gray-600 " value="Setif" {{ request('region') == "Setif" ? 'selected' : '' }}> Stef</option>
                        <option class="text-gray-600 " value="Tizi Ouzou" {{ request('region') =="Tizi Ouzou" ? 'selected' : '' }}>Tizi Ouzou </option>

                    </select>  </div>

            </div><br>
            <span class="font-bold uppercase  absolute  justify-center ml-12 text-white gap-2 flex  ">
                Job Offers List  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path stroke-dasharray="2" stroke-dashoffset="2" d="M4 5h0.01">
                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.1s" values="2;0" />
                        </path>
                        <path stroke-dasharray="14" stroke-dashoffset="14" d="M8 5h12">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.1s" dur="0.2s" values="14;0" />
                        </path>
                        <path stroke-dasharray="2" stroke-dashoffset="2" d="M4 10h0.01">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.3s" dur="0.1s" values="2;0" />
                        </path>
                        <path stroke-dasharray="14" stroke-dashoffset="14" d="M8 10h12">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="14;0" />
                        </path>
                        <path stroke-dasharray="2" stroke-dashoffset="2" d="M4 15h0.01">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.1s" values="2;0" />
                        </path>
                        <path stroke-dasharray="14" stroke-dashoffset="14" d="M8 15h12">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.7s" dur="0.2s" values="14;0" />
                        </path>
                        <path stroke-dasharray="2" stroke-dashoffset="2" d="M4 20h0.01">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.9s" dur="0.1s" values="2;0" />
                        </path>
                        <path stroke-dasharray="14" stroke-dashoffset="14" d="M8 20h12">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="1s" dur="0.2s" values="14;0" />
                        </path>
                    </g>
                </svg>:
              </span> <br><br> <br>





 <div id="work-offers-list" class="mx-4 py-10 px-10 dark:bg-gray-700 bg-violet-100 colored lg:grid lg:grid-cols-4 gap-4 space-y-4 md:space-y-0 sm:grid-cols-2 md:grid-cols-3  xl:grid-cols-5  grid grid-cols-auto-fit " wire:poll.1s>

      @foreach($offres as $offre)


        <x-card id="card" class="p-10 bg-white hover:bg-blue-500" style="border-radius: 10%">

            <div id="{{$offre->id}}" class="" style="display: inline; margin-left: 5px; border-radious:12px;">

                @php      $tools = DB::table('tools')
                ->join('offer_tools', 'tools.id', '=', 'offer_tools.tool_id')
                ->where('offer_tools.offer_id', $offre->id)
                ->select('tools.*') // Select only tool fields
                ->get(); @endphp

                <div class="lg:grid lg:grid-cols-4">


                 @php $count = 0; @endphp
                 @foreach ($tools as $tool )
                        @if($tool && $tool->path)
                            <img src="{{ asset('storage/' . $tool->path) }}" alt="Tool image" class="w-7 h-7" title="{{$tool->name}}">
                        @else
                            <!-- Optional: placeholder if tool/image is missing -->
                            <div class="bg-gray-200 w-full aspect-square flex items-center justify-center">
                                <span class="text-gray-500">No image</span>
                            </div>
                        @endif
                        @php $count++; @endphp
                        @if ($count >= 4)
                        @break
                    @endif
                    @endforeach


                        </div>


        </div>

            <x-dropdown>

                <x-slot name="trigger">


                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">


                    <x-dropdown-link :href="route('offre.workerinput',$offre->id)" >
                        {{ __('Send CV') }}
                    </x-dropdown-link>



                             @php
                             $id=$offre->id;


                             @endphp






                </x-slot>
            </x-dropdown>
            <small class="ml-2 text-sm text-gray-600 flex"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048">
                <path fill="currentColor" d="M1792 993q60 41 107 93t81 114t50 131t18 141q0 119-45 224t-124 183t-183 123t-224 46q-91 0-176-27t-156-78t-126-122t-85-157H128V128h256V0h128v128h896V0h128v128h256zM256 256v256h1408V256h-128v128h-128V256H512v128H384V256zm643 1280q-3-31-3-64q0-86 24-167t73-153h-97v-128h128v86q41-51 91-90t108-67t121-42t128-15q100 0 192 33V640H256v896zm573 384q93 0 174-35t142-96t96-142t36-175q0-93-35-174t-96-142t-142-96t-175-36q-93 0-174 35t-142 96t-96 142t-36 175q0 93 35 174t96 142t142 96t175 36m64-512h192v128h-320v-384h128zM384 1024h128v128H384zm256 0h128v128H640zm0-256h128v128H640zm-256 512h128v128H384zm256 0h128v128H640zm384-384H896V768h128zm256 0h-128V768h128zm256 0h-128V768h128z" />
            </svg>{{ $offre->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($offre->created_at->eq($offre->updated_at))
                                    <small class="text-sm text-gray-600 items-center flex gap-2"> &middot; {{ __('edited') }} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <path fill="currentColor" d="m5 16l-1 4l4-1L18 9l-3-3z" opacity="0.16" />
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 16l-1 4l4-1L19.586 7.414a2 2 0 0 0 0-2.828l-.172-.172a2 2 0 0 0-2.828 0zM15 6l3 3m-5 11h8" />
                                        </g>
                                    </svg></small>
                                @endunless


          <div class="flex flex-col items-center justify-center text-center">
            <a  href="{{route("offre.detaille", $offre)}}"> <img  title="Show Offer Details" class="w-60 mr-6 mb-6"
              src="{{$offre->image ? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" style="border-radius: 20%"/>
            </a>
            <div class="text-xl text-violet-700 font-bold mb-4">{{$offre->titre}}</div>
            <div class="text-xl text-blue-800 font-bold mb-4">{{$offre->company}}</div>



                <div class="text-lg my-4  gap-2 flex">
                    <svg class="h-5 w-5"   xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}>
                            <circle cx={12} cy={10} r={3}></circle>
                            <path d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8"></path>
                        </g>
                    </svg> {{$offre->lieu}}
                  </div>

            <div>

              <div class="text-lg space-y-6">
                {{-- $offre->description['points'] ?? '' }}                {{ $offre->description['skills'] ?? '' }}
                   {{$offre->description['works'] ?? ''--}}
                 </div>

                 <?php
                 $employer = App\Models\User::find($offre->workowner);
               //  $employer = Illuminate\Support\Facades\Auth::user()->find($offre->workowner);
                ?>
                 <div class="lg:grid lg:grid-cols-2">  <div >
                   <a href="mailto:{{$employer->email}}"
                      class=" bg-green-300 text-black hover:bg-black hover:text-white py-2 rounded-xl hover:opacity-80 items-center gap-2 flex "> Contact <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width={512} height={512} viewBox="0 0 512 512">
                        <path fill="currentColor" fillRule="evenodd" d="M356.3 234.667q48.224 0 79.707 25.985q15.665 12.992 24.419 31.92q8.907 19.568 8.907 43.147q0 37.374-20.733 59.67q-18.582 19.89-41.926 19.89q-24.88 0-27.337-22.617q-15.358 22.616-41.466 22.616q-21.04 0-33.326-12.19q-13.362-13.154-13.362-36.09q0-15.239 6.067-29.915q6.067-14.678 16.816-25.424q20.426-20.37 52.524-20.37q24.266 0 45.305 7.859l-10.29 66.727q-1.535 9.784-1.535 14.275q0 11.068 9.368 11.068q12.285 0 21.962-14.917q11.825-18.126 11.825-42.988q0-34.166-23.037-53.253q-25.493-21.012-63.274-21.012q-29.18 0-53.137 14.436q-22.577 13.635-33.941 36.892q-9.06 18.928-9.061 42.025q0 43.79 30.408 69.454q26.722 22.616 67.882 22.616q23.496 0 49.759-8.982l4.453 24.701q-27.796 9.144-56.67 9.143q-53.137 0-86.464-30.957q-35.476-32.722-35.476-86.617q0-50.847 33.633-83.569q34.71-33.523 88-33.523m10.75 78.917q-8.753 0-17.354 4.571q-8.6 4.572-14.743 12.592q-12.594 16.2-12.593 36.25q0 11.229 5.528 17.725q5.53 6.495 15.05 6.496q13.823 0 22.884-11.87q4.76-6.095 7.525-23.579l6.45-39.94q-7.832-2.245-12.746-2.245M448 64l.003 187.94a138.8 138.8 0 0 0-42.668-27.978L405.333 128L289.171 228.35a139.1 139.1 0 0 0-35.913 26.293L106.667 128v192l110.377-.001a139 139 0 0 0-3.71 32.001q.001 5.386.404 10.668L64 362.667V64zm-80 42.667H144l112 96z"></path>
                      </svg>
                     </a></div>


                      <div>    <a href="{{$offre->site}}" target="_blank"
                      class=" bg-black hover:bg-green-300 hover:text-black text-white py-2 rounded-xl hover:opacity-80 items-center gap-2 flex ">
                   Website <svg  class="h-6 w-6"  xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" strokeWidth={1.5}>
                          <path strokeLinecap="round" strokeLinejoin="round" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10"></path>
                          <path strokeLinecap="round" strokeLinejoin="round" d="M13 2.05S16 6 16 12m-5 9.95S8 18 8 12s3-9.95 3-9.95M2.63 15.5H12m-9.37-7h18.74"></path>
                          <path d="M21.879 17.917c.494.304.463 1.043-.045 1.101l-2.567.291l-1.151 2.312c-.228.459-.933.234-1.05-.334l-1.255-6.116c-.099-.48.333-.782.75-.525z" clipRule="evenodd"></path>
                        </g>
                      </svg></a></div> </div>
            </div>
          </div>


        </x-card>

      @endforeach
        </div>

    <div class="items-center flex  justify-center h-screen">
        {{ $offres->links() }}
   </div>

 <br><br><br><br>
 <br><br><br><br>
 <br><br><br><br>
</x-app-layout>
</div>
