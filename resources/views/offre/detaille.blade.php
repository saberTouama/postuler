



<x-app-layout>



  @php session(['offre_id' => $offre->id]); @endphp
      <div class="mx-4 sm:justify-center items-center pt-6 px-10 w-full text-gray-800 dark:text-gray-400  border   rounded-lg shadow-lg" tyle="border-radius: 10px;">
       @auth <button   x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'postuler') "class="fixed hover:bg-blue-400 hover:text-black top-1/4 right-10 bg-black text-white py-2 px-5 rounded-full flex items-center gap-2"><svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" d="M5 15.747V18a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.253m-6.798-9.83v8.5m3.344-6.15L12.202 5L8.858 8.267"></path>
          </svg> Send CV </button> @endauth  @guest
          <button x-data="{ isLoggedIn: {{ Auth::check() ? 'true' : 'false' }} }"
        x-on:click.prevent=" $dispatch('open-modal', 'login')"class="fixed hover:bg-blue-400 hover:text-black top-1/4 right-10 bg-black text-white py-2 px-5 rounded-full flex items-center gap-2"><svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" d="M5 15.747V18a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.253m-6.798-9.83v8.5m3.344-6.15L12.202 5L8.858 8.267"></path>
          </svg> Send CV </button> @endguest
      <x-card class="p-10 flex ">

        <div class="  text-center w-3/4">

            <div class=" flex ">

            @php $images = json_decode($offre->tools,true );
            if (is_string($images)) {
              $images = [$images]; // Wrap the string in an array
          } elseif (is_null($images)) {
              $images = []; // Set to an empty array if null
          }  @endphp
<div class="flex relative left-10 top-1/3">
          @if($images)

         @foreach ($images as $image)

         <img class="w-14 mr-3 mb-3"
              src="{{$image ? asset('storage/' . $image) : asset('/images/no-image.png')}}" alt="" style="border-radius: 50%"/>
     @endforeach
     @endif </div>


        </div>
   <div>

       <div  class=" justify-center flex " > <small class="ml-2 text-sm text-gray-400 flex gap-2 items-center "> <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 2048 2048">
          <path fill="currentColor" d="M1792 993q60 41 107 93t81 114t50 131t18 141q0 119-45 224t-124 183t-183 123t-224 46q-91 0-176-27t-156-78t-126-122t-85-157H128V128h256V0h128v128h896V0h128v128h256zM256 256v256h1408V256h-128v128h-128V256H512v128H384V256zm643 1280q-3-31-3-64q0-86 24-167t73-153h-97v-128h128v86q41-51 91-90t108-67t121-42t128-15q100 0 192 33V640H256v896zm573 384q93 0 174-35t142-96t96-142t36-175q0-93-35-174t-96-142t-142-96t-175-36q-93 0-174 35t-142 96t-96 142t-36 175q0 93 35 174t96 142t142 96t175 36m64-512h192v128h-320v-384h128zM384 1024h128v128H384zm256 0h128v128H640zm0-256h128v128H640zm-256 512h128v128H384zm256 0h128v128H640zm384-384H896V768h128zm256 0h-128V768h128zm256 0h-128V768h128z" />
        </svg>{{ $offre->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($offre->created_at->eq($offre->updated_at))
                                <small class="text-sm text-gray-600 items-center flex gap-2"> &middot; {{ __('edited') }} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path fill="currentColor" d="m5 16l-1 4l4-1L18 9l-3-3z" opacity="0.16" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 16l-1 4l4-1L19.586 7.414a2 2 0 0 0 0-2.828l-.172-.172a2 2 0 0 0-2.828 0zM15 6l3 3m-5 11h8" />
                                    </g>
                                </svg></small>
                                @endunless </div>

          <div  class=" justify-center flex ">  <img class="w-80 mr-6 mb-6 "
            src="{{$offre->image? asset('storage/' . $offre->image) : asset('/images/no-image.png')}}" alt="" style="border-radius: 10%"/></div>

        </div>

          <h3 class="text-2xl mb-2">
            {{$offre->titre}}
          </h3>
          <div class="text-xl font-bold mb-4">{{$offre->company}}</div>
  <h3>{{$offre->company}}</h3>


            <div class="text-lg my-4   ">
              <div class="text-lg my-4  justify-center  gap-2 flex items-center ">
                <svg class="h-10 w-10 "   xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}>
                        <circle cx={12} cy={10} r={3}></circle>
                        <path d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8"></path>
                    </g>
                </svg> {{$offre->lieu}}
              </div>
              <div class="border border-gray-400 w-full mb-6"></div>
              <div class="items-center justify-center" >
              <div class=" flex justify-center">
            <h1 class="text-3xl font-bold mb-4">recommanded tools</h1> <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" width={36} height={36} viewBox="0 0 36 36">
              <path fill="currentColor" d="M20 14h-4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1m-.4 6.6h-3.2v-5.2h3.2Z" className="clr-i-outline clr-i-outline-path-1"></path>
              <path fill="currentColor" d="m33.71 12.38l-4.09-4.09a1 1 0 0 0-.7-.29h-5V6.05A2 2 0 0 0 22 4h-8.16A1.92 1.92 0 0 0 12 6.05V8H7.08a1 1 0 0 0-.71.29l-4.08 4.09a1 1 0 0 0-.29.71V28a2 2 0 0 0 2 2h28a2 2 0 0 0 2-2V13.08a1 1 0 0 0-.29-.7M14 6h8v2h-8Zm18 11H22v1.93h10V28H4v-9.07h10V17H4v-3.5L7.5 10h21l3.5 3.5Z" className="clr-i-outline clr-i-outline-path-2"></path>
              <path fill="none" d="M0 0h36v36H0z"></path>
            </svg></div>
            <ul>
                 <li> <div>{{$offre->tool1 ?? '' }}</div></li>
                  <h3 class="text-3xl font-bold mb-4"></h3>
                <li>  <div> {{$offre->tool2?? '' }}</div> </li>
                    <h3 class="text-3xl font-bold mb-4"></h3>
                  <li>  <div>  {{$offre->tool3 ?? '' }}</div></li> </ul>  </div>
                    <?php
                    $employer = App\Models\User::find($offre->workowner);
                  //  $employer = Illuminate\Support\Facades\Auth::user()->find($offre->workowner);
                   ?>
            <div class="flex items-center justify-center">  <div>
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
              </svg></a></div> </div>
          </div>
          <div class="border border-gray-400 w-full mb-6"></div>
          <div>
            <div class="flex  items-center gap-2  justify-center">
            <h class="text-3xl font-bold mb-4  flex ">Job Description <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="currentColor" d="M8 18h8v-2H8zm0-4h8v-2H8zm-2 8q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h8l6 6v12q0 .825-.587 1.413T18 22zm7-13h5l-5-5z" />
            </svg></h></div>
            <div class="lg:grid lg:grid-cols-3">
<div>
  <div class="flex  items-center gap-2  justify-center">  <h1 class="text-3xl flex  mb-4">important points: <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                <path d="M4.5 10c0-3.771 0-5.657 1.172-6.828S8.729 2 12.5 2H14c3.771 0 5.657 0 6.828 1.172S22 6.229 22 10v4c0 3.771 0 5.657-1.172 6.828S17.771 22 14 22h-1.5c-3.771 0-5.657 0-6.828-1.172S4.5 17.771 4.5 14z" />
                <path d="M13.25 14.5h.009m0-2.208V9.5M18.25 12a5 5 0 1 1-10 0a5 5 0 0 1 10 0M4.5 6H2m2.5 6H2m2.5 6H2" />
              </g>
            </svg></h1></div>
            <div>{!! nl2br(e($offre->points)) !!}</div></div>
            <div>
            <div class="flex  items-center gap-2  justify-center">     <h3 class="text-3xl flex mb-4"> skills: <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
              <path fill="currentColor" d="M14.057 31.88c-2.854-.37-5.792-1.594-7.932-3.307C1.307 24.729-.88 18.656.37 12.625c.536-2.604 1.932-5.344 3.719-7.318a15.6 15.6 0 0 1 4.677-3.583C11.12.531 13.37-.005 16.026-.005c1.906 0 3.438.25 5.193.849a16.01 16.01 0 0 1 9.948 9.943c.938 2.75 1.109 5.677.51 8.578c-.479 2.292-1.714 4.87-3.234 6.734c-.625.771-2.063 2.146-2.818 2.703a16.2 16.2 0 0 1-7.708 3.078c-.823.104-3.063.099-3.859 0zm4.36-1.338a14.9 14.9 0 0 0 9.672-6.047c2.703-3.797 3.427-8.891 1.901-13.333c-.359-1.042-1.25-2.781-1.901-3.698c-.724-1.026-2.516-2.823-3.547-3.547c-1-.708-2.703-1.568-3.865-1.948A14.75 14.75 0 0 0 8.01 3.584a15.3 15.3 0 0 0-4.385 4.385A14.74 14.74 0 0 0 2.01 20.63c.385 1.161 1.245 2.87 1.948 3.87c.729 1.026 2.521 2.823 3.547 3.547c.922.646 2.656 1.536 3.698 1.901a14.9 14.9 0 0 0 7.214.594m-5.542-5.365a5.6 5.6 0 0 1-2.109-.771c-.578-.37-4.943-4.646-5.156-5.047c-.245-.458.182-1.292.792-1.547l.286-.12l-.88-.896c-.484-.495-.943-1.021-1.016-1.167c-.172-.333-.177-1.047-.016-1.365c.068-.13.229-.328.354-.438c.214-.177.234-.24.214-.688c-.026-.396.01-.552.182-.849c.25-.427.766-.714 1.271-.719c.281 0 .354-.036.474-.245c.313-.547 1.208-.745 1.891-.411l.37.177l.182-.177c.25-.229.75-.432 1.078-.432c.656 0 1.583.755 1.583 1.286c0 .635-.578.745-1.151.219c-.38-.354-.573-.391-.729-.141c-.078.12.109.344 1.229 1.474c1.12 1.125 1.323 1.365 1.323 1.578a.656.656 0 0 1-.63.62c-.203 0-.536-.292-2.073-1.823c-1.568-1.563-1.854-1.813-1.979-1.734c-.339.214-.224.37 1.609 2.208c.995 1 1.813 1.885 1.813 1.969c0 .172-.156.49-.286.573a.76.76 0 0 1-.339.063c-.214.005-.542-.292-2.286-2.031c-1.75-1.74-2.063-2.021-2.188-1.943c-.344.219-.229.37 1.766 2.375c1.089 1.089 2 2.063 2.026 2.167c.057.188-.068.516-.234.63a.8.8 0 0 1-.349.063c-.214 0-.484-.234-1.927-1.677c-1.391-1.391-1.714-1.677-1.891-1.661c-.5.057-.323.281 2.26 2.87c2.24 2.245 2.526 2.563 2.526 2.797a.51.51 0 0 1-.224.438c-.401.318-.557.245-1.568-.734c-.516-.495-1.047-.974-1.188-1.063c-.255-.156-.901-.224-1.021-.099c-.042.036.911 1.042 2.115 2.234c2.005 1.984 2.234 2.188 2.823 2.469a3.94 3.94 0 0 0 3.495.01c1.682-.802 2.615-2.75 2.156-4.516c-.229-.88-.516-1.302-1.672-2.495c-1.333-1.365-1.641-1.74-1.969-2.396c-.365-.734-.521-1.448-.521-2.339c0-.964.099-1.401.526-2.302c.406-.859 1.255-1.76 2.094-2.224c1.646-.917 3.813-.839 5.385.188c.313.203 1.443 1.266 2.849 2.677c2.089 2.094 2.328 2.365 2.328 2.604c0 .568-.464 1.198-.979 1.328c-.193.052-.156.104.719.995c.51.516.984 1.073 1.057 1.245c.245.589.135 1.161-.313 1.63c-.229.24-.26.323-.266.802c-.005.422-.052.599-.219.839a1.48 1.48 0 0 1-1.188.651c-.323 0-.385.031-.547.276c-.365.563-1.313.76-1.927.396l-.307-.182l-.219.214c-.484.464-1.266.526-1.859.146c-.479-.302-.833-.724-.833-.99c0-.234.339-.62.547-.62c.198 0 .464.156.766.438c.302.286.563.286.604-.005c.021-.156-.229-.453-1.24-1.469c-1.063-1.073-1.266-1.318-1.266-1.526a.85.85 0 0 1 .063-.339c.115-.172.438-.292.635-.24c.104.026.984.839 1.948 1.802c.969.969 1.818 1.76 1.896 1.76c.214 0 .354-.214.255-.396c-.047-.083-.865-.922-1.813-1.87c-1.484-1.479-1.724-1.755-1.724-1.974a.8.8 0 0 1 .063-.344c.089-.13.401-.286.578-.286c.078 0 1.057.911 2.177 2.026c2.052 2.042 2.203 2.156 2.417 1.818c.078-.125-.203-.443-1.943-2.188c-1.797-1.802-2.036-2.073-2.036-2.307c0-.161.073-.328.188-.432c.38-.359.495-.286 2.344 1.552c1.75 1.745 1.906 1.859 2.12 1.526c.078-.125-.276-.51-2.448-2.688c-2.365-2.375-2.536-2.568-2.536-2.844c0-.417.24-.615.703-.583c.083.005.583.427 1.099.932c.521.505 1.083.979 1.25 1.052c.328.135.708.156.87.052c.156-.099-4.167-4.354-4.729-4.651a4.013 4.013 0 0 0-5.547 1.844c-.271.578-.307.75-.344 1.495c-.031.703-.005.922.146 1.37c.271.797.505 1.125 1.719 2.365c1.313 1.344 1.563 1.651 1.896 2.37c.938 2 .542 4.313-1.005 5.854c-1.177 1.182-2.781 1.734-4.37 1.516z" />
            </svg></h3></div>
              <div>{!! nl2br(e($offre->skills)) !!}</div> </div>
              <div>  <h3 class="text-3xl flex mb-4">responsabilities: <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                <path fill="currentColor" d="M29.29 4.95h-7.2a4.31 4.31 0 0 0-8.17 0H7a1.75 1.75 0 0 0-2 1.69v25.62a1.7 1.7 0 0 0 1.71 1.69h22.58A1.7 1.7 0 0 0 31 32.26V6.64a1.7 1.7 0 0 0-1.71-1.69m-18 3a1 1 0 0 1 1-1h3.44v-.63a2.31 2.31 0 0 1 4.63 0V7h3.44a1 1 0 0 1 1 1v1.8H11.25Zm14.52 9.23l-9.12 9.12l-5.24-5.24a1.4 1.4 0 0 1 2-2l3.26 3.26l7.14-7.14a1.4 1.4 0 1 1 2 2Z" class="clr-i-solid clr-i-solid-path-1" />
                <path fill="none" d="M0 0h36v36H0z" />
              </svg></h3>
              <div> {!! nl2br(e($offre->works)) !!}</div> </div>

            </div>
            <div class="text-lg space-y-6">






            </div>
         </div>
        </div>

                <div class="flex  w-1/4 rounded-lg justify-end hover:bg-gray-800 px-0">
                 @livewire('chirps')

        </div>
        <x-modal name="chirps">     @include('chirps.index')
        </x-modal>

      </x-card>

      {{-- <x-card class="mt-4 p-2 flex space-x-6">
        <a href="/offres/{{$offre->id}}/edit">
          <i class="fa-solid fa-pencil"></i> Edit
        </a>

        <form method="POST" action="/offres/{{$offre->id}}">
          @csrf
          @method('DELETE')
          <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
        </form>
      </x-card> --}}
      <div id="map" class="rounded-xl" style="height: 400px; width: 100%;"></div>

      <script src="https://maps.googleapis.com/maps/api/js?AIzaSyCO_JbB75acgxNQNe7RikwXKqpQMLFd5co"></script>
      <script>
          function initMap() {
              const savedLocation = {
                  lat: {{ $offre->latitude }},
                  lng: {{ $offre->longitude }}
              };

              const map = new google.maps.Map(document.getElementById('map'), {
                  center: savedLocation,
                  zoom: 10
              });

              new google.maps.Marker({
                  position: savedLocation,
                  map: map,
                  title: 'Saved Location'
              });
          }

          initMap();
      </script>
    </div>
    <br><br><br><br>
  </x-app-layout>
  @auth




  <x-modal x-data="" name="postuler"  :show="$errors->get('user_id')||$errors->get('Cemail')||$errors->get('Cname')"  >

    <style>
        #form:hover{
            transform: scale(1.05);

        }</style>

<x-guest-layout>

<form  method="POST"  action="{{ route('worker.store') }}" enctype="multipart/form-data" >
    @csrf
    <div> @php $user_id=auth()->user()->id @endphp
        <input type="hidden" name="user_id" value="{{$user_id}}" >
        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="Cemail" :value="__('Email')" />
        <x-text-input id="Cemail" class="block mt-1 w-full" type="email" name="Cemail" value="{{ old('Cemail') }}" required autocomplete="email" />
        <x-input-error :messages="$errors->get('Cemail')" class="mt-2" />
    </div>

    <br><br>

    <div>
        <x-input-label for="Cname" :value="__('Name')" />
        <x-text-input id="Cname" class="block mt-1 w-full" type="text" name="Cname" value="{{ old('Cname') }}" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('Cname')" class="mt-2" />
    </div><br><br>


    <div>
        <x-input-label for="hire_date" :value="__('hire date')" />
        <x-text-input id="hire_date" class="block mt-1 w-full" type="date" name="hire_date" :value="old('hire_date')" required autofocus autocomplete="hire_date" /> </div>
        <div class="mt-4">
            <label for="cv" class="block text-sm font-medium text-gray-700 mb-1">Upload your CV</label>
            <x-text-input
                type="file"
                id="cv"
                name="cv"
                accept=".pdf,.doc,.docx"
                class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100"
                required
            />
            <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, DOC, DOCX. Max size: 2MB.</p>
        </div>
        <br><br>
    <script>
        document.getElementById('cv').addEventListener('change', function(event) {
            var file = event.target.files[0];

            if (file.size > 2*1024 * 1024) { // 2048 KB in bytes2048 *
                alert('File size should not exceed 1 MB.');
                event.target.value = ''; // Reset the input
            }
        });
    </script>



        <input type="hidden" name="concernedoffre" value="{{$offre->id}}">

        <x-primary-button class="mt-4">{{ __('SUBMIT') }}</x-primary-button>

</form>
<br><br><br><br>
<script>
    // Set the max attribute dynamically to ensure age is at least 18
    const birthdateInput = document.getElementById('hire_date');
    const today = new Date();
    const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

    // Set max to the date 18 years ago
    birthdateInput.max = eighteenYearsAgo.toISOString().split('T')[0];

    // Add a custom validation message if needed
    document.getElementById('form').addEventListener('submit', function (event) {
        const selectedDate = new Date(birthdateInput.value);
        if (selectedDate > eighteenYearsAgo) {
            alert('You must be at least 18 years old.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

</x-guest-layout>


  </x-modal>
  <x-modal name="seccess"  x-data=""  :show="session('success')">

    <div class="p-6 bg-green-50 border border-green-200 rounded-lg shadow-md">
        <div class="flex items-center space-x-3">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 13l4 4L19 7"/>
            </svg>
            <h2 class="text-green-700 font-semibold text-7xl">Success✔</h2>
        </div>
        <p class="mt-3 text-3xl text-green-600">
            {{ session('success') ?? 'Opération effectuée avec succès.' }}
        </p>
    </div>
  </x-modal>

@endauth
