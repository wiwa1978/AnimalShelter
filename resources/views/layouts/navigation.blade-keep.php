<nav class="bg-white">
  <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=rose&shade=800" alt="Your Company">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <a href="{{ route('products') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Products</a>
            <a href="{{ route('show-animals') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Animals</a>
          
            <a href="{{ route('home') }}" wire:navigate class="rounded-md bg-rose-900 px-3 py-2 text-xl font-medium text-white">Home</a>
            <a href="{{ route('home1') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">Home1</a>
            <a href="{{ route('show-dogs') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white"> {{ ucfirst(__('animals_front.dogs'))}}</a>
            <a href="{{ route('show-cats') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.cats'))}}</a>
            <a href="{{ route('show-others') }}" wire:navigate class="rounded-md px-3 py-2 text-xl font-medium text-rose-900 hover:bg-gray-700 hover:text-white">{{ ucfirst(__('animals_front.others'))}}</a>
          
          </div>
        </div>
      </div>
    </div>
  </div>

</nav>
