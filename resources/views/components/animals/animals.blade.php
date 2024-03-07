
  <div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="mx-auto w-full lg:mx-0 text-center">


      <h2 class="text-3xl font-bold tracking-tight text-rose-900 sm:text-4xl">
         @if($animal_type == 'dog')
            {{ __('animals_front.adopt_dog')}}
         @endif
         @if($animal_type == 'cat')
            {{ __('animals_front.adopt_cat')}}
         @endif
         @if($animal_type == 'other')
            {{ __('animals_front.adopt_other')}}
         @endif

      </h2>


      <p class="mt-6 text-lg leading-8 text-gray-600"></p>
    </div>


    <h2 class="text-2xl font-bold text-rose-900">
         @if($animal_type == 'dog')
            {{ __('animals_front.featured_dogs')}}
         @endif
         @if($animal_type == 'cat')
            {{ __('animals_front.featured_cats')}}
         @endif
         @if($animal_type == 'other')
            {{ __('animals_front.featured_others')}}
         @endif
    </h2>
    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($animals_featured as $animal)
            @include('components.animals.animal-card', ['animal' => $animal])
        @endforeach
    </ul>

    <h2 class="mt-6 text-2xl font-bold text-rose-900">
         @if($animal_type == 'dog')
            {{ __('animals_front.all_dogs')}}
         @endif
         @if($animal_type == 'cat')
            {{ __('animals_front.all_cats')}}
         @endif
         @if($animal_type == 'other')
            {{ __('animals_front.all_others')}}
         @endif


    </h2>
    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($animals_not_featured as $animal)
            @include('components.animals.animal-card', ['animal' => $animal])
        @endforeach
    </ul>

  </div>
