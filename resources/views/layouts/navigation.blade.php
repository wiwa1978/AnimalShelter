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
            
            
              
             

            {{--
             <a href="{{ route('home') }}" wire:navigate class="rounded-md bg-rose-900 px-3 py-2 text-xl font-medium text-white">Home</a>
              <a href="{{ route('home1') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Home1</a>
              <a href="{{ route('show-dogs') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white"> {{ ucfirst(__('animals_front.dogs'))}}</a>
              <a href="{{ route('show-cats') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.cats'))}}</a>
              <a href="{{ route('show-others') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.others'))}}</a>

            --}}
             
              <a wire:navigate class="{{ ( Route::currentRouteName() == 'home' ? 'bg-rose-900 text-white' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('home') }}">Home</a>
              <a wire:navigate class="{{ ( Route::currentRouteName() == 'home1' ? 'bg-rose-900 text-white' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('home1') }}">Zoek huisdier</a>
              <a wire:navigate class="{{ ( Route::currentRouteName() == 'show-dogs' ? 'bg-rose-900 text-white' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-dogs') }}">{{ ucfirst(__('animals_front.dogs')) }}</a>
              <a wire:navigate class="{{ ( Route::currentRouteName() == 'show-cats' ? 'bg-rose-900 text-white ' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-cats') }}">{{ ucfirst(__('animals_front.cats'))}}</a>
              <a wire:navigate class="{{ ( Route::currentRouteName() == 'show-others' ? 'bg-rose-900 text-white ' : '' )}} rounded-md text-rose-900 px-3 py-2 text-xl font-medium hover:bg-gray-700 hover:text-white" href="{{ route('show-others') }}">{{ ucfirst(__('animals_front.others'))}}</a>
             
             
           
          </div>
        </div>
      </div>
      <div class="hidden sm:ml-6 sm:block">
        <div class="flex items-center">
          {{-- <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
          </button> --}}
          <a href="{{ route('register') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Register</a>
          <a href="{{ route('login') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Login</a>
       
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
      <a href="{{ route('home') }}" wire:navigate class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Home</a>
      <a href="{{ route('home1') }}" wire:navigate class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Zoek huisdier</a>
      <a href="{{ route('show-dogs') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.dogs'))}}</a>
      <a href="{{ route('show-cats') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.cats'))}}</a>
      <a href="{{ route('show-others') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.others'))}}</a>
    </div>
  </div>
    <div class="sm:hidden" id="mobile-menu" x-show="open">
        <div class="space-y-1 px-2 pb-3 pt-2">
          <a href="{{ route('register') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Register</a>
          <a href="{{ route('login') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Login</a>
        </div>
  </div>

</nav>
