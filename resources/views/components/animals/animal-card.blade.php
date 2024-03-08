<div>
  <a wire-navigate href="{{ route('show-animal-detail', [$animal->id])  }}">
      <li class="border rounded-2xl" wire:key="{{ $animal->id }}">
        <img class="aspect-[3/2] w-full rounded-t-2xl object-cover" src="{{ $animal->photo_featured}}" alt="">
        <div class="p-6">
            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">{{ $animal->name }}</h3>
            <p class="text-base leading-7 text-gray-600">{{ $animal->location }}</p>
        </div>
      </li>
    </a>
</div>
