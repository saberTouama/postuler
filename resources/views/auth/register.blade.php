<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="Rname" :value="__('Name')" />
            <x-text-input id="Rname" class="block mt-1 w-full" type="text" name="Rname" :value="old('Rname')" required autofocus autocomplete="Rname" />
            <x-input-error :messages="$errors->get('Rname')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="Remail" :value="__('Email')" />
            <x-text-input id="Remail" class="block mt-1 w-full" type="email" name="Remail" :value="old('Remail')" required autocomplete="Remail" />
            <x-input-error :messages="$errors->get('Remail')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="Rpassword" :value="__('Password')" />

            <x-text-input id="Rpassword" class="block mt-1 w-full"
                            type="Rpassword"
                            name="Rpassword"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('Rpassword')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button  x-data="" x-on:click.prevent="$dispatch('open-modal', 'login');$dispatch('close');" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </button>
<label for="is_workowner">Are you a work owner?</label>
        <input type="checkbox" name="isworkowner" id="isworkowner" value="1">

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
