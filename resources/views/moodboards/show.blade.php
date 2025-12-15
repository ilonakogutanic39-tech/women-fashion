<x-app-layout>
    <div class="max-w-6xl mx-auto py-16 px-6 lg:px-12 text-moda-black animate-fade-in">

        {{-- MOODBOARD HEADER --}}
        <div class="flex justify-between items-center mb-12">
            <div>
                <h1 class="font-display text-5xl tracking-wide mb-2">
                    {{ $moodboard->name }}
                </h1>

                <p class="font-serif text-gray-600">
                    {{ $moodboard->products->count() }} товар(ів)
                </p>
            </div>

            <div class="flex items-center space-x-4">

                {{-- PUBLIC LINK --}}
                @if($moodboard->is_public)
                    <a href="{{ route('moodboards.public', $moodboard->share_token) }}"
                       class="px-4 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent transition">
                        Поділитися
                    </a>
                @endif

                {{-- DELETE MOODBOARD --}}
                <form action="{{ route('moodboards.destroy', $moodboard) }}"
                      method="POST"
                      onsubmit="return confirm('Видалити цей moodboard?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 transition">
                        Видалити
                    </button>
                </form>
            </div>
        </div>



        {{-- PRODUCTS GRID (MASONRY STYLE) --}}
        @if($moodboard->products->count())

            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">

                @foreach($moodboard->products as $product)

                    <div class="break-inside-avoid group relative">

                        {{-- Remove button --}}
                        <form method="POST"
                              action="{{ route('moodboards.removeProduct', [$moodboard, $product]) }}"
                              class="absolute top-3 right-3 z-10">
                            @csrf
                            @method('DELETE')

                            <button class="bg-white/80 backdrop-blur px-2 py-1 text-xs
                                           border border-moda-black/30 hover:bg-moda-accent hover:text-white transition">
                                ×
                            </button>
                        </form>

                        {{-- Image --}}
                        <a href="{{ route('products.show', $product) }}">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-full rounded-sm shadow-md mb-4 group-hover:opacity-90 transition">
                        </a>

                        {{-- Title --}}
                        <h3 class="font-display text-xl mb-1 group-hover:text-moda-accent transition">
                            {{ $product->name }}
                        </h3>

                        {{-- Price --}}
                        <p class="tracking-wide">
                            {{ number_format($product->price, 2) }} грн
                        </p>

                    </div>

                @endforeach

            </div>

        @else
            <p class="font-serif text-gray-600 text-lg">
                Moodboard порожній. Додайте товари зі сторінки каталогу.
            </p>
        @endif

    </div>
</x-app-layout>
