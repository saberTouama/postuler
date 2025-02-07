<?php use Illuminate\Support\Facades\Auth; ?>

<nav x-data="{ open: false }" class="bg-blue-400  border-b border-gray-100">





    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-nav-link :href=" route('dashboard') ">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </x-nav-link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" title="Dashboard" class="hover:bg-gray-100" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }} <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z"></path>
                        </svg>
                    </x-nav-link>

                    <x-nav-link title="Home" :href="route('offre.create')" class="hover:bg-gray-100" :active="request()->routeIs('offre.create')" >
                        {{ __('Home') }} <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                            <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z"></path>
                        </svg>
                    </x-nav-link>

                </div>

            </div>

            <!-- Settings Dropdown  -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
             {{-- <x-dropdown align="right" width="48">--}}
                    <x-slot name="trigger"  xmlns="http://www.w3.org/2000/svg">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                      @auth <div>{{ Auth::user()->name }}</div> @endauth

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>


                        <x-dropdown-link title="Your Profile" class="items-center gap-2 flex " :href="route('profile.update')">
                            {{ __('Profile') }}<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={512} height={512} viewBox="0 0 512 512">
                                <path fill="currentColor" fillRule="evenodd" d="M256 42.667A213.333 213.333 0 0 1 469.334 256c0 117.821-95.513 213.334-213.334 213.334c-117.82 0-213.333-95.513-213.333-213.334C42.667 138.18 138.18 42.667 256 42.667m21.334 234.667h-42.667c-52.815 0-98.158 31.987-117.715 77.648c30.944 43.391 81.692 71.685 139.048 71.685s108.104-28.294 139.049-71.688c-19.557-45.658-64.9-77.645-117.715-77.645M256 106.667c-35.346 0-64 28.654-64 64s28.654 64 64 64s64-28.654 64-64s-28.653-64-64-64"></path>
                            </svg>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link title="Log Out" class="items-center gap-2 flex" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('LogOut') }} <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M3 21V3h9v2H5v14h7v2zm13-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"></path>
                                </svg>
                            </x-dropdown-link>
                        </form>
                    @endauth

            </div>


            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
           @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
   @endauth

            <div class="mt-3 space-y-1">
                @auth
                <x-dropdown-link title="Your Profile" class="items-center gap-2 flex " :href="route('profile.update')">
                   <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={512} height={512} viewBox="0 0 512 512">
                        <path fill="currentColor" fillRule="evenodd" d="M256 42.667A213.333 213.333 0 0 1 469.334 256c0 117.821-95.513 213.334-213.334 213.334c-117.82 0-213.333-95.513-213.333-213.334C42.667 138.18 138.18 42.667 256 42.667m21.334 234.667h-42.667c-52.815 0-98.158 31.987-117.715 77.648c30.944 43.391 81.692 71.685 139.048 71.685s108.104-28.294 139.049-71.688c-19.557-45.658-64.9-77.645-117.715-77.645M256 106.667c-35.346 0-64 28.654-64 64s28.654 64 64 64s64-28.654 64-64s-28.653-64-64-64"></path>
                    </svg> {{ __('Profile') }}
                </x-dropdown-link>


                <!-- Authentication -->

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link title="Log Out" class="items-center gap-2 flex" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                               <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M3 21V3h9v2H5v14h7v2zm13-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"></path>
                                </svg> {{ __('LogOut') }}
                            </x-dropdown-link>
                        </form>
                    @endauth

                <x-nav-link title="Home" :href="route('offre.create')" class="hover:bg-gray-100" :active="request()->routeIs('offre.create')" >
                     <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z"></path>
                    </svg>{{ __('Home') }}
                </x-nav-link>
            </div>
            <div>
                @if(Auth::check() && Auth::user()->isworkowner) @php $id=auth()->user()->id @endphp


                <div><a title="show condidates for your offers" class="hover:bg-black hover:text-white flex hover:scale-100" href={{route('offre.show',$id)}} ><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <circle cx="22" cy="24" r="2" fill="currentColor" />
                        <path fill="currentColor" d="M29.777 23.479A8.64 8.64 0 0 0 22 18a8.64 8.64 0 0 0-7.777 5.479L14 24l.223.522A8.64 8.64 0 0 0 22 30a8.64 8.64 0 0 0 7.777-5.478L30 24zM22 28a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4M7 17h5v2H7zm0-5h12v2H7zm0-5h12v2H7z" />
                        <path fill="currentColor" d="M22 2H4a2.006 2.006 0 0 0-2 2v24a2.006 2.006 0 0 0 2 2h8v-2H4V4h18v11h2V4a2.006 2.006 0 0 0-2-2" />
                    </svg> condidates for your offers</a></div>



                <div><a title="view your offers" class="hover:bg-black hover:text-white flex" href={{route('offre.youroffres',$id)}}>  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M39.546 13.97L19.17 6.553a1.606 1.606 0 0 0-2.058.96h0L7.497 33.928a1.606 1.606 0 0 0 .96 2.058q0 0 0 0l20.377 7.417a1.606 1.606 0 0 0 2.058-.96q0 0 0 0l9.614-26.415a1.606 1.606 0 0 0-.96-2.058q0 0 0 0m-3.194-1.163l.469-2.656a1.606 1.606 0 0 0-1.303-1.86h0L14.163 4.524a1.606 1.606 0 0 0-1.861 1.303h0L7.421 33.51c-.04.227-.03.46.027.682m4.737-27.71H9.003c-.887 0-1.607.72-1.607 1.607v28.109c0 .887.72 1.606 1.607 1.606h4.448M32.25 7.712a1.606 1.606 0 0 0-1.562-1.23h-5.424" />
                </svg>your  published   offers </a></div>
                @if (auth()->user()->role=='admin')
                <div>
                <a title="Managing Users" class="hover:bg-black hover:text-white items-center gap-2 flex " href="{{route('all-users')}}" > <svg class=  "h-7 w-7" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                    <circle cx={10} cy={8} r={2} fill="currentColor" opacity={0.3}></circle>
                    <path fill="currentColor" d="M10 16c0-.34.03-.67.08-.99c-.03-.01-.05-.01-.08-.01c-1.97 0-3.9.53-5.59 1.54c-.25.14-.41.46-.41.81V18h6.29c-.19-.63-.29-1.3-.29-2" opacity={0.3}></path>
                    <path fill="currentColor" d="M4 18v-.65c0-.34.16-.66.41-.81C6.1 15.53 8.03 15 10 15c.03 0 .05 0 .08.01c.1-.7.3-1.37.59-1.98c-.22-.02-.44-.03-.67-.03c-2.42 0-4.68.67-6.61 1.82c-.88.52-1.39 1.5-1.39 2.53V20h9.26c-.42-.6-.75-1.28-.97-2zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m0-6c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m10.83 6.63l-1.45.49q-.48-.405-1.08-.63L18 11h-2l-.3 1.49q-.6.225-1.08.63l-1.45-.49l-1 1.73l1.14 1c-.03.21-.06.41-.06.63s.03.42.06.63l-1.14 1l1 1.73l1.45-.49q.48.405 1.08.63L16 21h2l.3-1.49q.6-.225 1.08-.63l1.45.49l1-1.73l-1.14-1c.03-.21.06-.41.06-.63s-.03-.42-.06-.63l1.14-1zM17 18c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2"></path>
                </svg> Manage Users </a></div>
                        <div>

                          <a title="Managing Offers" class="hover:bg-black hover:text-white items-center gap-2 flex" href="{{route('offre.all')}}" class="hover:text-laravel"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={32} height={32} viewBox="0 0 32 32">
                            <path fill="currentColor" d="M16 21a5 5 0 1 1 0-10a5 5 0 0 1 0 10m0-8a3 3 0 1 0 0 6a3 3 0 0 0 0-6" className="ouiIcon__fillSecondary"></path>
                            <path fill="currentColor" d="M20 32h-8v-4.06a1 1 0 0 0-1.61-.67l-2.88 2.87l-5.65-5.65l2.87-2.87a.92.92 0 0 0 .2-1a.93.93 0 0 0-.86-.6H0V12h4.06a.92.92 0 0 0 .85-.58a.94.94 0 0 0-.19-1L1.86 7.51l5.65-5.65l2.87 2.87A1 1 0 0 0 12 4.06V0h8v4.06a1 1 0 0 0 1.61.67l2.87-2.87l5.66 5.66l-2.87 2.87a.92.92 0 0 0-.2 1a.93.93 0 0 0 .86.6H32v8h-4.06a.92.92 0 0 0-.85.58a.94.94 0 0 0 .19 1l2.87 2.87l-5.66 5.66l-2.87-2.87a1 1 0 0 0-1.61.67zm-6-2h4v-2.06a3 3 0 0 1 5-2.08l1.46 1.46l2.83-2.83L25.86 23a3 3 0 0 1 2.08-5H30v-4h-2.06a3 3 0 0 1-2.08-5l1.46-1.46l-2.83-2.85L23 6.14a3 3 0 0 1-5-2.08V2h-4v2.06a3 3 0 0 1-5 2.08L7.51 4.69L4.69 7.51L6.14 9a3 3 0 0 1-2.08 5H2v4h2.06a3 3 0 0 1 2.08 5l-1.45 1.49l2.83 2.83L9 25.86a3 3 0 0 1 5 2.08z"></path>
                        </svg> Manage Offers  </a>
                        </div>
                        <div>
                          <a  title="CS filter CVs and condidators"  class="hover:bg-black hover:text-white items-center gap-2 flex " href="{{route('cvs')}}" class="hover:text-laravel"><svg class="w-5 h-5 xmlns="http://www.w3.org/2000/svg" width={32} height={32} viewBox="0 0 32 32">
                            <path fill="currentColor" d="M15 20H9a3 3 0 0 0-3 3v2h2v-2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2h2v-2a3 3 0 0 0-3-3m-3-1a4 4 0 1 0-4-4a4 4 0 0 0 4 4m0-6a2 2 0 1 1-2 2a2 2 0 0 1 2-2"></path>
                            <path fill="currentColor" d="M28 19v9H4V8h12V6H4a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2v-9Z"></path>
                            <path fill="currentColor" d="M20 19h6v2h-6zm2 4h4v2h-4zm10-13V8h-2.101a5 5 0 0 0-.732-1.753l1.49-1.49l-1.414-1.414l-1.49 1.49A5 5 0 0 0 26 4.101V2h-2v2.101a5 5 0 0 0-1.753.732l-1.49-1.49l-1.414 1.414l1.49 1.49A5 5 0 0 0 20.101 8H18v2h2.101a5 5 0 0 0 .732 1.753l-1.49 1.49l1.414 1.414l1.49-1.49a5 5 0 0 0 1.753.732V16h2v-2.101a5 5 0 0 0 1.753-.732l1.49 1.49l1.414-1.414l-1.49-1.49A5 5 0 0 0 29.899 10zm-7 2a3 3 0 1 1 3-3a3.003 3.003 0 0 1-3 3"></path>
                        </svg>CVs Filter </a>
                        </div>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    @if(Auth::check() && Auth::user()->isworkowner) @php $id=auth()->user()->id @endphp

        <ul class="flex space-x-6 mr-6 text-lg">
            <div><a href="{{route('offre.show',$id)}}" title="show condidates for your offers" class="hover:bg-black hover:text-white flex hover:scale-100"  >condidates for your offers<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                <circle cx="22" cy="24" r="2" fill="currentColor" />
                <path fill="currentColor" d="M29.777 23.479A8.64 8.64 0 0 0 22 18a8.64 8.64 0 0 0-7.777 5.479L14 24l.223.522A8.64 8.64 0 0 0 22 30a8.64 8.64 0 0 0 7.777-5.478L30 24zM22 28a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4M7 17h5v2H7zm0-5h12v2H7zm0-5h12v2H7z" />
                <path fill="currentColor" d="M22 2H4a2.006 2.006 0 0 0-2 2v24a2.006 2.006 0 0 0 2 2h8v-2H4V4h18v11h2V4a2.006 2.006 0 0 0-2-2" />
            </svg></a></div>



        <div><a title="view your offers" class="hover:bg-black hover:text-white flex" href={{route('offre.youroffres',$id)}}> your  published   offers <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M39.546 13.97L19.17 6.553a1.606 1.606 0 0 0-2.058.96h0L7.497 33.928a1.606 1.606 0 0 0 .96 2.058q0 0 0 0l20.377 7.417a1.606 1.606 0 0 0 2.058-.96q0 0 0 0l9.614-26.415a1.606 1.606 0 0 0-.96-2.058q0 0 0 0m-3.194-1.163l.469-2.656a1.606 1.606 0 0 0-1.303-1.86h0L14.163 4.524a1.606 1.606 0 0 0-1.861 1.303h0L7.421 33.51c-.04.227-.03.46.027.682m4.737-27.71H9.003c-.887 0-1.607.72-1.607 1.607v28.109c0 .887.72 1.606 1.607 1.606h4.448M32.25 7.712a1.606 1.606 0 0 0-1.562-1.23h-5.424" />
        </svg> </a></div>
    </ul>
        @endif
        @if (Auth::check() && auth()->user()->role=='admin')
<div class="flex space-x-6 mr-6 text-lg">
        <div>
        <a title="Managing Users" class="hover:bg-black hover:text-white items-center gap-2 flex " href="{{route('all-users')}}" > Manage Users<svg class=  "h-7 w-7" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
            <circle cx={10} cy={8} r={2} fill="currentColor" opacity={0.3}></circle>
            <path fill="currentColor" d="M10 16c0-.34.03-.67.08-.99c-.03-.01-.05-.01-.08-.01c-1.97 0-3.9.53-5.59 1.54c-.25.14-.41.46-.41.81V18h6.29c-.19-.63-.29-1.3-.29-2" opacity={0.3}></path>
            <path fill="currentColor" d="M4 18v-.65c0-.34.16-.66.41-.81C6.1 15.53 8.03 15 10 15c.03 0 .05 0 .08.01c.1-.7.3-1.37.59-1.98c-.22-.02-.44-.03-.67-.03c-2.42 0-4.68.67-6.61 1.82c-.88.52-1.39 1.5-1.39 2.53V20h9.26c-.42-.6-.75-1.28-.97-2zm6-6c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m0-6c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m10.83 6.63l-1.45.49q-.48-.405-1.08-.63L18 11h-2l-.3 1.49q-.6.225-1.08.63l-1.45-.49l-1 1.73l1.14 1c-.03.21-.06.41-.06.63s.03.42.06.63l-1.14 1l1 1.73l1.45-.49q.48.405 1.08.63L16 21h2l.3-1.49q.6-.225 1.08-.63l1.45.49l1-1.73l-1.14-1c.03-.21.06-.41.06-.63s-.03-.42-.06-.63l1.14-1zM17 18c-1.1 0-2-.9-2-2s.9-2 2-2s2 .9 2 2s-.9 2-2 2"></path>
        </svg></a></div>
                <div>

                  <a title="Managing Offers" class="hover:bg-black hover:text-white items-center gap-2 flex" href="{{route('offre.all')}}" class="hover:text-laravel"> Manage Offers <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={32} height={32} viewBox="0 0 32 32">
                    <path fill="currentColor" d="M16 21a5 5 0 1 1 0-10a5 5 0 0 1 0 10m0-8a3 3 0 1 0 0 6a3 3 0 0 0 0-6" className="ouiIcon__fillSecondary"></path>
                    <path fill="currentColor" d="M20 32h-8v-4.06a1 1 0 0 0-1.61-.67l-2.88 2.87l-5.65-5.65l2.87-2.87a.92.92 0 0 0 .2-1a.93.93 0 0 0-.86-.6H0V12h4.06a.92.92 0 0 0 .85-.58a.94.94 0 0 0-.19-1L1.86 7.51l5.65-5.65l2.87 2.87A1 1 0 0 0 12 4.06V0h8v4.06a1 1 0 0 0 1.61.67l2.87-2.87l5.66 5.66l-2.87 2.87a.92.92 0 0 0-.2 1a.93.93 0 0 0 .86.6H32v8h-4.06a.92.92 0 0 0-.85.58a.94.94 0 0 0 .19 1l2.87 2.87l-5.66 5.66l-2.87-2.87a1 1 0 0 0-1.61.67zm-6-2h4v-2.06a3 3 0 0 1 5-2.08l1.46 1.46l2.83-2.83L25.86 23a3 3 0 0 1 2.08-5H30v-4h-2.06a3 3 0 0 1-2.08-5l1.46-1.46l-2.83-2.85L23 6.14a3 3 0 0 1-5-2.08V2h-4v2.06a3 3 0 0 1-5 2.08L7.51 4.69L4.69 7.51L6.14 9a3 3 0 0 1-2.08 5H2v4h2.06a3 3 0 0 1 2.08 5l-1.45 1.49l2.83 2.83L9 25.86a3 3 0 0 1 5 2.08z"></path>
                </svg> </a>
                </div>
                <div>
                  <a  title="CS filter CVs and condidators"  class="hover:bg-black hover:text-white items-center gap-2 flex " href="{{route('cvs')}}" class="hover:text-laravel">CVs Filter<svg class="w-5 h-5 xmlns="http://www.w3.org/2000/svg" width={32} height={32} viewBox="0 0 32 32">
                    <path fill="currentColor" d="M15 20H9a3 3 0 0 0-3 3v2h2v-2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2h2v-2a3 3 0 0 0-3-3m-3-1a4 4 0 1 0-4-4a4 4 0 0 0 4 4m0-6a2 2 0 1 1-2 2a2 2 0 0 1 2-2"></path>
                    <path fill="currentColor" d="M28 19v9H4V8h12V6H4a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2v-9Z"></path>
                    <path fill="currentColor" d="M20 19h6v2h-6zm2 4h4v2h-4zm10-13V8h-2.101a5 5 0 0 0-.732-1.753l1.49-1.49l-1.414-1.414l-1.49 1.49A5 5 0 0 0 26 4.101V2h-2v2.101a5 5 0 0 0-1.753.732l-1.49-1.49l-1.414 1.414l1.49 1.49A5 5 0 0 0 20.101 8H18v2h2.101a5 5 0 0 0 .732 1.753l-1.49 1.49l1.414 1.414l1.49-1.49a5 5 0 0 0 1.753.732V16h2v-2.101a5 5 0 0 0 1.753-.732l1.49 1.49l1.414-1.414l-1.49-1.49A5 5 0 0 0 29.899 10zm-7 2a3 3 0 1 1 3-3a3.003 3.003 0 0 1-3 3"></path>
                </svg> </a>
                </div>
            </div>

        @endif

        </div>

</nav>
