
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-4xl text-center">
      <p class="mt-16 text-4xl font-bold tracking-tight text-rose-900 sm:text-5xl">Prijsinformatie</p>
    </div>
    <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600">Distinctio et nulla eum soluta et neque labore quibusdam. Saepe et quasi iusto modi velit ut non voluptas in. Explicabo id ut laborum.</p>

    <div x-data="{ selected: 'monthly' }">
    <div class="mt-16 flex justify-center" >
        <fieldset class="grid grid-cols-2 gap-x-1 rounded-full p-1 text-center text-xs font-semibold leading-5 ring-1 ring-inset ring-gray-200">
            <legend class="sr-only">Payment frequency</legend>
            <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
            <label :class="{ 'bg-indigo-900 text-white': selected === 'monthly', 'text-gray-500': selected !== 'monthly' }" class="cursor-pointer rounded-full px-2.5 py-1">
                <input type="radio" name="frequency" value="monthly" x-model="selected" class="sr-only">
                <span>Maandelijks</span>
            </label>
            <!-- Checked: "bg-indigo-600 text-white", Not Checked: "text-gray-500" -->
            <label :class="{ 'bg-indigo-900 text-white': selected === 'yearly', 'text-gray-500': selected !== 'yearly' }" class="cursor-pointer rounded-full px-2.5 py-1">
                <input type="radio" name="frequency" value="yearly" x-model="selected" class="sr-only">
                <span>Jaarlijks</span>
            </label>
        </fieldset>
    </div>

   
    <div class="w-full flex justify-center mb-12">

        <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-2">
            <div class="rounded-3xl p-8 ring-1 xl:p-10 ring-gray-200">
                <h3 id="tier-freelancer" class="text-center text-lg font-semibold leading-8 text-indigo-900">Particulier</h3>
                <p class="mt-4 text-sm leading-6 text-gray-600">The essentials to provide your best work for clients.</p>
                <p class="mt-6 justify-center flex items-baseline gap-x-1 ">
                <!-- Price, update based on frequency toggle state -->
                 <!-- <span class="text-4xl font-bold tracking-tight text-rose-900">$15</span>-->
                
                <span class="text-4xl font-bold tracking-tight text-rose-900" x-text="selected === 'monthly' ? '15' : '150'"></span>
                <!-- Payment frequency, update based on frequency toggle state -->
        
                <span class="text-sm font-semibold leading-6 text-rose-900" x-text="selected === 'monthly' ? 'EUR/maand' : 'EUR/jaar'"></span>
                </p>
                <a href="#" aria-describedby="tier-freelancer" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-900 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">Inschrijven op dit plan</a>
                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 xl:mt-10 text-gray-600">
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    5 products
                </li>
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    Up to 1,000 subscribers
                </li>
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    Basic analytics
                </li>
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    48-hour support response time
                </li>
                </ul>
            </div>
            <div class="rounded-3xl p-8 ring-1 xl:p-10 ring-gray-200">
                <h3 id="tier-startup" class="text-center text-lg font-semibold leading-8 text-indigo-900">Stichting of Asiel</h3>
                <p class="mt-4 text-sm leading-6 text-gray-600">A plan that scales with your rapidly growing business.</p>
                <p class="mt-6 justify-center flex items-baseline gap-x-1">
                <!-- Price, update based on frequency toggle state -->
                <span class="text-4xl font-bold tracking-tight text-rose-900" x-text="selected === 'monthly' ? '30' : '300'"></span>
                
                <!-- Payment frequency, update based on frequency toggle state -->
               
                <span class="text-sm font-semibold leading-6 text-rose-900" x-text="selected === 'monthly' ? 'EUR/maand' : 'EUR/jaar'"></span>
                
                </p>
                <a href="#" aria-describedby="tier-startup" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-indigo-900 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-indigo-600">Inschrijven op dit plan</a>
                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 xl:mt-10 text-gray-600">
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    25 products
                </li>
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    Up to 10,000 subscribers
                </li>
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    Advanced analytics
                </li>
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    24-hour support response time
                </li>
                <li class="flex gap-x-3">
                    <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    Marketing automations
                </li>
                </ul>
            </div>
        
        </div>
    </div>
    </div>

  </div>

