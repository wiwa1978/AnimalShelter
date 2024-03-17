
<div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-16">
      <h2 class="text-4xl text-rose-900 font-bold ">{{ $animal->name}} </h2>

      

      <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
        @foreach($photos as $photo)
        <div class="group relative">
         
            <div class="relative overflow-hidden rounded-lg ">
                <img src="{{ $photo }}" alt="Photo from {{ $animal->name}}" class="h-full w-full object-cover object-center">
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
                @auth
                <livewire:animals.favorite-button :animal="$animal" :key="$animal->id"/>
                @endauth
            
                @if ( $isAnimalBelongsToShelter)
                    <h2 class="text-xl font-medium leading-6 text-indigo-900">Asiel</h2>
                @else
                    <h2 class="text-xl font-medium leading-6 text-indigo-900">Particulier</h2>
                @endif
            </div>

            
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <dl class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-5">
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-indigo-900">Huidig verblijf</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->current_location}}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-indigo-900">Oorsprong</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->original_location}}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-indigo-900">Leeftijd</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->age}}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-indigo-900">Geslacht</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->gender}}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-indigo-900">Ras</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $animal->breed}}</dd>
                </div>
         
              </dl>
            </div>
          </div>
        </section>


                <!-- Thuissituatie Section -->
                <section aria-labelledby="applicant-information-title">
                    <div class="border border-gray-200 bg-white shadow sm:rounded-lg">
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <dt class="mb-6 text-sm font-medium text-indigo-900">Thuissituatie</dt>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-1 sm:grid-cols-2">
                                <div>
                                    <div class="relative">
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <div>
                                                    <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                                        <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">Omgeving met kinderen: {{ $animal->current_kids == 1 ? "Ja" : "Nee" }}</p>
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
                                                    <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                                        <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">Omgeving met honden: {{ $animal->current_dogs == 1 ? "Ja" : "Nee" }}</p>
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
                                                    <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                                        <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">Omgeving met katten: {{ $animal->current_cats == 1 ? "Ja" : "Nee" }}</p>
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
                                                    <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                                        <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">Soms alleen thuis: {{ $animal->current_home_alone == 1 ? "Ja" : "Nee" }}</p>
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
                                                    <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                                        <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">Tuin: {{ $animal->current_garden == 1 ? "Ja" : "Nee" }}</p>
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
                  <dt class="text-sm font-medium text-indigo-900">Description</dt>
                    <div class="prose mt-1 text-sm text-gray-900">
                        <x-markdown>
                            {{ $animal->description }}
                        </x-markdown>
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
                  <dt class="text-sm font-medium text-indigo-900">Environment</dt>
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
        @if ( $animal->status->getLabel() === 'Gereserveerd')
        <section  class=" lg:col-span-1 lg:col-start-3">
            <div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6 text-center">
                <h2 class="text-lg font-medium text-indigo-900 text-center">Deze {{ strtolower($animal->animal_type->getLabel()) }} is momenteel gereserveerd</h2>
                
      
            </div>
        </section>

       

        @else
        <section  class=" lg:col-span-1 lg:col-start-3">
            <div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6 text-center">
             @if ($animal->animal_type->getLabel() === 'Hond' or $animal->animal_type->getLabel() === 'Kat')
                <span class="text-lg text-gray-800 text-center">Deze {{ strtolower($animal->animal_type->getLabel()) }} is </span><span class="text-lg text-rose-900 text-center">beschikbaar</span> <span class="text-lg text-gray-800 text-center">voor adoptie en staat al </span><span class="text-lg text-rose-900 text-center"> {{$days_adoptable}} dagen</span><span class="text-lg text-gray-800 text-center">  op deze site.</span>
                <span class="text-lg text-gray-800 text-center">Contacteer </span><span class="text-lg text-rose-900 text-center">{{ $organization->name}} </span><span class="text-lg text-gray-800 text-center">voor meer informatie</span>
             @else
                <span class="text-lg text-gray-800 text-center">Dit huisdier is nog </span><span class="text-lg text-rose-900 text-center">beschikbaar</span> <span class="text-lg text-gray-800 text-center">voor adoptie en staat al </span><span class="text-lg text-rose-900 text-center"> {{$days_adoptable}} dagen</span><span class="text-lg text-gray-800 text-center">  op deze site.</span>
                <span class="text-lg text-gray-800 text-center">Contacteer </span><span class="text-lg text-rose-900 text-center">{{ $organization->name}} </span><span class="text-lg text-gray-800 text-center">voor meer informatie</span>
             @endif
               
    
            </div>
        </section>
        @endif
        

        <section  class=" lg:col-span-1 lg:col-start-3">
            <div class="grid grid-cols-2 gap-3 border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6 text-center">
                <div>

                    <button type="button" class="inline-flex items-center gap-x-2 rounded-md bg-rose-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        Contacteer ons
                    </button>
                </div>
                <div>
                    <button wire:click="viewAnimalsByOrganization({{ $animal->organization_id }})" type="button" class="inline-flex items-center gap-x-2 rounded-md bg-indigo-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                        Bekijk al onze dieren
                    </button>
                </div>

        </section>


        <section  class=" lg:col-span-1 lg:col-start-3">
            <div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6 ">
                <h2 id="timeline-title" class="text-lg font-medium text-rose-900">{{ __('animals_front.contact_info')}}</h2>
                <div>
                    <div class="mt-6 mb-6 flow-root justify-center">
                    <ul role="list" class="-mb-8">
                        <li>
                            <div class="relative flex pb-1 space-x-3">
                                <div>
                                
                                @if ($isAnimalBelongsToShelter)
                                    <span class="font-medium text-sm text-indigo-900">Verblijf (asiel): </span><span class="text-sm text-gray-500"">{{ $organization->shelter_name }}</span>                                    
                                @else
                                    <span class="font-medium text-sm text-indigo-900"> Verblijf (particulier): </span><span class="text-sm text-gray-500"">{{ $organization->name }}</span>      
                                @endif

                                 
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="relative flex pb-1 space-x-3">
                                <div>
                                    <span class="font-medium text-sm text-indigo-900">Telefoon: </span><span class="text-sm text-gray-500"">{{ $organization->phone }}</span>     
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="relative flex pb-1 space-x-3">
                                <div>
                                    <span class="font-medium text-sm text-indigo-900">Email: </span><span class="text-sm text-gray-500"">{{ $organization->email }}</span>     
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="relative flex pb-1 space-x-3">
                                <div>
                                    <p class="font-medium text-sm text-indigo-900">Adres:</p>
                                    <p class="ml-6 text-sm text-gray-500">{{ $organization->streetname }} {{ $organization->streetnumber }}</p>
                                    <p class="ml-6 text-sm text-gray-500">{{ $organization->zipcode }} {{ $organization->city }}</p>
                                    <p class="ml-6 text-sm text-gray-500">{{ $organization->country }}</p>
                                </div>
                            </div>
                        </li>
                        @if ($organization->shelter_website)
                        <li>
                            <div class="relative flex pb-1 space-x-3">
                                <div>
                                    <span class="font-medium text-sm text-indigo-900">Website: </span><span class="text-sm text-gray-500""><a href="{{ $organization->shelter_website }}">{{ $organization->shelter_website }}</a> </span>     
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                    </div>
                </div>
        </section>


        <!-- Medical Information -->
        <section aria-labelledby="timeline-title" class="lg:col-span-1 lg:col-start-3">
            <div class="border border-gray-200 bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-rose-900">{{ __('animals_front.medical_info')}}</h2>

            <!-- Activity Feed -->
            <div class="mt-6 flow-root">
                <ul role="list" class="-mb-8">
                <li>
                    <div class="relative pb-2">

                    <div class="relative flex space-x-3">
                        <div>
                        <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                            <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Sterilized: <a href="#" class="font-medium text-gray-900"> {{ $animal->sterilized == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Chipped: <a href="#" class="font-medium text-gray-900"> {{ $animal->chipped == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Vaccinated: <a href="#" class="font-medium text-gray-900"> {{ $animal->vaccinated == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Rabies: <a href="#" class="font-medium text-gray-900"> {{ $animal->rabies == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Medicins: <a href="#" class="font-medium text-gray-900"> {{ $animal->medicins == 1 ? "Ja" : "Nee" }}</a></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </li>

                <li>
                    <div class="relative pb-6">

                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Special Food: <a href="#" class="font-medium text-gray-900"> {{ $animal->special_food== 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Friendly to Cats: <a href="#" class="font-medium text-gray-900">{{ $animal->cats_friendly == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Friendly to Dogs: <a href="#" class="font-medium text-gray-900">{{ $animal->dogs_friendly == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Friendly to Kids < 6 years: <a href="#" class="font-medium text-gray-900">{{ $animal->kids_friendly_6y == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Friendly to Kids < 14 years: <a href="#" class="font-medium text-gray-900">{{ $animal->kids_friendly_14y == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Needs garden: <a href="#" class="font-medium text-gray-900">{{ $animal->needs_garden == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Potty Trained: <a href="#" class="font-medium text-gray-900">{{ $animal->potty_trained == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Car Friendly: <a href="#" class="font-medium text-gray-900">{{ $animal->car_friendly == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Can stay alone at home <a href="#" class="font-medium text-gray-900">{{ $animal->home_alone == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Knows basic commands: <a href="#" class="font-medium text-gray-900">{{ $animal->knows_commands == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Experience required with breed: <a href="#" class="font-medium text-gray-900">{{ $animal->experience_required == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Well Behaved: <a href="#" class="font-medium text-gray-900">{{ $animal->well_behaved == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Playful: <a href="#" class="font-medium text-gray-900">{{ $animal->playful == 1 ? "Ja" : "Nee" }}</a></p>
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
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Everybody Friendly: <a href="#" class="font-medium text-gray-900">{{ $animal->everybody_friendly == 1 ? "Ja" : "Nee" }}</a></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </li>


                <li>
                    <div class="relative pb-6">

                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full  flex items-center justify-center ring-8 ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-rose-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                        <div>
                            <p class="text-sm text-gray-500">Affectionate: <a href="#" class="font-medium text-gray-900">{{ $animal->affectionate == 1 ? "Ja" : "Nee" }}</a></p>
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


