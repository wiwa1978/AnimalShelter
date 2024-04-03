<div class="relative">
  <a wire-navigate href="{{ route('show-animal-detail', [$animal->id])  }}">
    <li class="border rounded-2xl" wire:key="{{ $animal->id }}">
      <img class="aspect-[3/2] w-full rounded-t-2xl object-cover" src="{{ $animal->photo_featured}}" alt="">
      <div class="p-6">
        <div class="flex justify-between items-center">
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ $animal->name }}</h3>
          @if( $animal->organization->is_shelter )
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">Asiel</h3>
          @else
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">Particulier</h3>
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