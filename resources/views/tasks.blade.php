<x-layout>
    @foreach ($tasks as $task)
        <div>{{ $task }}</div>
    @endforeach
</x-layout>
 
<x-layout>
    <x-slot:title>
        Custom Title
    </x-slot>
 
    @foreach ($tasks as $task)
        <div>{{ $task }}</div>
    @endforeach
</x-layout>