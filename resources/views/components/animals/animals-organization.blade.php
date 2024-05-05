<div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="mb-16 mx-auto w-full lg:mx-0 text-center">
      

    @if ( $isAnimalBelongsToAsiel )
      <h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">
          Alle adoptiedieren van asiel {{ $organization->organization_name }}
      </h2>
    @endif
    @if ( $isAnimalBelongsToStichting )
      <h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">
          Alle adoptiedieren van stichting {{ $organization->organization_name }}
      </h2>
    @endif
    @if( $isAnimalBelongsToParticulier )
      <h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">
          Alle adoptiedieren van {{ $organization->name }}
      </h2>
    @endif

      <p class="mt-6 text-lg leading-8 text-gray-600"></p>
      <p class="mt-6 tracking-tight font-bold text-indigo-900 sm:text-xl">Er verblijven momenteel {{ $animals_count}} dieren bij deze organizatie</p>
    </div>


    @if ( $isAnimalBelongsToAsiel )
      <h2 class="text-2xl font-bold text-indigo-900">
          Alle adoptiedieren van asiel {{ $organization->organization_name }}
      </h2>
    @endif
    @if ( $isAnimalBelongsToStichting )
      <h2 class="text-2xl font-bold text-indigo-900">
          Alle adoptiedieren van stichting {{ $organization->organization_name }}
      </h2>
    @endif
    @if( $isAnimalBelongsToParticulier )
      <h2 class="text-2xl font-bold text-indigo-900">
          Alle adoptiedieren van {{ $organization->name }}
      </h2>
    @endif

   

    
    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($animals as $animal)
            @include('components.animals.animal-card', ['animal' => $animal])
        @endforeach
    </ul>








  </div>
