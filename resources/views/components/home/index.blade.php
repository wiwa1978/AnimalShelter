
  <div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="mx-auto w-full lg:mx-0 text-center">
      <h2 class="text-3xl font-bold tracking-tight text-gray-500 sm:text-4xl">The Animals</h2>
      <p class="mt-6 text-lg leading-8 text-gray-600">We’re a dynamic group of individuals who are passionate about what we do and dedicated to delivering the best results for our clients.</p>
    </div>


    <h2 class="text-2xl font-bold text-gray-900">Featured animals</h2>
    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($animals_featured as $animal)
            @include('components.home.card-animal', ['animal' => $animal])
        @endforeach
    </ul>

    <h2 class="mt-6 text-2xl font-bold text-gray-900">All animals</h2>
    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($animals_not_featured as $animal)
            @include('components.home.card-animal', ['animal' => $animal])
        @endforeach
    </ul>

  </div>
