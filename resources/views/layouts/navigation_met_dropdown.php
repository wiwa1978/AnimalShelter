<nav x-data="{ open: false }" class="bg-white">
  <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=rose&shade=800" alt="Your Company">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            
            
              <a wire:click="$refresh" wire:navigate class="{{ ( Route::currentRouteName() == 'home' ? 'bg-rose-900 text-white' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('home') }}">Home</a>
              <a wire:click="$refresh" wire:navigate class="{{ ( Route::currentRouteName() == 'home1' ? 'bg-rose-900 text-white' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('home1') }}">Zoek huisdier</a>
              <a wire:click="$refresh" wire:navigate class="{{ ( Route::currentRouteName() == 'show-dogs' ? 'bg-rose-900 text-white' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-dogs') }}">{{ ucfirst(__('animals_front.dogs')) }}</a>
              <a wire:click="$refresh" wire:navigate class="{{ ( Route::currentRouteName() == 'show-cats' ? 'bg-rose-900 text-white ' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-cats') }}">{{ ucfirst(__('animals_front.cats'))}}</a>
              <a wire:click="$refresh" wire:navigate class="{{ ( Route::currentRouteName() == 'show-others' ? 'bg-rose-900 text-white ' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-others') }}">{{ ucfirst(__('animals_front.others'))}}</a>
          
          
              <div x-data="{ open: false } class="relative">
  <button @click="open = !open" type="button" class="rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white inline-flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900" aria-expanded="false">
    <span>Solutions</span>
    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
    </svg>
  </button>

  <div x-show="open"  class="absolute left-1/2 z-10 mt-5 flex w-screen max-w-max -translate-x-1/2 px-4">
    <div class="w-screen max-w-md flex-auto overflow-hidden rounded-3xl bg-white text-sm leading-6 shadow-lg ring-1 ring-gray-900/5">
      <div class="p-4">
        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
          <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
            <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
            </svg>
          </div>
          <div>
            <a wire:click="$refresh" wire:navigate class="rounded-md text-rose-900 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-dogs') }}">Hond
              <span class="absolute inset-0"></span>
            </a>
            <p class="mt-1 text-gray-600">Adopteer een hond van een particulier of uit een asiel</p>
          </div>
        </div>
        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
          <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
            <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
            </svg>
          </div>
          <div>
            <a wire:click="$refresh" wire:navigate class="rounded-md text-rose-900 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-dogs') }}">Katten
              <span class="absolute inset-0"></span>
            </a>
            <p class="mt-1 text-gray-600">dopteer een kat van een particulier of uit een asiel</p>
          </div>
        </div>
        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
          <div class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
            <svg class="h-6 w-6 text-gray-600 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33" />
            </svg>
          </div>
          <div>
          <a wire:click="$refresh" wire:navigate class="rounded-md text-rose-900 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-dogs') }}">Andere dieren
              <span class="absolute inset-0"></span>
            </a>
            <p class="mt-1 text-gray-600">Zoek een konijn</p>
          </div>
        </div>
        </div>

      </div>
  
    </div>
  </div>
</div>
          
          
          
          
          
          </div>
        </div>
      </div>




      
      <div class="hidden sm:ml-6 sm:block">
        <div class="flex items-center">
          @auth
            <a href="{{ route('filament.app-ind.pages.dashboard') }}" class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Dashboard</a>
        
            @else
            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Register</a>
            <a href="{{ route('login') }}"  class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Login</a>
    
          @endauth
        </div>



      </div>
      <div class="-mr-2 flex sm:hidden">
        <!-- Mobile menu button -->
        <button type="button" aria-controls="mobile-menu" @click="open = !open" aria-expanded="true" x-bind:aria-expanded="open.toString()" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg x-state:on="Menu open" x-state:off="Menu closed" class="hidden h-6 w-6" :class="{ 'hidden': open, 'block': !(open) }"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="block h-6 w-6" :class="{ 'block': open, 'hidden': !(open) }"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu" x-show="open">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="{{ route('home') }}" wire:click="$refresh" wire:navigate class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Home</a>
      <a href="{{ route('home1') }}" wire:click="$refresh" wire:navigate class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Zoek huisdier</a>
      <a href="{{ route('show-dogs') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.dogs'))}}</a>
      <a href="{{ route('show-cats') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.cats'))}}</a>
      <a href="{{ route('show-others') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.others'))}}</a>
      
    </div>
  </div>
    <div class="sm:hidden" id="mobile-menu" x-show="open">
        <div class="space-y-1 px-2 pb-3 pt-2">
          
          <a href="{{ route('register') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Register</a>
          <a href="{{ route('login') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Login</a>
        
        </div>
  </div>

  



</nav>