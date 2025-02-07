<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/js/app.js')
  <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>

  <script>
    tailwind.config = {
        theme: {
          extend: {
            colors: {
              laravel: '#ef3b2d',
            },
          },
        },
      }

  </script>
  <style> table{
    border-spacing: 0.5rem 0.5rem;
    table-layout: auto;
   background-color: #5c21218a;
    border-collapse: separate;
    border-spacing: 0.875rem 0.875rem;
  }
    </style>
  <title>Postuler.dz</title>
</head>


  <body class="mb-48">

    @use ('Illuminate\Support\Facades\DB')
    @use ('Illuminate\Support\Facades\Auth')
    @use ('Illuminate\Support\Facades\Mail')
   
    <nav class="flex justify-between items-center mb-4">
      <div class="flex justify-between h-16">
        
      <ul class="flex space-x-6 mr-6 text-lg">
        @auth
        <li>
          <span class="font-bold uppercase">
            Welcome {{auth()->user()->name}}
          </span>
        </li>
        @if (auth()->user()->role=='admin')
        <li>
          <a href="{{route('offre.all')}}" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Listings</a>
        </li>
        <li>
          <a href="{{route('cvs')}}" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> CVS Filter</a>
        </li>
        @endif
        <li>
          <form class="inline" method="POST" action="{{route('logout')}}">
            @csrf
            <button type="submit">
              <i class="fa-solid fa-door-closed"></i> Logout
            </button>
          </form>
        </li>
        <li>

         @php $id=auth()->user()->id @endphp
         @if(auth()->user()->notified==false)
          <a href="{{route('notify',$id)}}" class="hover:text-laravel"><i class="fa-solid fa-gear"></i>Accept Notification</a>
          @endif
        </li>
        @endauth
        @guest
        <li>
          <a href="{{route('register')}}" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
        </li>
        <li>
          <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
        </li>
       @endguest
      </ul>
    </nav>
  
    <main>
      {{$slot}}
    </main>
    
    <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-green-400 text-white h-24 mt-24 opacity-90 md:justify-center">
      <ul>
        <table>
        
    <th> <li> <a href="/about" class="absolute top-1/3 left-5  bg-black text-white py-2 px-5 rounded-full" >Abou Us</a></li></th>
    <br><br><br>
    <th>

      
    <li><p>Copyright &copy; 2025, All Rights reserved</p></li></th>
  
    <th><li> <a href="{{route('publish')}}" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5 rounded-full">Post Job</a></li></th>
          
        </table>
  </ul>
    
  <form class="right-10  autocomplete relative border border-transparent bg-clip-border rounded-md w-full before:absolute before:-inset-0.5 before:-z-10 before:rounded-[inherit] after:absolute after:-inset-px after:-z-20 after:rounded-[inherit] after:blur-sm mx-auto before:bg-input-gradient after:bg-input-gradient  max-w-[464px] bg-black"  method="POST" action="{{route('mailing')}}"><input class=" button-1/3 top-1/3 remove-autocomplete-styles h-full w-full appearance-none whitespace-nowrap rounded border-none bg-transparent pl-5 text-lg !leading-none text-white placeholder-white outline-none sm:pr-24 sm:text-base pr-32" name="email" type="email" placeholder="Your email..." autocomplete="email" value=""><button class="inline-flex items-center justify-center text-center whitespace-nowrap rounded outline-none transition-[colors, opacity] duration-200 uppercase font-medium !leading-none h-10 px-5 text-xs bg-white text-black hover:bg-gray-10 absolute top-1/2 -translate-y-1/2 right-3" name="subscribe" type="submit"><span class="relative z-30 inline-flex items-center justify-center"><span class="sm:sr-only text-xs" style="opacity: 1; will-change: opacity;">Subscribe</span><span class="hidden sm:block" style="opacity: 1; will-change: opacity;"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="ml-1.5 h-6" aria-hidden="true"><path fill="#000" d="M23.576 11.999a1.5 1.5 0 0 0-.858-1.354L2.566 1.099A1.498 1.498 0 0 0 .502 2.927l2.433 7.295L13.59 12 2.933 13.776.5 21.07a1.5 1.5 0 0 0 .363 1.535l.067.062a1.5 1.5 0 0 0 1.638.233l20.152-9.545c.522-.249.856-.778.856-1.357"></path></svg></span></span></button></form>

    </footer>
  
    
</body>

</html>