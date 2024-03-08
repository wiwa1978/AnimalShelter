
<div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="mx-auto w-full lg:mx-0 text-center">
      <h2 class="text-3xl font-bold tracking-tight text-rose-900 sm:text-4xl">
        Adopteer een huisdier
      </h2>

      <p class="mt-6 text-lg leading-8 text-gray-600">
        <input class="m-6 space-y-4 border border-dashed border-rose-900 rounded-lg rounded" wire:model.live="searchTerm" type="text" placeholder="Search">
      </p>
      <p>
   

        @foreach($animaltypess as $animaltype)
          <input wire:model="animaltypes.{{ $animaltype }}" type="checkbox" value="{{ $animaltype }}">
          <label for="{{ $animaltype }}">{{ $animaltype }}</label>
        @endforeach
      </p>
    </div>


    <h2 class="text-2xl font-bold text-rose-900">
        Huisdier in de kijker 
        
    </h2>
    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($animals_featured as $animal)
            @include('components.animals.animal-card', ['animal' => $animal])
        @endforeach 
    </ul>

    <h2 class="pt-12 text-2xl font-bold text-rose-900">
        Alle dieren
    </h2>

    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">

           @foreach($animals_not_featured as $animal)
                @include('components.animals.animal-card', ['animal' => $animal])
            @endforeach


    </ul>
    <div class="mt-6">
        
    </div>




  </div>
