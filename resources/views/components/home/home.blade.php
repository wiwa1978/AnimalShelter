
<div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-46 lg:pt-6 xl:col-span-6">
      <div class="mx-auto max-w-2xl lg:mx-0">
        {{--<img class="h-11" src="https://tailwindui.com/img/logos/mark.svg?color=rose&shade=800" alt="Your Company">--}}
        <div class="hidden sm:mt-32 sm:flex lg:mt-16">
          
        </div>
        <h1 class="mt-24 text-4xl font-bold tracking-tight text-gray-900 sm:mt-10 sm:text-6xl">Herplaatsen van honden, katten en andere huisdieren</h1>
        <p class="mt-16 text-lg leading-8 text-gray-600">Welkom bij onze adoptiecommunity, waar liefde voor dieren centraal staat. Ontdek een wereld vol hoop en compassie, waar we streven naar het verbinden van dieren in nood met liefdevolle thuisomgevingen. Samen creëren we kansen voor dieren die een tweede kans verdienen. Blader door onze adoptieprofielen en vind jouw perfecte metgezel - want het begin van een levenslange vriendschap wacht op jou!</p>
        <div class="mt-16 justify-center flex items-center gap-x-6">
          <a href="{{ route('show-dogs') }}" class="rounded-md bg-rose-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Bekijk alle honden</a>
          <a href="{{ route('show-cats') }}" class="rounded-md bg-rose-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Bekijk alle katten</a>
          <a href="{{ route('show-others') }}" class="rounded-md bg-rose-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Bekijk alle andere dieren</a>
  
        </div>
      </div>
    </div>
    <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
      <img class="aspect-[3/2] rounded-lg w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-5/6" src="{{ asset('/storage/home/dog-home.jpg') }}" alt="">
    </div>

    <div>
      <h2 class="text-2xl font-bold text-rose-900">
          Honden in de kijker ({{ $dogs_featured_count}})
          
      </h2>
      <ul role="list" class="mx-auto mt-6 mb-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
          @foreach($dogs_featured as $animal)
              @include('components.animals.animal-card', ['animal' => $animal])
          @endforeach 
      </ul>
      
    </div>
    <div class="mb-6">
      {{ $dogs_featured->links() }}
    </div> 
    <div>
      <h2 class="text-2xl font-bold text-rose-900">
          Katten in de kijker ({{ $cats_featured_count}})
          
      </h2>
      <ul role="list" class="mx-auto mt-6 mb-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
          @foreach($cats_featured as $animal)
              @include('components.animals.animal-card', ['animal' => $animal])
          @endforeach 
      </ul>
      <div class="mb-6">
        {{ $cats_featured->links() }}
      </div> 
    </div>

    <div>
      <h2 class="text-2xl font-bold text-rose-900">
          Andere huisdieren in de kijker ({{ $others_featured_count}})
          
      </h2>
      <ul role="list" class="mx-auto mt-6 mb-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
          @foreach($others_featured as $animal)
              @include('components.animals.animal-card', ['animal' => $animal])
          @endforeach 
      </ul>
      <div class="mb-6">
        {{ $others_featured->links() }}
      </div> 
    </div>

  </div>


