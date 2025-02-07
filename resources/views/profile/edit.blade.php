



{{--<x-app-layout>
   
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Profile') }}
        </h2>
    </x-slot>
    <x-guest-layout>
    <div class="py-12 align-middle">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl align-middle">
                    @extends('profile.partials.update-profile-information-form')

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @extends('profile.partials.update-password-form')
                   
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @extends('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
     
    
</x-app-layout>
@php  use Illuminate\Support\Facades\Auth; @endphp
@if(Auth::check() && Auth::user()->isworkowner) @php $id=auth()->user()->id @endphp
       
        <ul class="flex space-x-6 mr-6 text-lg">
            <li><a href={{route('offre.show',$id)}}           >show condidates for your offres </a></li>
            <li>
              <span class="font-bold uppercase">
                Welcome {{auth()->user()->name}}
              </span>
            </li>
            <li>
              <a href="{{route('offre.youroffres',$id)}}"  class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Listings</a>
            </li>
            <li>
        <li><a href={{route('offre.youroffres',$id)}}           > your  published   offres </a></li>
            </ul>
        @endif--}}
       
        <x-app-layout>
            
        <h2 class="font-semibold text-xl ml-96 text-white  leading-tight">
                {{ __('Your Profile') }}
            </h2>
        
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
        
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
        
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
            
          
        </x-app-layout>
  