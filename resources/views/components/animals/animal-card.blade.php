<div class="relative">
	<a href="{{ route('show-animal-detail', [$animal->id]) }}" wire-navigate>
		<li class="rounded-2xl border" wire:key="{{ $animal->id }}">

			@if (Str::startsWith($animal->photo_featured, 'https'))
				<img class="aspect-[3/2] w-full rounded-t-2xl object-cover" src="{{ asset($animal->photo_featured) }}"
					alt="{{ $animal->name }}">
			@else
				<img class="aspect-[3/2] w-full rounded-t-2xl object-cover" src="{{ asset('storage/' . $animal->photo_featured) }}"
					alt="{{ $animal->name }}">
			@endif

			<div class="p-6">
				<div class="flex items-center justify-between">
					<h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ $animal->name }}</h3>
					@if ($animal->status->value == 'Adopted')
						<!-- <h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">{{ $animal->status }}</h3> -->
						<div class="absolute right-2 top-2">
							<svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
								stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
							</svg>
						</div>
					@endif

					@if ($animal->organization->organization_type == 'Individual')
						<h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">
							{{ __('animals_front.privateperson') }}</h3>
					@endif

					@if ($animal->organization->organization_type == 'Organization')
						<h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">
							{{ __('animals_front.stichting') }}</h3>
					@endif

					@if ($animal->organization->organization_type == 'Shelter')
						<h3 class="text-lg font-semibold leading-8 tracking-tight text-rose-700">
							{{ __('animals_front.shelter') }}</h3>
					@endif

				</div>
				<div class="flex justify-between">

					@if ($animal->current_location->value == \App\Enums\AnimalLocation::NETHERLANDS->value)
						<p class="text-base leading-7 text-gray-600">{{ __('animals_front.netherlands') }}</p>
					@endif
					@if ($animal->current_location->value ==  \App\Enums\AnimalLocation::ALBANIA->value)
						<p class="text-base leading-7 text-gray-600">{{ __('animals_front.albania') }}</p>
					@endif
					@if ($animal->current_location->value ==  \App\Enums\AnimalLocation::BELGIUM->value)
						<p class="text-base leading-7 text-gray-600">{{ __('animals_front.belgium') }}</p>
					@endif
					@if ($animal->current_location->value ==  \App\Enums\AnimalLocation::GERMANY->value)
						<p class="text-base leading-7 text-gray-600">{{ __('animals_front.germany') }}</p>
					@endif

					{{-- <p class="text-base leading-7 text-gray-600">{{ \Carbon\Carbon::parse($animal->date_added)->format('d-m-Y') }}</p> --}}
				</div>

			</div>
		</li>
	</a>
</div>
