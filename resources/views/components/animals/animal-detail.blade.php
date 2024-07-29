<div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
	<div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-16">
		<h2 class="text-4xl font-bold text-rose-700">{{ $animal->name }} </h2>
		@if ($animal->status->getLabel() === 'Geadopteerd')
			<p class="mt-4 text-lg text-gray-500">{{ __('animals_front.adopted') }}</p>
		@endif

		@if ($animal->status->getLabel() === 'Gereserveerd')
			<p class="mt-4 text-lg text-gray-500">{{ __('animals_front.reserved') }}</p>
		@endif

		<div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
			@empty(!$photos_http)
				@foreach ($photos_http as $photo)
					<div class="group relative">
						<div class="relative overflow-hidden rounded-lg">
							<img class="h-800 w-600 object-cover object-center" src=" {{ $photo }}" alt="Photo from {{ $animal->name }}">
						</div>
					</div>
				@endforeach
			@endempty

			@empty(!$photos_media)
				@foreach ($photos_media as $photo)
					<div class="group relative">
						<div class="relative overflow-hidden rounded-lg">
							<img class="h-800 w-600 object-cover object-center" src=" {{ asset('storage/' . $photo) }}"
								alt="Photo from {{ $animal->name }}">
						</div>
					</div>
				@endforeach
			@endempty
		</div>
	</div>

	<div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-full lg:grid-flow-col-dense lg:grid-cols-3">
		<div class="space-y-6 lg:col-span-2 lg:col-start-1">
			<!-- First Section-->
			<section aria-labelledby="applicant-information-title">
				<div class="border border-gray-200 bg-white shadow sm:rounded-lg">
					<div class="flex items-center justify-between px-4 py-5 sm:px-6">
						<h2 class="text-xl font-medium leading-6 text-rose-700">{{ $animal->name }}</h2>

						@auth
							@if ($is_favorite)
								<div class="flex-items flex" style="cursor:pointer" wire:loading.remove wire:click="toggleFavorite({{ $animal->id }})">
									<svg class="mr-2 h-6 w-6 text-rose-700" tooltip="test" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
										viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round"
											d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
										<title>Toegevoegd aan favorieten</title>
									</svg>
						
									<p class="text-rose-700"></p>
								</div>
							@else
								<div class="flex-items flex" style="cursor:pointer" wire:loading.remove
									wire:click="toggleFavorite({{ $animal->id }})">
									<svg class="mr-2 h-6 w-6 text-rose-700" tooltip="test" xmlns="http://www.w3.org/2000/svg" fill="none"
										viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round"
											d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
										<title>Toevoegen aan favorieten</title>
									</svg>
									<p class="text-rose-700"></p>
								</div>
							@endif
					@endauth

						@if ($isAnimalBelongsToShelter)
							<h2 class="text-xl font-medium leading-6 text-indigo-900">{{ __('animals_front.shelter') }}
							</h2>
						@endif

						@if ($isAnimalBelongsToIndividual)
							<h2 class="text-xl font-medium leading-6 text-indigo-900">
								{{ __('animals_front.privateperson') }}</h2>
						@endif

						@if ($isAnimalBelongsToOrganization)
							<h2 class="text-xl font-medium leading-6 text-indigo-900">
								{{ __('animals_front.stichting') }}</h2>
						@endif
					</div>

					<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
						<dl class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-6">
							<div class="sm:col-span-1">
								<dt class="text-sm font-medium text-indigo-900">
									{{ __('animals_front.current_location') }}</dt>
								@if ($animal->current_location->value == 'Netherlands')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.netherlands') }}</dd>
								@endif
								@if ($animal->current_location->value == 'Albania')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.albania') }}</dd>
								@endif
								@if ($animal->current_location->value == 'Belgium')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.belgium') }}</dd>
								@endif
								@if ($animal->current_location->value == 'Germany')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.germany') }}</dd>
								@endif
							</div>
							<div class="sm:col-span-1">
								<dt class="text-sm font-medium text-indigo-900">{{ __('animals_front.origin') }}</dt>
								@if ($animal->original_location->value == 'Netherlands')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.netherlands') }}</dd>
								@endif
								@if ($animal->original_location->value == 'Albania')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.albania') }}</dd>
								@endif
								@if ($animal->original_location->value == 'Belgium')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.belgium') }}</dd>
								@endif
								@if ($animal->original_location->value == 'Germany')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.germany') }}</dd>
								@endif

							</div>
							<div class="sm:col-span-1">
								<dt class="text-sm font-medium text-indigo-900">{{ __('animals_front.age') }}</dt>
								<dd class="mt-1 text-sm text-gray-900">{{ $animal->age }}
									{{ __('animals_front.year') }}</dd>
							</div>
							<div class="sm:col-span-1">
								<dt class="text-sm font-medium text-indigo-900">{{ __('animals_front.gender') }}</dt>

								@if ($animal->gender->value == 'Male')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.male') }}</dd>
								@endif
								@if ($animal->gender->value == 'Female')
									<dd class="mt-1 text-sm text-gray-900">{{ __('animals_front.female') }}</dd>
								@endif

							</div>
							<div class="sm:col-span-1">
								<dt class="text-sm font-medium text-indigo-900">{{ __('animals_front.breed') }}</dt>
								<dd class="mt-1 text-sm text-gray-900">{{ $animal->breed }}</dd>
							</div>
							<div class="sm:col-span-1">
								<dt class="text-sm font-medium text-indigo-900">{{ __('animals_front.adoption_fee') }}
								</dt>
								<dd class="mt-1 text-sm text-gray-900">{{ $animal->adoption_fee }}</dd>
							</div>

						</dl>
					</div>
				</div>
			</section>

			<!-- Thuissituatie Section -->
			<section aria-labelledby="applicant-information-title">
				<div class="border border-gray-200 bg-white shadow sm:rounded-lg">
					<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
						<dt class="mb-6 text-sm font-medium text-indigo-900">{{ __('animals_front.home_situation') }}
						</dt>
						<dl class="grid grid-cols-1 gap-x-4 gap-y-1 sm:grid-cols-2">
							<div>
								<div class="relative">
									<div class="relative flex space-x-3">
										<div>
											<div>
												<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
													<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
														fill="currentColor">
														<path fill-rule="evenodd"
															d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
															clip-rule="evenodd" />
													</svg>
												</span>
											</div>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.environment_children') }}:
													{{ $animal->current_kids == 1 ? 'Ja' : 'Nee' }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div>
								<div class="relative">
									<div class="relative flex space-x-3">
										<div>
											<div>
												<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
													<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
														fill="currentColor">
														<path fill-rule="evenodd"
															d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
															clip-rule="evenodd" />
													</svg>
												</span>
											</div>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.environment_dogs') }}:
													{{ $animal->current_dogs == 1 ? 'Ja' : 'Nee' }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div>
								<div class="relative">
									<div class="relative flex space-x-3">
										<div>
											<div>
												<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
													<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
														fill="currentColor">
														<path fill-rule="evenodd"
															d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
															clip-rule="evenodd" />
													</svg>
												</span>
											</div>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.environment_cats') }}:
													{{ $animal->current_cats == 1 ? 'Ja' : 'Nee' }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div>
								<div class="relative">
									<div class="relative flex space-x-3">
										<div>
											<div>
												<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
													<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
														fill="currentColor">
														<path fill-rule="evenodd"
															d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
															clip-rule="evenodd" />
													</svg>
												</span>
											</div>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.environment_home') }}:
													{{ $animal->current_home_alone == 1 ? 'Ja' : 'Nee' }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div>
								<div class="relative">
									<div class="relative flex space-x-3">
										<div>
											<div>
												<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
													<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
														fill="currentColor">
														<path fill-rule="evenodd"
															d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
															clip-rule="evenodd" />
													</svg>
												</span>
											</div>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">{{ __('animals_front.garden') }}:
													{{ $animal->current_garden == 1 ? 'Ja' : 'Nee' }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</dl>
					</div>
				</div>
			</section>

			<!-- Description Section-->
			<section aria-labelledby="applicant-information-title">
				<div class="border border-gray-200 bg-white shadow sm:rounded-lg">
					<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
						<dl class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4">
							<div class="col-span-2 sm:col-span-4">
								<dt class="text-sm font-medium text-indigo-900">{{ __('animals_front.description') }}
								</dt>
								<div class="mt-1 text-sm text-gray-900">
									{!! $animal->description !!}
								</div>

							</div>
						</dl>
					</div>
				</div>
			</section>
			<!-- Environment Section-->
			@empty(!$animal->environment)
				<section aria-labelledby="applicant-information-title">
					<div class="border border-gray-200 bg-white shadow sm:rounded-lg">
						<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
							<dl class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4">
								<div class="col-span-2 sm:col-span-4">
									<dt class="text-sm font-medium text-indigo-900">{{ __('animals_front.environment') }}
									</dt>
									<dd class="texte-gray-900 mt-1 text-sm">{!! $animal->environment !!}</dd>
								</div>
							</dl>
						</div>
					</div>
				</section>
			@endempty

			<!-- Additional videos -->
			@empty(!$animal->youtube_links)
				<section aria-labelledby="applicant-information-title">
					<div class="border border-gray-200 bg-white shadow sm:rounded-lg">
						<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
							<dl class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4">
								<div class="sm:col-span-4">
									<dt class="text-sm font-medium text-gray-500">{{ __('animals_front.videos') }}</dt>
									<div class="flex flex-wrap justify-center">
										@foreach ($youtube_links as $link)
											<div class="group relative mx-2 mt-6 w-full sm:w-1/2 lg:mx-4 lg:w-1/4">
												<div class="media-body rounded">
													<iframe class="h-auto w-full justify-center rounded-lg" src="{{ $link }}" frameborder="0"
														allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
														allowfullscreen></iframe>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</dl>
						</div>
					</div>
				</section>
			@endempty
		</div>

		<div class="space-y-6">
			@if ($animal_reserved)
				<section class="lg:col-span-1 lg:col-start-3">
					<div class="border border-gray-200 bg-white px-4 py-5 text-center shadow sm:rounded-lg sm:px-6">
						<h2 class="text-center text-lg font-medium text-green-700">{{ __('animals_front.this_') }}
							{{ __('animals_front.animal') }} {{ __('animals_front.is') }}
							{{ __('animals_front.currently_reserved') }}</h2>
					</div>
				</section>
			@endif

			@if ($animal_adopted)
				<section class="lg:col-span-1 lg:col-start-3">
					<div class="border border-gray-200 bg-white px-4 py-5 text-center shadow sm:rounded-lg sm:px-6">
						<h2 class="text-center text-lg font-medium text-green-700">{{ __('animals_front.this_') }}
							{{ __('animals_front.animal') }} {{ __('animals_front.is') }}
							{{ strtolower(__('animals_front.adopted')) }}</h2>
					</div>
				</section>
			@endif

			@if ($animal_not_adoptable)
				<section class="lg:col-span-1 lg:col-start-3">
					<div class="border border-gray-200 bg-white px-4 py-5 text-center shadow sm:rounded-lg sm:px-6">
						<h2 class="text-center text-lg font-medium text-rose-700">{{ __('animals_front.this_') }}
							{{ __('animals_front.animal') }} {{ __('animals_front.cannot_be_adopted') }}</h2>
					</div>
				</section>
			@endif

			@if (!$animal_adopted && !$animal_reserved && !$animal_not_adoptable)
				<section class="lg:col-span-1 lg:col-start-3">
					<div class="border border-gray-200 bg-white px-4 py-5 text-center shadow sm:rounded-lg sm:px-6">
						@if ($animal->animal_type->getLabel() === 'Hond' or $animal->animal_type->getLabel() === 'Kat')
							<span class="text-center text-lg text-gray-800">{{ __('animals_front.this') }}
								{{ strtolower($animal->animal_type->getLabel()) }} is </span><span
								class="text-center text-lg text-rose-700">beschikbaar</span> <span
								class="text-center text-lg text-gray-800">voor adoptie en staat al </span><span
								class="text-center text-lg text-rose-700"> {{ $days_adoptable }} dagen</span><span
								class="text-center text-lg text-gray-800"> op deze site.</span>
							<span class="text-center text-lg text-gray-800">Contacteer </span><span
								class="text-center text-lg text-rose-700">{{ $organization->name }} </span><span
								class="text-center text-lg text-gray-800">voor meer informatie</span>
						@else
							<span class="text-center text-lg text-gray-800">{{ __('animals_front.this') }}
								{{ __('animals_front.pet') }} {{ __('animals_front.is') }}</span><span
								class="text-center text-lg text-rose-700"> {{ __('animals_front.available') }}</span>
							<span class="text-center text-lg text-gray-800">{{ __('animals_front.for_adoption') }}
								{{ __('animals_front.and_is') }} </span><span class="text-center text-lg text-rose-700">
								{{ $days_adoptable }}
								{{ __('animals_front.days') }}</span><span class="text-center text-lg text-gray-800">
								{{ __('animals_front.on_site') }}.</span>
							<span class="text-center text-lg text-gray-800">{{ __('animals_front.contact') }}
							</span><span class="text-center text-lg text-rose-700">{{ $organization->name }}
							</span><span class="text-center text-lg text-gray-800">{{ __('animals_front.more_info') }}</span>
						@endif

					</div>
				</section>
			@endif

			<!-- Alert -->
			<div>
				<div x-data="{ showAlert: true }">
					@if (session()->has('message'))
						<div class="rounded-md bg-green-50 p-4" x-show="showAlert">
							<div class="flex">
								<div class="flex-shrink-0">
									<svg class="h-5 w-5 text-green-400" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
										<path fill-rule="evenodd"
											d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
											clip-rule="evenodd" />
									</svg>
								</div>
								<div class="ml-3">
									<p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
								</div>
								<div class="ml-auto pl-3">
									<div class="-mx-1.5 -my-1.5">
										<button
											class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50"
											type="button" x-on:click="showAlert = false">
											<span class="sr-only">Dismiss</span>
											<svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
												<path
													d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
											</svg>
										</button>
									</div>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>

			<!-- Modal -->
			<div x-on:close-modal="showModal = false" x-data="{ isModalOpen: false }">
				<div
					class="grid grid-cols-2 gap-3 border border-gray-200 bg-white px-4 py-5 text-center shadow sm:rounded-lg sm:px-6">
					<!-- Contacteer Ons -->

					<div>
						@if (!Auth::check())
							<button
								class="inline-flex items-center gap-x-2 rounded-md bg-rose-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
								type="button" x-on:click="isModalOpen = true">
								<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
									stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
								</svg>
								Contacteer ons
							</button>
						@else
							<button
								class="inline-flex items-center gap-x-2 rounded-md bg-rose-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
								type="button" wire:click.prevent="redirectLogin()">
								<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
									stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
								</svg>
								Contacteer ons
							</button>
						@endif
					</div>

					<!-- Bekijk dieren -->
					<div>
						<button
							class="inline-flex items-center gap-x-2 rounded-md bg-indigo-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
							type="button" wire:click="viewAnimalsByOrganization({{ $animal->organization_id }})">
							<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
								stroke-width="1.5" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
							</svg>
							Bekijk al onze dieren
						</button>
					</div>
				</div>

				<!--  Test -->

				<div class="relative z-10" role="dialog" aria-labelledby="modal-title" aria-modal="true" x-show="isModalOpen"
					x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
					x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
					x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

					<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

					<div class="fixed inset-0 z-10 w-screen overflow-y-auto">
						<div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
							x-transition:enter="opacity-0 ease-out duration-300"
							x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
							x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
							x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
							x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

							<div
								class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
								<div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
									<button
										class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
										type="button" x-on:click="isModalOpen = false">
										<span class="sr-only">Close</span>
										<svg class="h-6 w-6" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
											stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
										</svg>
									</button>
								</div>
								<div class="sm:flex sm:items-start">
									<div
										class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
										<svg class="h-6 w-6 text-red-600" aria-hidden="true" fill="none" viewBox="0 0 24 24"
											stroke-width="1.5" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
										</svg>
									</div>
									<div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
										<h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
											Bericht versturen voor {{ $animal->name }}</h3>
										<div class="mt-2">
											<p class="text-sm text-gray-500">Om een bericht te versturen, hebt u een
												account nodig. Indien u reeds een account heeft kunt u gewoon inloggen
												via 'Login'. Indien u nog geen account hebt kan u een aanmaken via de
												knop 'Registreren'</p>
										</div>
									</div>
								</div>
								<div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
									<button
										class="inline-flex w-full justify-center rounded-md bg-rose-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-900 sm:ml-3 sm:w-auto"
										type="button" wire:click.prevent="redirectRegister()">Registreer</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- Contact Information -->
			<section class="lg:col-span-1 lg:col-start-3">
				<div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
					<h2 class="text-lg font-medium text-rose-700" id="timeline-title">
						{{ __('animals_front.contact_info') }}</h2>
					<div>
						<div class="mb-6 mt-6 flow-root justify-center">
							<ul class="-mb-8" role="list">
								<li>
									<div class="relative flex space-x-3 pb-1">
										<div>

											@if ($isAnimalBelongsToShelter)
												<span class="text-sm font-medium text-indigo-900">{{ __('animals_front.current_location') }}
													({{ strtolower(__('animals_front.shelter')) }}): </span><span
													class="text-sm text-gray-500"">{{ $organization->organization_name }}</span>
											@endif

											@if ($isAnimalBelongsToOrganization)
												<span class="text-sm font-medium text-indigo-900">
													{{ __('animals_front.current_location') }}
													({{ strtolower(__('animals_front.organization')) }}): </span><span
													class="text-sm text-gray-500"">{{ $organization->organization_name }}</span>
											@endif

											@if ($isAnimalBelongsToIndividual)
												<span class="text-sm font-medium text-indigo-900">
													{{ __('animals_front.current_location') }}
													({{ strtolower(__('animals_front.individual')) }}): </span><span
													class="text-sm text-gray-500"">{{ $organization->name }}</span>
											@endif

										</div>
									</div>
								</li>
								<li>
									<div class="relative flex space-x-3 pb-1">
										<div>
											<span class="text-sm font-medium text-indigo-900">{{ __('animals_front.telephone') }}:
											</span><span class="text-sm text-gray-500"">{{ $organization->phone }}</span>
										</div>
									</div>
								</li>
								<li>
									<div class="relative flex space-x-3 pb-1">
										<div>
											<span class="text-sm font-medium text-indigo-900">{{ __('animals_front.email') }}:
											</span><span class="text-sm text-gray-500"">{{ $organization->email }}</span>
										</div>
									</div>
								</li>
								<li>
									<div class="relative flex space-x-3 pb-1">
										<div>
											<p class="text-sm font-medium text-indigo-900">
												{{ __('animals_front.address') }}:</p>
											<p class="ml-6 text-sm text-gray-500">{{ $organization->streetname }}
												{{ $organization->streetnumber }}</p>
											<p class="ml-6 text-sm text-gray-500">{{ $organization->zipcode }}
												{{ $organization->city }}</p>
											<p class="ml-6 text-sm text-gray-500">{{ $organization->country }}</p>
										</div>
									</div>
								</li>
								@if ($organization->shelter_website)
									<li>
										<div class="relative flex space-x-3 pb-1">
											<div>
												<span class="text-sm font-medium text-indigo-900">Website: </span><span class="text-sm text-gray-500""><a
														href="{{ $organization->shelter_website }}">{{ $organization->shelter_website }}</a>
												</span>
											</div>
										</div>
									</li>
								@endif
							</ul>
						</div>
					</div>
			</section>

			<!-- Medical Information -->
			<section class="lg:col-span-1 lg:col-start-3" aria-labelledby="timeline-title">
				<div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
					<h2 class="text-lg font-medium text-rose-700" id="timeline-title">
						{{ __('animals_front.medical_info') }}</h2>

					<!-- Activity Feed -->
					<div class="mt-6 flow-root">
						<ul class="-mb-8" role="list">
							<li>
								<div class="relative pb-2">

									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500"> {{ __('animals_front.sterilized') }}
													: <a class="font-medium text-gray-900" href="#">
														{{ $animal->sterilized == 1 ? 'Ja' : 'Nee' }}</a></p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500"> {{ __('animals_front.chipped') }} :
													<a class="font-medium text-gray-900" href="#">
														{{ $animal->chipped == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.vaccinated') }} : <a class="font-medium text-gray-900" href="#">
														{{ $animal->vaccinated == 1 ? 'Ja' : 'Nee' }}</a></p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500"> {{ __('animals_front.rabies') }} :
													<a class="font-medium text-gray-900" href="#">
														{{ $animal->rabies == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500"> {{ __('animals_front.medicins') }}
													: <a class="font-medium text-gray-900" href="#">
														{{ $animal->medicins == 1 ? 'Ja' : 'Nee' }}</a></p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-6">

									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.special_food') }} : <a class="font-medium text-gray-900" href="#">
														{{ $animal->special_food == 1 ? 'Ja' : 'Nee' }}</a></p>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>

				</div>
			</section>

			<!-- Social Information -->
			<section class="pb-16 lg:col-span-1 lg:col-start-3" aria-labelledby="timeline-title">
				<div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
					<h2 class="text-lg font-medium text-rose-700" id="timeline-title">
						{{ __('animals_front.social_info') }} </h2>

					<!-- Social Information -->
					<div class="mt-6 flow-root">
						<ul class="-mb-8" role="list">

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.cat_friendly') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->cats_friendly == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>

										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.dog_friendly') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->dogs_friendly == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.kids_friendly_6y') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->kids_friendly_6y == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.kids_friendly_14y') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->kids_friendly_14y == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.needs_garden') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->needs_garden == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.potty_trained') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->potty_trained == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.car_friendly') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->car_friendly == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.home_alone') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->home_alone == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.knows_command') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->knows_commands == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.experience_required') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->experience_required == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.well_behaved') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->well_behaved == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">{{ __('animals_front.playful') }}:
													<a class="font-medium text-gray-900" href="#">{{ $animal->playful == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-2">
									<span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.everybody_friendly') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->everybody_friendly == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="relative pb-6">

									<div class="relative flex space-x-3">
										<div>
											<span class="flex h-8 w-8 items-center justify-center rounded-full ring-8 ring-white">
												<svg class="h-6 w-6 text-rose-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
													fill="currentColor">
													<path fill-rule="evenodd"
														d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
														clip-rule="evenodd" />
												</svg>
											</span>
										</div>
										<div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
											<div>
												<p class="text-sm text-gray-500">
													{{ __('animals_front.affectionate') }}: <a class="font-medium text-gray-900"
														href="#">{{ $animal->affectionate == 1 ? 'Ja' : 'Nee' }}</a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>

				</div>
			</section>

		</div>
	</div>
