


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
       <div class="flex"> <x-text-input type="file" id="cv" class="mt-4 rounded-full bg-white" name="cv" placeholder="your  cv" accept=".pdf,.doc,.docx" required />  <svg class="w-7 h-7 rounded-full" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" d="M5 15.747V18a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.253m-6.798-9.83v8.5m3.344-6.15L12.202 5L8.858 8.267"></path>
          </svg> </div><br><br>
        <script>
            document.getElementById('cv').addEventListener('change', function(event) {
                var file = event.target.files[0];

                if (file.size > 2*1024 * 1024) { // 2048 KB in bytes2048 *
                    alert('File size should not exceed 1 MB.');
                    event.target.value = ''; // Reset the input
                }
            });
        </script>



            <input type="hidden" name="concernedoffre" value="{{$offre>$id}}">

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


