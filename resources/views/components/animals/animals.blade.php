
<div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="mx-auto w-full lg:mx-0 text-center">
    

      <h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">

            {{ __('animals_front.adopt_dog')}} 
            <p class="mt-6 tracking-tight font-medium text-indigo-900 sm:text-xl">{{ $animals_count }} honden zoeken een nieuwe thuis</p>
   
         

      </h2>


      
    </div>



    <h2 class="mt-6 text-2xl font-bold text-indigo-900">
        
            {{ __('animals_front.all_dogs')}} ({{ $animals_count }})
       
       

    </h2>
    <ul role="list" class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        @foreach($animals_all as $animal)
            @include('components.animals.animal-card', ['animal' => $animal])
        @endforeach
    </ul>
    
    <div class="mt-10 ">
     {{ $animals_all->links() }} 
    </div>
  </div>
