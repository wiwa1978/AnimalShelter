<div>
<div class="relative w-full">
    <img src="{{ asset('storage/images/dog4a.jpg') }}" alt="App screenshot" class="w-full h-auto object-cover object-bottom">
    <div class="absolute bottom-6 left-0 w-full h-3/4 flex items-center justify-center p-6 text-center z-10">
        <div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-bold tracking-tight text-white">{{ __('animals_front.title') }}</h1>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-bold tracking-tight text-rose-700">{{ __('animals_front.subtitle') }}</h1>
        </div>
    </div>
    <div class="text-center absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 flex justify-between space-x-4 px-6 w-full z-20">
          
<a href="{{ route('show-dogs') }}" class="mt-16 sm:mt-0 w-full lg:w-1/3 h-auto lg:h-36 bg-white p-4 rounded shadow">
    <!-- Information card 1 -->
    <h2 class="inline-block font-bold text-rose-700 ">{{ __('animals_front.view_all_dogs') }}</h2>
    <p class="mt-6 text-sm hidden sm:block inline-block" >{{ $dogs_count }} {{ __('animals_front.dogs_waiting') }}</p>
</a>

<a href="{{ route('show-cats') }}" class="mt-16 sm:mt-0 w-full lg:w-1/3 h-auto lg:h-36 bg-white p-4 rounded shadow">
    <!-- Information card 2 -->
    <h2 class="font-bold text-rose-700">{{ __('animals_front.view_all_cats') }}</h2>
    <p class="mt-6 text-sm hidden sm:block inline-block">{{ __('animals_front.also') }} {{ $cats_count }} {{ __('animals_front.cats_waiting') }}</p>
</a>

<a href="{{ route('show-others') }}" class="mt-16 sm:mt-0 w-full lg:w-1/3 h-auto lg:h-36 bg-white p-4 rounded shadow">
    <!-- Information card 3 -->
    <h2 class="font-bold text-rose-700">{{ __('animals_front.view_all_other') }}</h2>
    <p class="mt-6 text-sm hidden sm:block inline-block">{{ $others_count }} {{ __('animals_front.others_waiting') }}  </p>
</a>

    </div>
</div>
    <div class="mx-auto w-full mt-24 px-6 lg:px-8">
    
      <h2 class="text-2xl font-bold text-rose-700">
      {{ __('animals_front.featured_dogs') }} ({{ $dogs_featured_count}})
          
      </h2>
      <ul role="list" class="mx-auto mt-6 mb-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
          @foreach($dogs_featured as $animal)
              @include('components.animals.animal-card', ['animal' => $animal])
          @endforeach 
      </ul>

      <a href="{{ route('show-featured-dogs') }}" class="ml-6 text-indigo-900 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
          </svg>
          <h1 class="text-indigo-900 font-bold">{{ __('animals_front.view_all_featured_dogs') }}</h1>
      </a>

    </div>


    <div class="mx-auto w-full mt-16 px-6 lg:px-8">
    
    <h2 class="text-2xl font-bold text-rose-700">
        {{ __('animals_front.featured_cats') }} ({{ $cats_featured_count}})
    </h2>
    <ul role="list" class="mx-auto mt-6 mb-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($cats_featured as $animal)
            @include('components.animals.animal-card', ['animal' => $animal])
        @endforeach 
    </ul>

    <a href="{{ route('show-featured-cats') }}" class="ml-6 text-indigo-900 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
          </svg>
          <h1 class="text-indigo-900 font-bold">{{ __('animals_front.view_all_featured_cats') }}</h1>
      </a>
    
  </div>

  <div class="mx-auto w-full mt-16 mb-16 px-6 lg:px-8">
    
    <h2 class="text-2xl font-bold text-rose-700">
    {{ __('animals_front.featured_others') }} ({{ $others_featured_count}})
        
    </h2>
    <ul role="list" class="mx-auto mt-6 mb-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($others_featured as $animal)
            @include('components.animals.animal-card', ['animal' => $animal])
        @endforeach 
    </ul>

    <a href="{{ route('show-featured-others') }}" class="ml-6 text-indigo-900 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
          </svg>
          <h1 class="text-indigo-900 font-bold">{{ __('animals_front.view_all_featured_others') }}</h1>
      </a>
    
  </div>


</div>
</div>