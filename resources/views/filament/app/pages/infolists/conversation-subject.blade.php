<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="text-red-900 text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl">
    Subject: {{ $getRecord()->subject }}
    </div>
</x-dynamic-component>
