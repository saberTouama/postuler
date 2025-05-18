
<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title id="title">{{config('app.name', 'Laravel2')}}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
          img:hover {
              transform: scale(1.2);
          }      </style>
        <link rel="icon" href="{{ asset('images/logo.jpeg') }}" />
        <!-- Scripts -->
        <script src="{{ asset('js/app.jsx') }}"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script src="//unpkg.com/alpinejs" defer></script>
        @viteReactRefresh @php $page=["one"=>1]; @endphp
        @inertiaHead
        @viteReactRefresh
        @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body class="font-sans antialiased dark:bg-slate-800 ">

        @inertia

        <div id="page" class="min-h-screen  dark:bg-slate-800  " >
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-violet-100 h-96 " >
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="padding-bottom: 400px">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <div id="image-container" class="relative w-full h-[300px] overflow-hidden">
           {{--  <div id="images"  style="background-image: url('{{ asset('images/future.png') }}');" class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out rounded-xl" >
            </div>--}}
           <div class="relative  p-5 ">
                <nav class="flex justify-between items-center mb-4">
              <a title="go back" href="#"  onclick="window.history.back(); return false;" class="  hover:text-black hover:bg-blue-400 w-20  bg-black text-white py-2 px-5 rounded-full "><svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                <path fill="currentColor" d="M2048 1088H250l787 787l-90 90L6 1024L947 83l90 90l-787 787h1798z"></path>
              </svg>
              </a>
              <div class="flex justify-between h-16">

              <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                <li >
                  <div class="flex items-center  gap-2">
                  <span class="font-bold uppercase  text-gray-500 items-center flex">

                   <svg class="w-10 h-10 " xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22.62 3.783c-1.115-1.811-4.355-2.604-6.713-.265c-.132.135-.306.548.218 1.104c1.097 1.149 6.819 7.046 4.702 12.196c-1.028 2.504-3.953 2.073-5.052-2.076a23.2 23.2 0 0 1-.473-9.367s.105-.394-.065-.52c-.117-.087-.305-.05-.547.33c-.06.096-.048.076-.106.178l-.003.002c-1.622 2.688-3.272 5.874-4.049 7.07c.38-1.803-.101-4.283-.85-6.359l-.142-.375c-.692-1.776-1.524-2.974-1.776-3.245c-.03-.033-.105-.094-.353-.094H.398c-.49 0-.448.412-.293.561c1.862 2.178 7.289 10.343 4.773 18.355c-.194.619.11.944.612.305c2.206-2.81 4.942-7.598 6.925-11.187c-.437 1.245-.822 2.63-1.028 4.083c-.435 3.064.487 5.37 1.162 6.58c.345.619.803.998 1.988.824c6.045-.885 8.06-6.117 8.805-8.77c1.357-4.839.363-7.568-.722-9.33"></path>
                  </svg>elcome {{auth()->user()->name}}  </span> </div>
                </li>


                @endauth
                @guest
                <li>
                    <div  x-data="{ open: false}" >
                  <button  x-on:click.prevent="$dispatch('open-modal', 'register')" title="create new account" class="hover:bg-blue-400 bg-black hover:text-black text-white py-2 px-5 rounded-full flex items-center gap-2"><x-register></x-register> Register </button>

                </div>
                </li>
                <li>
                  <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'login')" href="/login" title="sign in" class="hover:bg-blue-400 bg-black hover:text-black text-white py-2 px-5 rounded-full flex items-center gap-2">
                    <i class="fa-solid fa-arrow-right-to-bracket">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 21v-2h7V5h-7V3h7q.825 0 1.413.588T21 5v14q0 .825-.587 1.413T19 21zm-2-4l-1.375-1.45l2.55-2.55H3v-2h8.175l-2.55-2.55L10 7l5 5z"></path>
                        </svg>
                    </i>
                    Login
                </button>
                </li>
               @endguest
              </ul>
            </nav>
 {{--@section('filter')
 @endsection
 @yield('filter')--}}
</div>
            </div>
            <script src="{{ asset('js/images.js') }}"></script>


            <!-- Page Content -->
            <main>
                {{$slot}}
            </main>



                @section('users')




            </div>


            <div class="flex gap-20 w-screen  ">

               @auth
              @php $id=auth()->user()->id // href="{{route('notify',$id)}}   (auth()->user()->notified==false) "
               @endphp
              @if(auth()->user()->notified==false)
                <div x-data="{ showAccept: true }"> <button  x-show="showAccept"  @click="showAccept = false" title="accept email notifications" id="notify" class="hover:bg-green-400 hover:text-white flex items-center gap-2">Accept Notification <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24">
                  <g fill="none">
                    <path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                    <path fill="currentColor" d="M12 2a7 7 0 0 0-7 7v3.528a1 1 0 0 1-.105.447l-1.717 3.433A1.1 1.1 0 0 0 4.162 18h15.676a1.1 1.1 0 0 0 .984-1.592l-1.716-3.433a1 1 0 0 1-.106-.447V9a7 7 0 0 0-7-7m0 19a3 3 0 0 1-2.83-2h5.66A3 3 0 0 1 12 21" />
                  </g>
                </svg></button>
                <button  x-show="!showAccept"  @click="showAccept = true" title="disable email notifications" id="unnotify" class="hover:bg-green-400 text-red-600  hover:text-white flex items-center gap-2 "   >
                  Disable Notifications
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none">
                      <path d="M0 0h24v24H0z" />
                      <path fill="currentColor" d="M14.83 19a3.001 3.001 0 0 1-5.66 0zM12 2a7 7 0 0 1 7 7v3.528a1 1 0 0 0 .106.447l1.716 3.433A1.1 1.1 0 0 1 19.838 18h-.424l1.071 1.071a1 1 0 0 1-1.414 1.414L3.515 4.93a1 1 0 1 1 1.414-1.414l1.392 1.392A6.99 6.99 0 0 1 12.001 2M5.023 8.427L14.596 18H4.162a1.1 1.1 0 0 1-.984-1.592l1.717-3.433A1 1 0 0 0 5 12.528V9q0-.29.023-.573" />
                    </g>
                  </svg>


                </button> </div> @else
                <button  x-show="!showAccept"  @click="showAccept = true" title="disable email notifications" id="unnotify" class="hover:bg-green-400 text-red-600  hover:text-white flex items-center gap-2 "   >
                    Disable Notifications
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <g fill="none">
                        <path d="M0 0h24v24H0z" />
                        <path fill="currentColor" d="M14.83 19a3.001 3.001 0 0 1-5.66 0zM12 2a7 7 0 0 1 7 7v3.528a1 1 0 0 0 .106.447l1.716 3.433A1.1 1.1 0 0 1 19.838 18h-.424l1.071 1.071a1 1 0 0 1-1.414 1.414L3.515 4.93a1 1 0 1 1 1.414-1.414l1.392 1.392A6.99 6.99 0 0 1 12.001 2M5.023 8.427L14.596 18H4.162a1.1 1.1 0 0 1-.984-1.592l1.717-3.433A1 1 0 0 0 5 12.528V9q0-.29.023-.573" />
                      </g>
                    </svg>


                  </button>

                 @endif

              @endauth
                <p class="ml-20 text-gray-400 rounded-full">If you want become notified about any offer<br> @auth 👈accept notifications 🔔 <br>or @endauth  send us your email 💌 👉</p><br><br>

              <div class="relative w-full max-w-2xl mx-4 rounded-lg shadow-lg my-md mt-xxl"  >

                <form  method="get" class="right-10 my-5 h-10 autofill autocomplete  relative   border border-transparent bg-clip-border rounded-md w-full before:absolute before:-inset-0.5 before:-z-10 before:rounded-[inherit] after:absolute after:-inset-px after:-z-20 after:rounded-[inherit] after:blur-sm mx-auto before:bg-input-gradient after:bg-input-gradient  max-w-[464px] bg-black"  action="{{route('mailing')}}">

                    <input class=" button-1/3 top-1/3 remove-autocomplete-styles h-full w-full appearance-none whitespace-nowrap rounded border-none bg-transparent pl-5 text-lg !leading-none text-white bg-slate-300  placeholder-white outline-none sm:pr-24 sm:text-base pr-32" name="not_email" type="email" placeholder="Your email..." autocomplete="not_email" value="" required><button class="hover:bg-green-400 inline-flex items-center justify-center text-center whitespace-nowrap rounded outline-none transition-[colors, opacity] duration-200 uppercase font-medium !leading-none h-8 px-5 text-xs bg-white text-black hover:bg-gray-10 absolute top-1/2 -translate-y-1/2 right-3" name="subscribe" type="submit"><span class="relative z-30 inline-flex items-center justify-center"><span class="sm:sr-only text-xs" style="opacity: 1; will-change: opacity;">Subscribe</span><span class="hidden sm:block" style="opacity: 1; will-change: opacity;"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="ml-1.5 h-6" aria-hidden="true"><path fill="#000" d="M23.576 11.999a1.5 1.5 0 0 0-.858-1.354L2.566 1.099A1.498 1.498 0 0 0 .502 2.927l2.433 7.295L13.59 12 2.933 13.776.5 21.07a1.5 1.5 0 0 0 .363 1.535l.067.062a1.5 1.5 0 0 0 1.638.233l20.152-9.545c.522-.249.856-.778.856-1.357"></path></svg></span></span></button> <x-input-error :messages="$errors->get('not_email')" class="mt-2" /> </form> </div> </div>
            </div>
            <a href="#page" class=" fixed top-1/2 h-5 w-5 bg-white  right-10 hover:bg-green-300 hover:text-black " id="btn-scrollup" style="display: inline;"><svg  class=" h-5 w-5" xmlns="http://www.w3.org/2000/svg"viewBox="0 0 512 512">
              <path fill="currentColor" d="M256 63.6L0 319.6l69.8 69.8L256 203.2l186.2 186.2l69.8-69.8z"></path>
            </svg></a>
            <div class="flex">


                <div>

             <a href="/about" class="absolute  left-5 hover:bg-green-400   hover:text-black bg-black text-white py-2 px-5 rounded-full" >Abou Us</a>
             <br><br><br>

         </div>
           <div>
        <a title="post job offer" href="{{route('publish')}}" class="absolute  hover:bg-green-400 bg-black hover:text-black text-white py-2 px-5  right-10 rounded-full flex items-center gap-2"> <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width={24} height={24} viewBox="0 0 24 24">
         <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8q.425 0 .713.288T14 4t-.288.713T13 5H5v14h14v-8q0-.425.288-.712T20 10t.713.288T21 11v8q0 .825-.587 1.413T19 21zm4-4q-.425 0-.712-.288T8 16t.288-.712T9 15h6q.425 0 .713.288T16 16t-.288.713T15 17zm0-3q-.425 0-.712-.288T8 13t.288-.712T9 12h6q.425 0 .713.288T16 13t-.288.713T15 14zm0-3q-.425 0-.712-.288T8 10t.288-.712T9 9h6q.425 0 .713.288T16 10t-.288.713T15 11zm9-2q-.425 0-.712-.288T17 8V7h-1q-.425 0-.712-.288T15 6t.288-.712T16 5h1V4q0-.425.288-.712T18 3t.713.288T19 4v1h1q.425 0 .713.288T21 6t-.288.713T20 7h-1v1q0 .425-.288.713T18 9"></path>
       </svg>Post Job</a></div>
             @if(Auth::check() && Auth::user()->isworkowner==false)
             <script>
   $("#publish").click(function(){
     alert("You are not allowed to post a job offer");
   });


       </script>
             @endif
            @endsection
            @yield('users')

        </div>
            <footer class=" bottom-0 left-0 w-full flex items-center justify-start font-bold bg-blue-400 text-white h-24 mt-24 opacity-90 md:justify-center">



           <p class="text-black">Copyright &copy; 2025, All Rights reserved</p>
           <a href="#page" class="w-10 bg-black absolute rounded-2xl right-10 hover:bg-green-300 hover:text-black " id="btn-scrollup" style="display: inline;"><svg xmlns="http://www.w3.org/2000/svg" width={512} height={512} viewBox="0 0 512 512">
            <path fill="currentColor" d="M256 63.6L0 319.6l69.8 69.8L256 203.2l186.2 186.2l69.8-69.8z"></path>
          </svg></a>
              <footer>






        <script>



            @auth
             $('#notify').click(function() {
               fetch('notify/{{$id}}');

  window.alert('you are notified about offers');


             });

             $('#unnotify').click(function() {
                    fetch('unnotify/{{$id}}');


                  });
                   @endauth
      </script>
      @guest
      <div >
      <x-modal x-data="  "

      name="login"
      :show="$errors->get('email') || $errors->get('password')">
      @include('auth.login')
      </x-modal>
      </div>
      <x-modal x-data="" name="register"   :show="$errors->get('Remail') || $errors->get('Rpassword')"> >
@include('auth.register')
          {{--<x-guest-layout>
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
          </x-guest-layout>--}}
      </x-modal>
      @endguest


      @livewireScripts
    </body>
</html>

