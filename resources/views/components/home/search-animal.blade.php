
<div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="mx-auto w-full lg:mx-0 text-center">
      <h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">
        {{__('animals_front.search_title')}}
      </h2>

      <p class="mt-6 tracking-tight font-bold text-indigo-900 sm:text-xl">{{ $animals_count}} {{__('animals_front.search_subtitle')}}</p>

      <div class="mt-6 bg-white sm:rounded-lg" style="display: flex; justify-content: center; align-items: center; ">
        <div class="px-4 py-5 sm:p-6">
          <h3 class="text-base font-semibold leading-6 text-gray-900">{{__('animals_front.search_animal')}}</h3>
          <div class="mt-6 max-w-xl text-sm text-gray-500">
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
              <input class="space-y-4 border border-dashed border-rose-900 rounded-lg rounded" wire:model.live="searchTerm" type="text" placeholder="Zoek op naam">
              <div>
                <select wire:model.live="searchAnimalType" class="ml-2 inline-flex space-y-4 border border-dashed border-rose-900 rounded-lg rounded "> 
                  <option value="None">{{__('animals_front.animal_type')}}</option>
                    @foreach($animaltypes as $id => $animaltype)
                      <option value="{{ $animaltype  }}"> {{ $animaltype }}</option>
                      <p>{{ $animaltype  }}</p>
                    @endforeach
                </select>
              </div>
              <div>
                  <select wire:model.live="searchAnimalLocation" class="ml-2 inline-flex space-y-4 border border-dashed border-rose-900 rounded-lg rounded"> 
                      <option value="None">{{__('animals_front.animal_location')}}</option>
                          @foreach($animallocations as $id => $location)
                              <option value="{{ $location  }}"> {{ $location }} </option>
                          @endforeach
                    </select>
              </div>
              <div>
                  <select wire:model.live="searchAnimalAge" class="ml-2 inline-flex space-y-4 border border-dashed border-rose-900 rounded-lg rounded"> 
                      <option value="None">{{__('animals_front.animal_age')}}</option>
                        @if ( Config::get('app.locale') === 'nl')
                          @foreach($animalages as $id => $age)
                              <option value="{{ $age  }}"> {{ $age . ' jaar' }} </option>
                          @endforeach
                        @else
                          @foreach($animalages as $id => $age)
                              <option value="{{ $age  }}"> {{ $age . ' years' }} </option>
                          @endforeach
                        @endif
                    </select>
              </div>
              <div>
                  <select wire:model.live="searchAnimalGender" class="ml-2 inline-flex space-y-4 border border-dashed border-rose-900 rounded-lg rounded"> 
                      <option value="None">{{__('animals_front.animal_gender')}}</option>
                          @foreach($animalgenders as $id => $gender)
                              <option value="{{ $gender  }}"> {{ $gender }} </option>
                          @endforeach
                    </select>
              </div>
              <div>
                  <select wire:model.live="searchAnimalOwner" class="ml-2 inline-flex space-y-4 border border-dashed border-rose-900 rounded-lg rounded"> 
                   <option value="None">{{__('animals_front.animal_owner')}}</option>
                          @foreach($animalowners as $id => $owner)
                              <option value="{{ $owner }}"> {{ $owner }} </option>
                          @endforeach
                    </select>
              </div>
              <div>
              <button type="button" wire:click="resetFilter" class="ml-2 inline-flex bg-rose-700 text-white rounded-md px-3 py-2 text-xl font-medium hover:bg-indigo-900 hover:text-white">Reset</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <h2 class="pt-12 text-2xl font-bold text-indigo-900">
    {{__('animals_front.all_animals')}} <span wire:model.live="animals_count"=>({{ $animals_count}})</span> 
    </h2>

    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">

           @foreach($animals_all as $animal)
              
                @include('components.animals.animal-card', ['animal' => $animal])
            @endforeach


    </ul>
    {{--
    <div class="mt-10 ">
      {{ $animals_all->links() }}
    </div>
      --}}



  </div>
