<div class="relative">
  <a wire-navigate href="{{ route('show-animal-detail', [$animal->id])  }}">
    <li class="border rounded-2xl" wire:key="{{ $animal->id }}">
      <img class="aspect-[3/2] w-full rounded-t-2xl object-cover" src="{{ $animal->photo_featured}}" alt="">
      <div class="p-6">
        <div class="flex justify-between items-center">
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-900">{{ $animal->name }}</h3>
          @if($animal->user->organization)
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-indigo-900">Stichting</h3>
          @else
          <h3 class="text-lg font-semibold leading-8 tracking-tight text-indigo-900">Particulier</h3>
          @endif
        </div>
        <p class="text-base leading-7 text-gray-600">{{ $animal->location }}</p>
      </div>
    </li>
  </a>
</div>