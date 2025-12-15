<x-app-layout>
    <div class="max-w-5xl mx-auto py-12 px-6 lg:px-0 text-moda-black">

        <div class="mb-10">
            <p class="text-xs tracking-[0.3em] text-moda-accent mb-2">
                SHARED MOODBOARD
            </p>
            <h1 class="font-display text-3xl tracking-wide mb-2">
                {{ $moodboard->name }}
            </h1>
            <p class="text-xs text-gray-600 font-serif">
                {{ $moodboard->products->count() }} товар(ів) • створено {{ $moodboard->user->name }}
            </p>
        </div>

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
            @foreach($moodboard->products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="block break-inside-avoid group">
                    <div class="overflow-hidden rounded-sm shadow-md mb-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-64 bg-moda-gray"></div>
                        @endif
                    </div>

                    <h3 class="font-display text-xl mb-1 group-hover:text-moda-accent transition">
                        {{ $product->name }}
                    </h3>
                    <p class="font-serif text-gray-600 text-sm mb-1">
                        {{ Str::limit($product->description, 70) }}
                    </p>
                    <p class="text-sm tracking-wide">
                        {{ number_format($product->price, 2) }} грн
                    </p>
                </a>
            @endforeach
        </div>

    </div>
</x-app-layout>
