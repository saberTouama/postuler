
<x-app-layout>
    <style>
    #map:hover {

    }</style>

    <div class="min-h-screen shadow-2xl flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>
    @php $id=auth()->user()->id;@endphp

  <form method="POST"  class="mr-20 ml-20 bg-blue-300 sm:rounded-lg  z-50 w-screen  sm:w-auto px-4  shadow-2xl ring-4"  action="{{route('offre.store')}}" enctype="multipart/form-data" >
        @csrf
     <div class="lg:grid lg:grid-cols-2 sm:grid-cols-1  justify-between gap-10">
        <div>
        <div>
            <x-input-label for="titre" :value="__('titre')" />
            <x-text-input id="titre" class="block mt-1 w-full" type="text" max="255" name="titre" :value="old('titre')"  autofocus autocomplete="titre" />
            <x-input-error :messages="$errors->get('titre')" class="mt-2" />
        </div>
        <div> <select name="category" class="block rounded-3xl hover:bg-white  mt-1 l bg-gray-400"  >

            <option  disabled selected  class="text-gray-400" ><p>{{__('Select  Category')}}</p></option>
            @foreach($catigories as $catigory)
                <option class="text-gray-400 " value={{$catigory->id}}> {{$catigory->name}}</option>
                @endforeach
            </select> </div>
        <div>
            <x-input-label for="company" :value="__('company')" />            <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" max="255" :value="old('company')"  autofocus autocomplete="company" />
            <x-input-error :messages="$errors->get('company')" class="mt-2" />
        </div>
      <div>
            <div> <select name="lieu" class="block rounded-3xl hover:bg-white  mt-1 l bg-gray-400"  >

                <option   disabled selected class="text-gray-400" ><p>{{__('Select  Region')}}</p></option>

                    <option class="text-gray-400 " value="Alger">Alger </option>
                    <option class="text-gray-400 " value="Boumerdes"> Boumerdes</option>
                    <option class="text-gray-400 " value="Annaba"> Annaba</option>
                    <option class="text-gray-400 " value="Oran">oran </option>
                    <option class="text-gray-400 " value="Bejaia">Bejaia </option>
                    <option class="text-gray-400 " value="Setif"> Stef</option>
                    <option class="text-gray-400 " value="Tizi Ouzou">Tizi Ouzou </option>

                </select> </div>
                <x-input-error :messages="$errors->get('lieu')" class="mt-2" />
                </div>



        <div>
            <x-input-label for="nb_post" :value="__('nb_post')" />
            <x-text-input id="nb_post" class="block mt-1 w-full" type="number" name="nb_post" :value="old('nb_post')" min="1"  autofocus autocomplete="nb_post" />
            <x-input-error :messages="$errors->get('nb_post')" class="mt-2" />
        </div>


        <label>recommanded skills</label>
        <textarea  x-model="form.description"
    @keydown.enter.prevent="$event.target.value += '\n'"
        name="skills"
        placeholder="{{ __('') }}"
        class="block w-full border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm border-0 border-b-2  hover:bg-gray-400 bg-transparent "
    >
    {{ old('skills') }}
        </textarea>
       <br><br>
       <label for="works">responsabilities  </label>

       <textarea
        x-model="form.description"
    @keydown.enter.prevent="$event.target.value += '\n'"
       name="works"
       placeholder="{{ __('') }}"
       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm border-0 border-b-2  hover:bg-gray-400 bg-transparent "
   >
   {{ old('works') }}
       </textarea>
       <br><br>
       <label>important notes  </label>
       <textarea  x-model="form.description"
    @keydown.enter.prevent="$event.target.value += '\n'"
       name="points"
       placeholder="{{ __('') }}"
       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm  border-0 border-b-2  hover:bg-gray-400 bg-transparent"
   >
   {{ old('points') }}
       </textarea>


        <br><br>
    </div>
        <div>
        <div>
            <x-input-label for="website" :value="__('website')" />
            <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')"  autofocus autocomplete="website" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="image" :value="__('image')" />
            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" accept=".jfif,.jpg,.png,.svg" :value="old('image')"  autofocus autocomplete="image" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <script>
            document.getElementById('image').addEventListener('change', function(event) {
                var file = event.target.files[0];

                if (file.size > 1024 * 1024) {
                    alert('image size should not exceed 1 MB.');
                    event.target.value = '';
                }
            });
        </script>

        <div>
            <x-input-label for="tool1" :value="__('tool1')" />
            <x-text-input id="tool1" class="block mt-1 w-full" type="text" name="tool1" :value="old('tool1')"  autofocus autocomplete="tool1" />
            <x-input-error :messages="$errors->get('tool1')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="tool2" :value="__('tool2')" />
            <x-text-input id="tool2" class="block mt-1 w-full" type="text" name="tool2" :value="old('tool2')"  autofocus autocomplete="tool2" />
            <x-input-error :messages="$errors->get('tool2')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="tool3" :value="__('too3')" />
            <x-text-input id="tool3" class="block mt-1 w-full" type="text" name="tool3" :value="old('tool3')"  autofocus autocomplete="tool3" />
            <x-input-error :messages="$errors->get('tool3')" class="mt-2" />
        </div>
        <div class="lg:grid lg:grid-cols-3 sm:grid-cols-2">
            @foreach ($tools as $tool)
              <div class="flex items-center">
                <input type="checkbox" name="tools[]" id="tool-{{ $tool->id }}" value="{{ $tool->path }}" class="mr-2">
                <label for="tool-{{ $tool->id }}">{{ $tool->name }}</label>
              </div>
            @endforeach
          </div> <br><br>

<input type="hidden" name="workowner" value="{{$id}}">
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">

<x-primary-button class="mt-4  justify-center top-1/3 ">{{ __('PUBLISH') }}</x-primary-button>

 </div>

 </div>
    </form>

</div>

<div class="rounded-xl" id="map" style="height: 400px; width: 100%;"></div>
    {{--
    <div class="bg-green-300">




        <!-- Step 1: Basic Information   <div id="step-1" class="step"> -->

            <form   action="/step1"   method="POST" >
                @csrf
            <h2>Step 1: Basic Information</h2>
            <div>
                <x-input-label for="titre" :value="__('titre')" />
                <x-text-input id="titre" class="block mt-1 w-full" type="text" max="255" name="titre" :value="old('titre')" autofocus autocomplete="titre" required />
                <x-input-error :messages="$errors->get('titre')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="company" :value="__('company')" />
                <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" max="255" :value="old('company')" autofocus autocomplete="company" required />
                <x-input-error :messages="$errors->get('company')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="lieu" :value="__('lieu')" />
                <x-text-input id="lieu" class="block mt-1 w-full" type="text" name="lieu" :value="old('lieu')" autofocus autocomplete="lieu"  />
                <x-input-error :messages="$errors->get('lieu')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="nb_post" :value="__('nb_post')" />
                <x-text-input id="nb_post" class="block mt-1 w-full" type="number" name="nb_post" :value="old('nb_post')" min="1" autofocus autocomplete="nb_post" required/>
                <x-input-error :messages="$errors->get('nb_post')" class="mt-2" />
            </div>
            <button  type="submit" class="next-step mt-4 bg-blue-500 text-white px-4 py-2 rounded">Next</button>

        </form>


        <!-- Step 2: Job Details -->
       <form method="POST" action="/step2">
        @csrf
            <h2>Step 2: Job Details</h2>
            <label>Recommended Skills</label>
            <textarea
                name="skills"
                placeholder="{{ __('') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('skills') }}</textarea>
            <br><br>
            <label for="works">Responsibilities</label>
            <textarea
                name="works"
                placeholder="{{ __('') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('works') }}</textarea>
            <br><br>
            <label>Important Notes</label>
            <textarea required
                name="points"
                placeholder="{{ __('') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('points') }}</textarea>
            <button type="button" class="prev-step mt-4 bg-gray-500 text-white px-4 py-2 rounded">Previous</button>
            <button type="submit" class="next-step mt-4 bg-blue-500 text-white px-4 py-2 rounded">Next</button>
        </div>
    </form>
        <!-- Step 3: Tools and Media -->
       <form method="post" action="/step3"  enctype="multipart/form-data">
        @csrf
            <h2>Step 3: Tools and Media</h2>
            <div>
                <x-input-label for="website" :value="__('website')" />
                <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')" autofocus autocomplete="website" />
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="image" :value="__('image')" />
                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" accept=".jfif,.jpg,.png" :value="old('image')" autofocus autocomplete="image" required />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="tool1" :value="__('tool1')" />
                <x-text-input id="tool1" class="block mt-1 w-full" type="text" name="tool1" :value="old('tool1')" autofocus autocomplete="tool1" />
                <x-input-error :messages="$errors->get('tool1')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="tool2" :value="__('tool2')" />
                <x-text-input id="tool2" class="block mt-1 w-full" type="text" name="tool2" :value="old('tool2')" autofocus autocomplete="tool2" />
                <x-input-error :messages="$errors->get('tool2')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="tool3" :value="__('tool3')" />
                <x-text-input id="tool3" class="block mt-1 w-full" type="text" name="tool3" :value="old('tool3')" autofocus autocomplete="tool3" />
                <x-input-error :messages="$errors->get('tool3')" class="mt-2" />
            </div>
            <input type="hidden" name="workowner" value="{{ $id }}">
            <button type="button" class="prev-step mt-4 bg-gray-500 text-white px-4 py-2 rounded">Previous</button>
            <x-primary-button class="mt-4">{{ __('PUBLISH') }}</x-primary-button>
       </form>

</div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const steps = document.querySelectorAll('.step');
            let currentStep = 0;

            // Show the first step



            document.querySelectorAll('.next-step').forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep < steps.length - 1) {
                        steps[currentStep].classList.add('hidden');
                        currentStep++;
                        steps[currentStep].classList.remove('hidden');
                    }
                });
            });


            document.querySelectorAll('.prev-step').forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep > 0) {
                        steps[currentStep].classList.add('hidden');
                        currentStep--;
                        steps[currentStep].classList.remove('hidden');
                    }
                });
            });
        });
    </script>--}}

</x-app-layout>
<script>
    $('#title').html('Publish Job Offer');
  </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCO_JbB75acgxNQNe7RikwXKqpQMLFd5co&libraries=places"></script>
<script>
    let map;
    let marker;

    // Initialize the map
    function initMap() {


        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 35.93790606, lng:4.6557431 }, // Default center
            zoom: 8
        });

        // Add click listener to capture coordinates
        map.addListener('click', (e) => {
            const lat = e.latLng.lat();
            const lng = e.latLng.lng();

            // Update hidden inputs
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Add/update marker
            if (marker) marker.setMap(null);
            marker = new google.maps.Marker({
                position: { lat,lng },
                map: map
            });
        });

        // Optional: Add search box
        const searchBox = new google.maps.places.SearchBox(
            document.createElement('input')
        );
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(searchBox);
        searchBox.addListener('places_changed', () => {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;
            const place = places[0];
            map.panTo(place.geometry.location);
        });
    }

    // Initialize the map on page load
    initMap();
</script>
