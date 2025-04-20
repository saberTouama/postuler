<div>


@vite(['resources/css/app.css'])
<div class="relative">
<button onclick="toggleDropdown()" class="relative">
    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V9a6 6 0 10-12 0v5c0 .386-.149.755-.405 1.041L4 17h5m6 0a3 3 0 11-6 0"></path>
    </svg>
    @if(Auth::user()->unreadNotifications->count() > 0)
        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-600 rounded-full">
            {{Auth::user()->unreadNotifications->count()}}
        </span>
    @endif
</button>

<div id="notifications-dropdown" class="hidden absolute z-50 right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg " >
    @foreach(Auth::user()->unreadNotifications as $notification)

        <div class="p-2 border-b border-gray-200">
            <p>{{ $notification->data['message'] }}</p>
           <form method="GET" action="{{route('notifications.markAsRead',$notification->id)}}" >
                @csrf
                <button id="{{$notification->id}}"  type="submit" class="text-sm text-blue-500">Mark as read</button>
            </form>
        </div>
        <script>
             document.getElementById('{{$notification->id}}').addEventListener('click',function(){

        fetch('{{route('notifications.markAsRead',$notification->id)}}');
       });
        </script>
               @endforeach
</div>
</div>

<script>
function toggleDropdown() {
    document.getElementById('notifications-dropdown').classList.toggle('hidden');
}
</script>


</div>
