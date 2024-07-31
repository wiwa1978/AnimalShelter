<nav x-data="{ open: false }" class="relative bg-gray-50 navbar z-50">
<div class="relative bg-white shadow">
  <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <!-- <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=rose&shade=800" alt="Your Company">-->
          <img class="h-16 w-auto" src="{{ asset('storage/images/icon_logo.svg')}}" alt="Lief Dier - Lief Thuis">
          
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            
            
              <a wire:click="$refresh" wire:navigate class="rounded-md text-rose-700 px-3 py-2 text-xl font-medium hover:bg-rose-700 hover:text-white" href="{{ route('home') }}">Home</a>
              

               <!-- dropdown -->
              <div class="relative ml-5 flex-shrink-0">
                <div class="x-data='{ open: false }'" @click.away="open = false">
                  <button @click="open = !open" type="button" class="rounded-md text-rose-700 px-3 py-2 text-xl font-medium hover:bg-rose-700 hover:text-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    {{ __('animals_front.our_animals') }}
                  </button>
                </div>

                <div x-show="open" class="absolute right-0 z-10 mt-2 w-64 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <!-- Active: "bg-gray-100", Not Active: "" -->
                  <a wire:click="$refresh" wire:navigate href="{{ route('search-animal') }}" class="block px-4 py-2 text-base text-rose-700 rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-0">{{ __('animals_front.all_animals') }}</a>
                  <hr class="my-2">
                  <a wire:click="$refresh" wire:navigate href="{{ route('show-dogs') }}" class="block px-4 py-2 text-base text-rose-700 rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-1">{{ ucfirst(__('animals_front.all_dogs')) }}</a>
                  <a wire:click="$refresh" wire:navigate href="{{ route('show-featured-dogs') }}" class="block px-4 py-2 text-base text-rose-700 rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-1">{{ ucfirst(__('animals_front.dogs_in_picture')) }}</a>
                  <hr class="my-2">
                  <a wire:click="$refresh" wire:navigate href="{{ route('show-cats') }}" class="block px-4 py-2 text-base text-rose-700  rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-2">{{ ucfirst(__('animals_front.all_cats')) }}</a>
                  <a wire:click="$refresh" wire:navigate href="{{ route('show-featured-cats') }}" class=" block px-4 py-2 text-base text-rose-700  rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-3">{{ ucfirst(__('animals_front.cats_in_picture')) }}</a>
                  <hr class="my-2">
                  <a wire:click="$refresh" wire:navigate href="{{ route('show-others') }}"   class="block px-4 py-2 text-base text-rose-700  rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-3">{{ ucfirst(__('animals_front.all_others')) }}</a>
                  <a wire:click="$refresh" wire:navigate href="{{ route('show-featured-others') }}" class="block px-4 py-2 text-base text-rose-700  rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-2">{{ ucfirst(__('animals_front.others_in_picture')) }}</a>
                  <hr class="my-2">
                  <a wire:click="$refresh" wire:navigate href="{{ route('show-animal-week') }}" class="block px-4 py-2 text-base text-rose-700  rounded font-medium hover:bg-rose-700 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-2">{{ ucfirst(__('animals_front.animal-week')) }}</a>
                </div>
              </div>

              <a wire:click="$refresh" wire:navigate class="rounded-md text-rose-700 px-3 py-2 text-xl font-medium hover:bg-rose-700 hover:text-white" href="#">{{ ucfirst(__('animals_front.our_way_working')) }}</a>
 

              
          
            </div>
        </div>
      </div>
      <div class="hidden sm:ml-6 sm:block">
        <div class="flex items-center">
          @auth
            <a href="{{ route('filament.app.tenant') }}" class="rounded-md px-3 py-2 text-xl font-medium text-rose-700 hover:bg-gray-700 hover:text-white">Dashboard</a>
        
            @else
            <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-xl font-medium text-rose-700 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.register')) }}</a>
            <a href="{{ route('login') }}"  class="rounded-md px-3 py-2 text-xl font-medium text-rose-700 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.login')) }}</a>
    
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
      <a href="{{ route('search-animal') }}" wire:click="$refresh" wire:navigate class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">{{ ucfirst(__('animals_front.all_animals'))}}</a>
      <hr class="my-2">
      <a href="{{ route('show-dogs') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white">{{ ucfirst(__('animals_front.dogs'))}}</a>
      <a href="{{ route('show-featured-dogs') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white" >{{ ucfirst(__('animals_front.dogs_in_picture')) }}</a>
      <hr class="my-2">
      <a href="{{ route('show-cats') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white">{{ ucfirst(__('animals_front.cats'))}}</a>
      <a href="{{ route('show-featured-cats') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white" >{{ ucfirst(__('animals_front.cats_in_picture')) }}</a>
      <hr class="my-2">
      <a href="{{ route('show-others') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white">{{ ucfirst(__('animals_front.others'))}}</a>
      <a href="{{ route('show-featured-others') }}" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white" >{{ ucfirst(__('animals_front.others_in_picture')) }}</a>
      <a href="#" wire:click="$refresh" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white">{{ ucfirst(__('animals_front.our_way_working')) }}</a>
      <hr class="my-2">
      <a wire:click="$refresh" wire:navigate href="{{ route('show-animal-week') }}" class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-900 hover:text-white">{{ ucfirst(__('animals_front.animal-week')) }}</a>


    

    </div>
  </div>
    <div class="sm:hidden" id="mobile-menu" x-show="open">
        <div class="space-y-1 px-2 pb-3 pt-2">
          
          <a href="{{ route('register') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.register')) }}</a>
          <a href="{{ route('login') }}" wire:navigate class="block rounded-md px-3 py-2 text-base font-medium text-rose-700 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.login')) }}</a>
        
        </div>
  </div>
              </div>
</nav>