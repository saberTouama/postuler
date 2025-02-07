
<x-app-layout>

    @section('users') @endsection
    <div class="sm:justify-center items-center pt-6 px-10" style="border-radius: 10px">
<table class="w-full bg-white border border-gray-300 text-gray-700 rounded-lg shadow-lg border-separate ">
    <th class="bg-blue-400">Name</th><th  class="bg-blue-400">Email</th><th  class="bg-blue-400">Role</th><th  class="bg-blue-400"> Action</th><th></th>
@foreach($users as $user)
@php $id=$user->id @endphp

    <tr class="hover:bg-blue-200"><td>{{$user->name}}</td> <td><a class="text-blue-700" href="mailto:{{$user->email}}">{{$user->email}}</a></td> <td class="uppercase">{{$user->role}}</td> <td>@if($user->role == 'workowner' and !$user->isworkowner) <a class="text-green-500" href="accept-workowner/{{$id}}">accept as work owner ✔</a>
         @endif </td>  <td><x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion');
                            document.getElementById('user_id').value = {{ $user->id }};"
        >{{ __('Delete Account') }}</x-danger-button></td>

    </tr>




@endforeach
</table>
</div>
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.delete_user') }}" class="p-6">
        @csrf
      @method('post')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete user?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once  account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>

        <div class="mt-6">


            <input

            id="user_id"
            name="user_id"
            type="hidden"
            value=""

            />


        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>

</x-app-layout>
