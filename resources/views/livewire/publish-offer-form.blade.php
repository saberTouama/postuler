

<div>
    <h1>HELLO</h1>
    @if (session()->has('success'))
    <div class="bg-green-500 text-white p-2 mb-4">
        {{ session('success') }}
    </div>
    
        
    @else
       <h1>not seccess</h1> 
    
@endif
    <form wire:submit.prevent="submit">
        <div>
            <label for="titre">Title</label>
            <input type="text" id="titre" wire:model="titre">
            @error('titre') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="company">Company</label>
            <input type="text" id="company" wire:model="company">
            @error('company') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="lieu">Location</label>
            <input type="text" id="lieu" wire:model="lieu">
            @error('lieu') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Publish</button>
    </form>
</div>
