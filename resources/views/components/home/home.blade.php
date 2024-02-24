
  <div class="mx-auto w-full m-16 px-6 lg:px-8">
    <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-56 lg:pt-48 xl:col-span-6">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <img class="h-11" src="https://tailwindui.com/img/logos/mark.svg?color=rose&shade=800" alt="Your Company">
        <div class="hidden sm:mt-32 sm:flex lg:mt-16">
          <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
            Anim aute id magna aliqua ad ad non deserunt sunt.
          </div>
        </div>
        <h1 class="mt-24 text-4xl font-bold tracking-tight text-gray-900 sm:mt-10 sm:text-6xl">Help find a home for our animals</h1>
        <p class="mt-6 text-lg leading-8 text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
        <div class="mt-10 flex items-center gap-x-6">
          <a href="{{ route('show-dogs') }}" class="rounded-md bg-rose-800 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search Dogs</a>
          <a href="{{ route('show-cats') }}" class="rounded-md bg-rose-800 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search Cats</a>
          <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span aria-hidden="true">→</span></a>
        </div>
      </div>
    </div>
    <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
      <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full" src="{{ asset('/storage/home/dog-home.jpg') }}" alt="">
    </div>

  </div>
