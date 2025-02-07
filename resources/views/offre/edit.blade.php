

    <x-app-layout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-800">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
    <?php $id=auth()->user()->id;?>
   
        <form method="post" class="mr-20 ml-20 bg-gray-500 sm:rounded-lg" action="{{ route('offre.update', $offre) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="lg:grid lg:grid-cols-2 flex justify-between gap-10">
                <div>
            <div>
                <x-input-label for="titre" :value="__('titre')" />
                <x-text-input id="titre" class="block mt-1 w-full" type="text" name="titre" value="{{ $offre->titre }}" autofocus autocomplete="titre" />
            </div>
            <div> <select name="category" class="block rounded-3xl hover:bg-white  mt-1 l bg-green-300"  >
                
                <option  class="text-gray-400" ><p>{{__('Select  Category')}}</p></option>
                @foreach($catigories as $catigory)
                    <option class="text-gray-400 " value={{$catigory->id}}> {{$catigory->name}}</option>
                    @endforeach
                </select> </div>
            <div>
                <x-input-label for="company" :value="__('company')" />
                <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" value="{{ $offre->company }}" autofocus autocomplete="company" />
            </div>
        
            <div>
                <div> <select name="lieu" class="block rounded-3xl hover:bg-white  mt-1 l bg-green-300"  >
                    
                    <option  disabled selected  class="text-gray-400" ><p>{{__('Select  Region')}}</p></option>
                   
                        <option class="text-gray-400 " value="Alger">Alger </option>
                        <option class="text-gray-400 " value="Boumerdes"> Boumerdes</option>
                        <option class="text-gray-400 " value="Annaba"> Annaba</option>
                        <option class="text-gray-400 " value="Oran">oran </option>
                        <option class="text-gray-400 " value="Bejaia">Bejaia </option>
                        <option class="text-gray-400 " value="Setif"> Stef</option>
                        <option class="text-gray-400 " value="Tizi Ouzou">Tizi Ouzou </option>
                      
                    </select> </div>
                    <x-input-error :messages="$errors->get('lieu')" class="mt-2" />
                    </div>
               
            <div>
                <x-input-label for="nb_post" :value="__('nb_post')" />
                <x-text-input id="nb_post" class="block mt-1 w-full" type="number" name="nb_post" value="{{ $offre->nb_post }}" autofocus autocomplete="nb_post" />
            </div>
            <div>
                <x-input-label for="site" :value="__('site')" />
                <x-text-input id="site" class="block mt-1 w-full" type="url" name="site" value="{{ $offre->site }}" autofocus autocomplete="site" />
            </div>
                </div>
                <div>
    
            <label>Recommended Skills</label>
            <textarea name="skills" class="block w-full border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm border-0 border-b-2  hover:bg-gray-400 bg-transparent">{{$offre->skills ??''}}</textarea>
        
            <label>Responsibilities</label>
            <textarea name="works" class="block w-full border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm border-0 border-b-2  hover:bg-gray-400 bg-transparent" >
                {{$offre->works ??''}}
            </textarea>
            <label>Important Notes</label>
            <textarea name="points" class="block w-full border-gray-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm border-0 border-b-2  hover:bg-gray-400 bg-transparent">{{ $offre->points ?? '' }}</textarea>
      
           
        
            <div>
                <x-input-label for="image" :value="__('image')" />
                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" autofocus autocomplete="image" />
            </div>
        
            <div>
                <x-input-label for="tool1" :value="__('tool1')" />
                <x-text-input id="tool1" class="block mt-1 w-full" type="text" name="tool1" value="{{ $offre->tool1 ?? '' }}" autofocus autocomplete="tool1" />
            </div>
        
            <div>
                <x-input-label for="tool2" :value="__('tool2')" />
                <x-text-input id="tool2" class="block mt-1 w-full" type="text" name="tool2" value="{{ $offre->tool2 ?? '' }}" autofocus autocomplete="tool2" />
            </div>
        
            <div>
                <x-input-label for="tool3" :value="__('tool3')" />
                <x-text-input id="tools3" class="block mt-1 w-full" type="text" name="tools3" value="{{ $offre->tool3 ?? '' }}" autofocus autocomplete="tool3" />
            </div>
            <div class="lg:grid lg:grid-cols-3">
                @foreach ($tools as $tool)
                  <div class="flex items-center">
                    <input type="checkbox" name="tools[]" id="tool-{{ $tool->id }}" value="{{ $tool->path }}" class="mr-2">
                    <label for="tool-{{ $tool->id }}">{{ $tool->name }}</label>
                  </div>
                @endforeach
              </div>
        
            <x-primary-button class="mt-4">{{ __('UPDATE') }}</x-primary-button>
        </div>
            </div>
        </form>
        </div>
        <br><br><br><br>

</x-app-layout>
