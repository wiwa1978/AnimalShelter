<div>
	<div class="relative w-full">
		<img class="h-auto w-full object-cover object-bottom" src="{{ asset('storage/images/dog4a.jpg') }}" alt="App screenshot">
		<div class="absolute bottom-6 left-0 z-10 flex h-3/4 w-full items-center justify-center p-6 text-center">
			<div>
				<!-- <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl">{{ __('animals_front.title') }}</h1> -->
				<h1
					class="text-3xl font-bold tracking-tight text-rose-700 sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl">
					{{ __('animals_front.subtitle') }}</h1>
				<h1
					class="text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl">
					via Lief Dier - Lief Thuis</h1>
			</div>
		</div>
		<div
			class="absolute bottom-0 left-1/2 z-20 flex w-full -translate-x-1/2 translate-y-1/2 transform justify-between space-x-4 px-6 text-center">

			<a class="mt-16 h-auto w-full rounded bg-white p-4 shadow sm:mt-0 lg:h-36 lg:w-1/3" href="{{ route('show-dogs') }}">
				<!-- Information card 1 -->

				@if ($dogs_count == 0)
					<h2 class="inline-block font-bold text-rose-700">{{ __('animals_front.view_all_dogs') }}</h2>
					<p class="mt-6 inline-block hidden text-sm sm:block">{{ __('animals_front.no_dogs_yet') }}</p>
				@else
					<h2 class="inline-block font-bold text-rose-700">{{ __('animals_front.view_all_dogs') }}</h2>
					@if ($dogs_count == 1)
						<p class="mt-6 inline-block hidden text-sm sm:block">{{ $dogs_count }} {{ __('animals_front.dog_waiting') }}</p>
					@else
						<p class="mt-6 inline-block hidden text-sm sm:block">{{ $dogs_count }} {{ __('animals_front.dogs_waiting') }}
						</p>
					@endif
				@endif
			</a>

			<a class="mt-16 h-auto w-full rounded bg-white p-4 shadow sm:mt-0 lg:h-36 lg:w-1/3" href="{{ route('show-cats') }}">
				<!-- Information card 2 -->
				@if ($cats_count == 0)
					<h2 class="font-bold text-rose-700">{{ __('animals_front.view_all_cats') }}</h2>
					<p class="mt-6 inline-block hidden text-sm sm:block">{{ __('animals_front.no_cats_yet') }}</p>
				@else
					<h2 class="font-bold text-rose-700">{{ __('animals_front.view_all_cats') }}</h2>
					<p class="mt-6 inline-block hidden text-sm sm:block">{{ __('animals_front.also') }} {{ $cats_count }}
						{{ __('animals_front.cats_waiting') }}</p>
				@endif
			</a>

			<a class="mt-16 h-auto w-full rounded bg-white p-4 shadow sm:mt-0 lg:h-36 lg:w-1/3"
				href="{{ route('show-others') }}">
				<!-- Information card 3 -->
				@if ($others_count == 0)
					<h2 class="font-bold text-rose-700">{{ __('animals_front.view_all_other') }}</h2>
					<p class="mt-6 inline-block hidden text-sm sm:block">{{ __('animals_front.no_others_yet') }}</p>
				@else
					<h2 class="font-bold text-rose-700">{{ __('animals_front.view_all_other') }}</h2>
					<p class="mt-6 inline-block hidden text-sm sm:block">{{ $others_count }} {{ __('animals_front.others_waiting') }}
					</p>
				@endif
			</a>

		</div>
	</div>
	@if ($dogs_featured_count > 0)
		<div class="mx-auto mt-24 w-full px-6 lg:px-8">
			<h2 class="text-2xl font-bold text-rose-700">
				{{ __('animals_front.featured_dogs') }} ({{ $dogs_featured_count }})
			</h2>
			<ul
				class="mx-auto mb-6 mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4"
				role="list">
				@foreach ($dogs_featured as $animal)
					@include('components.animals.animal-card', ['animal' => $animal])
				@endforeach
			</ul>
			<a class="mb-16 ml-6 flex items-center text-indigo-900" href="{{ route('show-featured-dogs') }}">
				<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
				</svg>
				<h1 class="font-bold text-indigo-900">{{ __('animals_front.view_all_featured_dogs') }}</h1>
			</a>
		</div>
	@endif

	@if ($cats_featured_count > 0)
		<div class="mx-auto mt-16 w-full px-6 lg:px-8">
			<h2 class="text-2xl font-bold text-rose-700">
				{{ __('animals_front.featured_cats') }} ({{ $cats_featured_count }})
			</h2>
			<ul
				class="mx-auto mb-6 mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4"
				role="list">
				@foreach ($cats_featured as $animal)
					@include('components.animals.animal-card', ['animal' => $animal])
				@endforeach
			</ul>
			<a class="ml-6 flex items-center text-indigo-900" href="{{ route('show-featured-cats') }}">
				<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
				</svg>
				<h1 class="font-bold text-indigo-900">{{ __('animals_front.view_all_featured_cats') }}</h1>
			</a>
		</div>
	@endif
	@if ($others_featured_count > 0)
		<div class="mx-auto mb-16 mt-16 w-full px-6 lg:px-8">
			<h2 class="text-2xl font-bold text-rose-700">
				{{ __('animals_front.featured_others') }} ({{ $others_featured_count }})
			</h2>
			<ul
				class="mx-auto mb-6 mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4"
				role="list">
				@foreach ($others_featured as $animal)
					@include('components.animals.animal-card', ['animal' => $animal])
				@endforeach
			</ul>
			<a class="ml-6 flex items-center text-indigo-900" href="{{ route('show-featured-others') }}">
				<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
				</svg>
				<h1 class="font-bold text-indigo-900">{{ __('animals_front.view_all_featured_others') }}</h1>
			</a>
		</div>
	@endif

</div>
</div>
