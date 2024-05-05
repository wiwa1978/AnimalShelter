
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-4xl text-center">
      <p class="mt-16 text-4xl font-bold tracking-tight text-rose-700 sm:text-5xl">{{ __('animals_front.priceinfo') }}</p>
    </div>
    <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600">{{ __('animals_front.priceinfo_subtitle') }}</p>

    <div x-data="{ selected: 'monthly' }">
    <div class="mt-16 flex justify-center" >
        <fieldset class="grid grid-cols-2 gap-x-1 rounded-full p-1 text-center text-xs font-semibold leading-5 ring-1 ring-inset ring-gray-200 mb-8 lg:mb-16 ">
            <legend class="sr-only">Payment frequency</legend>
            <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
            <label :class="{ 'bg-indigo-900 text-white': selected === 'monthly', 'text-gray-500': selected !== 'monthly' }" class="cursor-pointer rounded-full px-2.5 py-1">
                <input type="radio" name="frequency" value="monthly" x-model="selected" class="sr-only">
                <span>{{ __('animals_front.monthly') }}</span>
            </label>
            <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
            <label :class="{ 'bg-indigo-900 text-white': selected === 'yearly', 'text-gray-500': selected !== 'yearly' }" class="cursor-pointer rounded-full px-2.5 py-1">
                <input type="radio" name="frequency" value="yearly" x-model="selected" class="sr-only">
                <span>{{ __('animals_front.yearly') }}</span>
            </label>
        </fieldset>
    </div>

   
    <div class="w-full flex justify-center mb-12">

        <div class="flex flex-wrap lg:flex-nowrap gap-4 lg:gap-8">
            <div class="rounded-3xl p-8 ring-1 xl:p-10 ring-gray-200 lg:w-1/3">
                <h3 id="tier-freelancer" class="text-center text-lg font-semibold leading-8 text-indigo-900">{{ __('animals_front.package_bronze') }}</h3>
                <p class="mt-4 text-sm leading-6 text-gray-600">{{ __('animals_front.package_bronze_subtitle') }}</p>
                <p class="mt-6 justify-center flex items-baseline gap-x-1 ">
                <!-- Price, update based on frequency toggle state -->
                 <!-- <span class="text-4xl font-bold tracking-tight text-rose-700">$15</span>-->
                
                <span class="text-4xl font-bold tracking-tight text-rose-700" x-text="selected === 'monthly' ? '1' : '10'"></span>
                <!-- Payment frequency, update based on frequency toggle state -->
        
                <span class="text-sm font-semibold leading-6 text-rose-700" x-text="selected === 'monthly' ? 'EUR/{{ __('animals_front.month') }}' : 'EUR/{{ __('animals_front.year') }}'"></span>
                </p>
                @auth
                <a href= "{{ url('billing/organization', ['organization' => $organization->id]) }}" aria-describedby="tier-freelancer" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-900 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">{{ __('animals_front.subscribe_plan') }}</a>
                @else
                <a href="{{ route('register') }}" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-900 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">{{ __('animals_front.subscribe_plan') }}</a>
                @endauth
                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 xl:mt-10 text-gray-600">
                    <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Toegang voor 1 gebruiker
                    </li>
                    <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Mogelijkheid om 1 dier op de website te plaatsen
                    </li>
                </ul>
            </div>
            <div class="rounded-3xl p-8 ring-1 xl:p-10 ring-gray-200 lg:w-1/3">
                <h3 id="tier-startup" class="text-center text-lg font-semibold leading-8 text-indigo-900">{{ __('animals_front.package_silver') }}</h3>
                <p class="mt-4 text-sm leading-6 text-gray-600">{{ __('animals_front.package_silver_subtitle') }}</p>
                <p class="mt-6 justify-center flex items-baseline gap-x-1">
                <!-- Price, update based on frequency toggle state -->
                <span class="text-4xl font-bold tracking-tight text-rose-700" x-text="selected === 'monthly' ? '5' : '50'"></span>
                
                <!-- Payment frequency, update based on frequency toggle state -->
               
                <span class="text-sm font-semibold leading-6 text-rose-700" x-text="selected === 'monthly' ? 'EUR/{{ __('animals_front.month') }}' : 'EUR/{{ __('animals_front.year') }}'"></span>
                
                </p>
                <a href="#" aria-describedby="tier-startup" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-900 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">{{ __('animals_front.subscribe_plan') }}</a>
                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 xl:mt-10 text-gray-600">
                    <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Toegang voor 3 gebruikers
                    </li>
                    <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Mogelijkheid om 3 dieren op de website te plaatsen
                    </li>
                </ul>
            </div>

            <div class="rounded-3xl p-8 ring-1 xl:p-10 ring-gray-200 lg:w-1/3">
                <h3 id="tier-freelancer" class="text-center text-lg font-semibold leading-8 text-indigo-900">{{ __('animals_front.package_gold') }}</h3>
                <p class="mt-4 text-sm leading-6 text-gray-600">{{ __('animals_front.package_gold_subtitle') }}</p>
                <p class="mt-6 justify-center flex items-baseline gap-x-1 ">
                <!-- Price, update based on frequency toggle state -->
                 <!-- <span class="text-4xl font-bold tracking-tight text-rose-700">$15</span>-->
                
                <span class="text-4xl font-bold tracking-tight text-rose-700" x-text="selected === 'monthly' ? '15' : '150'"></span>
                <!-- Payment frequency, update based on frequency toggle state -->
        
                <span class="text-sm font-semibold leading-6 text-rose-700" x-text="selected === 'monthly' ? 'EUR/{{ __('animals_front.month') }}' : 'EUR/{{ __('animals_front.year') }}'"></span>
                </p>
                @auth
                <a href= "{{ url('billing/organization', ['organization' => $organization->id]) }}" aria-describedby="tier-freelancer" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-900 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">{{ __('animals_front.subscribe_plan') }}</a>
                @else
                <a href="{{ route('register') }}" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-900 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">{{ __('animals_front.subscribe_plan') }}</a>
                @endauth
                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 xl:mt-10 text-gray-600">
                    <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Toegang voor onbeperkt aantal gebruikers
                    </li>
                    <li class="flex gap-x-3">
                        <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                        Onbeperkte mogelijkheid om dieren op de website te plaatsen
                    </li>
                </ul>
            </div>
        
        </div>
    </div>
    </div>

  </div>

