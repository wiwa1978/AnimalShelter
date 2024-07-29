<div class="m-16 mx-auto w-full px-6 lg:px-8">
	<div class="mx-auto mb-16 w-full text-center lg:mx-0">

		<h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">
			Dieren van de week
		</h2>

		@if ($animals_count > 0)
			@if ($animals_count == 1)
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.animal_week_title') }}</p>
			@else
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.animals_week_title') }}
				</p>
			@endif
		@elseif($animals_count == 0)
			<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.no_animal_weeks_yet') }}
			</p>
		@endif

	</div>

	<ul class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4"
		role="list">
		@foreach ($animals as $animal)
			@include('components.animals.animal-card', ['animal' => $animal])
		@endforeach
	</ul>

</div>
