
  <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-16">
      <h2 class="text-4xl text-rose-900 font-bold ">{{ $animal->name}}</h2>

      <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
        @foreach($photos as $photo)
        <div class="group relative">
          <div class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
            <img src="{{ $photo }}" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="h-full w-full object-cover object-center">
          </div>
        </div>
        @endforeach
      </div>
    </div>


<div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-full lg:grid-flow-col-dense lg:grid-cols-3">
      <div class="space-y-6 lg:col-span-2 lg:col-start-1">
        <!-- First Section-->
        <section aria-labelledby="applicant-information-title">
          <div class="border border-gray-200 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
              <h2 class="text-xl font-medium leading-6 text-rose-900">{{ $animal->name}}</h2>
              <h2 class="text-xl font-medium leading-6 text-gray-900">{{ $user->organization == 1 ? "Organization" : "Individual" }}</h2>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <dl class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4">
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Country:</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->location}}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Age:</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->age}}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Gender:</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->gender}}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Breed:</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->breed}}</dd>
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
                <div class="sm:col-span-4">
                  <dt class="text-sm font-medium text-gray-500">Description</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->description }}</dd>
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
                <div class="sm:col-span-4">
                  <dt class="text-sm font-medium text-gray-500">Environment</dt>
                  <dd class="mt-1 text-sm texte-gray-900">{{ $animal->environment }}</dd>
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
                  <dt class="text-sm font-medium text-gray-500">Videos</dt>

                    @foreach ($youtube_links as $link)
                        <div class="mt-6 group relative ">
                            <div class="media-body rounded">
                                <iframe class="rounded-lg" width="300" height="200" src="{{ $link }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endforeach
                </div>
              </dl>
            </div>
          </div>
        </section>
        @endempty
      </div>

      <div class="space-y-6 ">
        <section  class="lg:col-span-1 lg:col-start-3">
            <div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
            <h2  class="text-lg font-medium text-rose-900">Current Location</h2>

            <!-- Activity Feed -->
            <div class="mt-6 flow-root">
                <ul role="list" class="-mb-8">
                    <li>
                    <div class="relative flex pb-1 space-x-3">
                        <div>
                            <p class="text-sm text-gray-500">Organization Name: <a href="#" class="font-medium text-gray-900"> {{ $user->organization_name }}</a></p>
                        </div>
                    </div>

                    </li>
                    <li>
                    <div class="relative flex pb-1 space-x-3">
                        <div>
                            <p class="text-sm text-gray-500">Organization Website: <a href="#" class="font-medium text-gray-900"> {{ $user->website }}</a></p>
                        </div>
                    </div>

                    </li>
                     <li>
                    <div class="relative flex pb-8 space-x-3">
                        <div>
                            <p class="text-sm text-gray-500">Address: <a href="#" class="font-medium text-gray-900"> Hier komt address</a></p>
                        </div>
                    </div>

                    </li>
                </ul>
            </div>

            </div>
        </section>

        <!-- Medical Information -->
        <section aria-labelledby="timeline-title" class="lg:col-span-1 lg:col-start-3">
            <div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-rose-900">Medical Information</h2>

            <!-- Activity Feed -->
            <div class="mt-6 flow-root">
                <ul role="list" class="-mb-8">
                <li>
                    <div class="relative pb-2">
                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                        <div>
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Sterilized: <a href="#" class="font-medium text-gray-900"> {{ $animal->sterilized == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Chipped: <a href="#" class="font-medium text-gray-900"> {{ $animal->chipped == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Vaccinated: <a href="#" class="font-medium text-gray-900"> {{ $animal->vaccinated == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Rabies: <a href="#" class="font-medium text-gray-900"> {{ $animal->rabies == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Medicins: <a href="#" class="font-medium text-gray-900"> {{ $animal->medicins == 1 ? "Yes" : "No" }}</a></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </li>

                <li>
                    <div class="relative pb-6">

                    <div class="relative flex space-x-3">
                        <div>
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Special Food: <a href="#" class="font-medium text-gray-900"> {{ $animal->special_food== 1 ? "Yes" : "No" }}</a></p>
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
        <section aria-labelledby="timeline-title" class="lg:col-span-1 lg:col-start-3 pb-16">
            <div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-rose-900">Social Information</h2>

            <!-- Social Information -->
            <div class="mt-6 flow-root">
                <ul role="list" class="-mb-8">

                <li>
                    <div class="relative pb-2">
                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                    <div class="relative flex space-x-3">
                        <div>
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Friendly to Cats: <a href="#" class="font-medium text-gray-900">{{ $animal->cats_friendly == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Friendly to Dogs: <a href="#" class="font-medium text-gray-900">{{ $animal->dogs_friendly == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Friendly to Kids: <a href="#" class="font-medium text-gray-900">{{ $animal->kids_friendly == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Well Behaved: <a href="#" class="font-medium text-gray-900">{{ $animal->well_behaved == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Playful: <a href="#" class="font-medium text-gray-900">{{ $animal->playful == 1 ? "Yes" : "No" }}</a></p>
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
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Everybody Friendly: <a href="#" class="font-medium text-gray-900">{{ $animal->everybody_friendly == 1 ? "Yes" : "No" }}</a></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </li>


                <li>
                    <div class="relative pb-6">

                    <div class="relative flex space-x-3">
                        <div>
                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Affectionate: <a href="#" class="font-medium text-gray-900">{{ $animal->affectionate == 1 ? "Yes" : "No" }}</a></p>
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


