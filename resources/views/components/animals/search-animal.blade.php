<div class="m-16 mx-auto w-full px-6 lg:px-8">
	<div class="mx-auto w-full text-center lg:mx-0">
		<h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">
			{{ __('animals_front.search_title') }}
		</h2>

		@if ($animals_count == 1)
			<p class="mt-6 font-bold tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
				{{ __('animals_front.search_subtitle_singular') }}</p>
		@else
			<p class="mt-6 font-bold tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
				{{ __('animals_front.search_subtitle') }}</p>
		@endif
		<div class="mt-6 bg-white sm:rounded-lg" style="display: flex; justify-content: center; align-items: center; ">
			<div class="px-4 py-5 sm:p-6">
				<h3 class="text-base font-semibold leading-6 text-gray-900">{{ __('animals_front.search_animal') }}</h3>
				<div class="mt-6 max-w-xl text-sm text-gray-500">
					<div class="flex flex-col items-center justify-center space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
						<input class="space-y-4 rounded rounded-lg border border-dashed border-rose-900" type="text"
							wire:model.live="searchTerm" placeholder="Zoek op naam">
						<div>
							<select class="ml-2 inline-flex space-y-4 rounded rounded-lg border border-dashed border-rose-900"
								wire:model.live="searchAnimalType">
								<option value="None">{{ __('animals_front.animal_type') }}</option>
								@foreach ($animaltypes as $id => $animaltype)
									<option value="{{ $animaltype }}"> {{ $animaltype }}</option>
									<p>{{ $animaltype }}</p>
								@endforeach
							</select>
						</div>
						<div>
							<select class="ml-2 inline-flex space-y-4 rounded rounded-lg border border-dashed border-rose-900"
								wire:model.live="searchAnimalLocation">
								<option value="None">{{ __('animals_front.animal_location') }}</option>
								@foreach ($animallocations as $id => $location)
									<option value="{{ $location }}"> {{ $location }} </option>
								@endforeach
							</select>
						</div>
						<div>
							<select class="ml-2 inline-flex space-y-4 rounded rounded-lg border border-dashed border-rose-900"
								wire:model.live="searchAnimalAge">
								<option value="None">{{ __('animals_front.animal_age') }}</option>
								@if (Config::get('app.locale') === 'nl')
									@foreach ($animalages as $id => $age)
										<option value="{{ $age }}"> {{ $age . ' jaar' }} </option>
									@endforeach
								@else
									@foreach ($animalages as $id => $age)
										<option value="{{ $age }}"> {{ $age . ' years' }} </option>
									@endforeach
								@endif
							</select>
						</div>
						<div>
							<select class="ml-2 inline-flex space-y-4 rounded rounded-lg border border-dashed border-rose-900"
								wire:model.live="searchAnimalGender">
								<option value="None">{{ __('animals_front.animal_gender') }}</option>
								@foreach ($animalgenders as $id => $gender)
									<option value="{{ $gender }}"> {{ $gender }} </option>
								@endforeach
							</select>
						</div>
						<div>
							<select class="ml-2 inline-flex space-y-4 rounded rounded-lg border border-dashed border-rose-900"
								wire:model.live="searchAnimalOwner">
								<option value="None">{{ __('animals_front.animal_owner') }}</option>
								@foreach ($animalowners as $id => $owner)
									<option value="{{ $owner }}"> {{ $owner }} </option>
								@endforeach
							</select>
						</div>
						<div>
							<button
								class="ml-2 inline-flex rounded-md bg-rose-700 px-3 py-2 text-xl font-medium text-white hover:bg-indigo-900 hover:text-white"
								type="button" wire:click="resetFilter">Reset</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<h2 class="pt-12 text-2xl font-bold text-indigo-900">
		{{ __('animals_front.all_animals') }} <span wire:model.live="animals_count"=>({{ $animals_count }})</span>
	</h2>

	<ul
		class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4"
		role="list">

		@foreach ($animals_all as $animal)
			@include('components.animals.animal-card', ['animal' => $animal])
		@endforeach

	</ul>

	{{--
    <div class="mt-10 ">
      {{ $animals_all->links() }}
    </div>
      --}}

</div>
