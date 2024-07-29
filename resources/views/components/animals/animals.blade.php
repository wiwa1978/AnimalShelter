<div class="m-16 mx-auto w-full px-6 lg:px-8">
	<div class="mx-auto w-full text-center lg:mx-0">

		<h2 class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl">

			@if ($animal_type == 'dog' && $animals_count > 0)
				{{ __('animals_front.adopt_dog') }}
				@if ($animals_count == 1)
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.dog_new_home') }}</p>
				@else
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.dogs_new_home') }}</p>
				@endif
			@elseif($animal_type == 'dog' && $animals_count == 0)
				{{ __('animals_front.adopt_dog') }}
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.no_dogs_yet') }}</p>
			@endif
			@if ($animal_type == 'cat' && $animals_count > 0)
				{{ __('animals_front.adopt_cat') }}
				@if ($animals_count == 1)
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.cat_new_home') }}</p>
				@else
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.cats_new_home') }}</p>
				@endif
			@elseif($animal_type == 'cat' && $animals_count == 0)
				{{ __('animals_front.adopt_cat') }}
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.no_cats_yet') }}</p>
			@endif
			@if ($animal_type == 'other' && $animals_count > 0)
				{{ __('animals_front.adopt_other') }}
				@if ($animals_count == 1)
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.other_new_home') }}</p>
				@else
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.others_new_home') }}</p>
				@endif
			@elseif($animal_type == 'other' && $animals_count == 0)
				{{ __('animals_front.adopt_other') }}
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.no_others_yet') }}</p>
			@endif

			@if ($animal_type == 'dog-featured' && $animals_count > 0)
				{{ __('animals_front.dogs_in_picture') }}
				@if ($animals_count == 1)
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.dog_new_home_featured') }}</p>
				@else
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.dogs_new_home_featured') }}</p>
				@endif
			@elseif($animal_type == 'dog-featured' && $animals_count == 0)
				{{ __('animals_front.dogs_in_picture') }}
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.no_dogs_yet') }}</p>
			@endif

			@if ($animal_type == 'cat-featured' && $animals_count > 0)
				{{ __('animals_front.cats_in_picture') }}
				@if ($animals_count == 1)
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.cat_new_home_featured') }}</p>
				@else
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.cats_new_home_featured') }}</p>
				@endif
			@elseif($animal_type == 'cat-featured' && $animals_count == 0)
				{{ __('animals_front.cats_in_picture') }}
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.no_cats_yet') }}</p>
			@else
			@endif

			@if ($animal_type == 'other-featured' && $animals_count > 0)
				{{ __('animals_front.others_in_picture') }}
				@if ($animals_count == 1)
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.other_new_home_featured') }}</p>
				@else
					<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ $animals_count }}
						{{ __('animals_front.others_new_home_featured') }}</p>
				@endif
			@elseif($animal_type == 'other-featured' && $animals_count == 0)
				{{ __('animals_front.others_in_picture') }}
				<p class="mt-6 font-medium tracking-tight text-indigo-900 sm:text-xl">{{ __('animals_front.no_others_yet') }}</p>
			@endif

		</h2>
	</div>

	<h2 class="mt-6 text-2xl font-bold text-indigo-900">
		@if ($animal_type == 'dog' && $animals_count > 0)
			{{ __('animals_front.all_dogs') }} ({{ $animals_count }})
		@endif
		@if ($animal_type == 'cat' && $animals_count > 0)
			{{ __('animals_front.all_cats') }} ({{ $animals_count }})
		@endif
		@if ($animal_type == 'other' && $animals_count > 0)
			{{ __('animals_front.all_others') }} ({{ $animals_count }})
		@endif
	</h2>
	<ul
		class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4"
		role="list">
		@foreach ($animals_all as $animal)
			@include('components.animals.animal-card', ['animal' => $animal])
		@endforeach
	</ul>

	<div class="mt-10">
		{{ $animals_all->links() }}
	</div>
</div>
