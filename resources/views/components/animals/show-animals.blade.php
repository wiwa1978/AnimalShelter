<main>
    <div>
        <div class="m-16 relative isolate pt-14">
            <div class="m-16 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">

                <div>
                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Location</label>
                    <select id="location" name="location" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option selected>Dogs</option>
                        <option>Cats</option>
                        <option>Other animals</option>
                    </select>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Location</label>
                    <select id="location" name="location" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option selected>Dogs</option>
                        <option>Cats</option>
                        <option>Other animals</option>
                    </select>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Age</label>
                    <select id="location" name="location" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option selected>Dogs</option>
                        <option>Cats</option>
                        <option>Other animals</option>
                    </select>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Naam</label>
                    <input type="text" name="search" placeholder="Search on name" id="search" class="mt-2 block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <ul role="list" class="m-16 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($animals_featured as $animal)

                <li class="relative">
                    <button type="button" wire:click="showAnimalDetail({{ $animal->id }})">
                        <div class="max-w-sm bg-white  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">

                                <img src="{{ $animal->photo_featured}}"  alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                            {{-- "https://images.unsplash.com/photo-1582053433976-25c00369fc93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=512&q=80" --}}
                            </div>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $animal->photo}}</h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>

                            </div>
                        </div>
                    </button>
                </li>

                @endforeach
            </ul>
        </div>


    </div>

</main>
