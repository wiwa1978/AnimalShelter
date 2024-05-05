<div class="relative">
  <a wire-navigate href="{{ route('show-animal-detail', [$animal->id])  }}">
    <li class="border rounded-2xl" wire:key="{{ $animal->id }}">
      <img class="aspect-[3/2] w-full rounded-t-2xl object-cover" src="{{ $animal->photo_featured}}" alt="">

 

      <div class="p-6">
        <div class="flex justify-between items-center">
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ $animal->name }}</h3>
          @if($animal->status->value == 'Adopted')
          <!-- <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ $animal->status }}</h3> -->
          <div class="absolute top-2 right-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>

          @endif

          
          @if($animal->organization->organization_type == 'Individual')
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ __('animals_front.privateperson')}}</h3>
          @endif

          @if($animal->organization->organization_type == 'Organization')
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ __('animals_front.stichting')}}</h3>
          @endif

          @if($animal->organization->organization_type == 'Shelter')
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ __('animals_front.shelter')}}</h3>
          @endif

        </div>
        <div class="flex justify-between">
          <p class="text-base leading-7 text-gray-600">{{ $animal->current_location }}</p> 
          {{--<p class="text-base leading-7 text-gray-600">{{ \Carbon\Carbon::parse($animal->date_added)->format('d-m-Y') }}</p>--}}
        </div>

      </div>
    </li>
  </a>
</div>