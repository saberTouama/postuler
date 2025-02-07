@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-transparent hover:bg-gray-400 border-gray-300 focus:border-indigo-500  rounded-md shadow-sm w-full border-0 border-b-2  focus:ring-0']) !!}>
