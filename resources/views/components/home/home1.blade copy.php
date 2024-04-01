<div>
<div class="relative w-full">
    <img src="{{ asset('storage/images/dog4a.jpg') }}" alt="App screenshot" class="w-full h-auto object-cover object-bottom">
    <div class="absolute bottom-6 left-0 w-full h-3/4 flex items-center justify-center p-6 text-center z-10">
        <div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-bold tracking-tight text-white">Zorg voor een nieuw begin</h1>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-bold tracking-tight text-rose-700">Adopteer een huisdier</h1>
        </div>
    </div>
    <div class="text-center absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 flex justify-between space-x-4 px-6 w-full z-0">
        <a href="#" class="w-full lg:w-1/3 h-auto lg:h-36 bg-white p-4 rounded shadow">
            <!-- Information card 1 -->
            <h2 class="font-bold text-rose-700 ">Bekijk alle honden</h2>
            <p class="mt-6 text-sm" >Er wachten momenteel {{ $dogs_count }} honden op een nieuwe thuis</p>
        </a>
        <a href="#" class="w-full lg:w-1/3 h-auto lg:h-36 bg-white p-4 rounded shadow">
            <!-- Information card 2 -->
            <h2 class="font-bold text-rose-700">Bekijk alle katten</h2>
            <p class="mt-6 text-sm">Ook {{ $cats_count }} katten wachten momenteel op een ander baasje</p>
        </a>
        <a href="#" class="w-full lg:w-1/3 h-auto lg:h-36 bg-white p-4 rounded shadow">
            <!-- Information card 3 -->
            <h2 class="font-bold text-rose-700">Bekijk alle andere huisdieren</h2>
            <p class="mt-6 text-sm">We hebben {{ $others_count }} momenteel andere huisdieren</p>
        </a>

    </div>
</div>
    <div class="mx-auto w-full mt-24 px-6 lg:px-8">
    
      <h2 class="text-2xl font-bold text-rose-700">
          Honden in de kijker ({{ $dogs_featured_count}})
          
      </h2>
      <ul role="list" class="mx-auto mt-6 mb-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
          @foreach($dogs_featured as $animal)
              @include('components.animals.animal-card', ['animal' => $animal])
          @endforeach 
      </ul>
      
    </div>
</div>
</div>