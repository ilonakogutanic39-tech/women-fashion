<x-app-layout>

<div class="bg-moda-cream text-moda-black">

    {{-- HERO SECTION --}}
    <section class="w-full py-20 px-6 lg:px-24 animate-fade-in">

        <p class="text-xs tracking-widest text-moda-accent mb-4">
            AUTUMN / WINTER 2025
        </p>

        <h1 class="font-display text-6xl md:text-7xl tracking-wide mb-4">
            STRUCTURAL
        </h1>

        <h2 class="font-serif italic text-5xl md:text-6xl text-gray-500 mb-10">
            DISSONANCE
        </h2>

        <div class="border-l-2 border-moda-accent pl-6 max-w-xl text-gray-700 font-serif leading-relaxed">
            Exploring the space between rigidity and fluidity.  
            Our latest collection challenges traditional silhouettes  
            through asymmetric tailoring and organic textures.
        </div>

    </section>



    {{-- SEARCH + FILTER --}}
{{-- SEARCH + FILTER --}}
<section x-data="{ openFilter: false }" class="px-6 lg:px-24 mb-12">

    <div class="flex justify-between items-center">

        <p class="text-xs tracking-widest text-gray-500">
            SHOWING {{ $products->count() }} / {{ $products->total() }}
        </p>

        <div class="flex items-center space-x-6">

            {{-- Search --}}
            <form action="{{ route('products.index') }}" method="GET">
                <input name="search" value="{{ request('search') }}" placeholder="SEARCH"
                       class="bg-transparent border-b border-gray-400 focus:border-moda-accent
                              outline-none text-sm tracking-widest px-1 py-1" />
            </form>

            {{-- Filter button --}}
            <button @click="openFilter = !openFilter"
                    class="flex items-center space-x-2 text-sm tracking-widest hover:text-moda-accent">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 4h18M6 12h12M10 20h4" />
                </svg>
                <span>FILTER</span>
            </button>

        </div>

    </div>

    {{-- FILTER PANEL --}}
    <div x-show="openFilter" 
         x-transition
         class="mt-6 p-6 border border-gray-300 bg-white shadow-md">

        <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Category --}}
            <div>
                <label class="text-xs tracking-widest text-gray-500 mb-2 block">CATEGORY</label>
                <select name="category"
                        class="w-full border-b bg-transparent border-gray-400 focus:border-moda-accent py-1 outline-none">
                    <option value="">All</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" 
                            {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Price From --}}
            <div>
                <label class="text-xs tracking-widest text-gray-500 mb-2 block">PRICE FROM</label>
                <input type="number" name="price_from" value="{{ request('price_from') }}"
                       class="w-full border-b bg-transparent border-gray-400 focus:border-moda-accent py-1 outline-none" />
            </div>

            {{-- Price To --}}
            <div>
                <label class="text-xs tracking-widest text-gray-500 mb-2 block">PRICE TO</label>
                <input type="number" name="price_to" value="{{ request('price_to') }}"
                       class="w-full border-b bg-transparent border-gray-400 focus:border-moda-accent py-1 outline-none" />
            </div>

            {{-- Buttons --}}
            <div class="col-span-full flex justify-end space-x-4 pt-4">
                <a href="{{ route('products.index') }}"
                   class="px-6 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    RESET
                </a>
                <button class="px-6 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent transition">
                    APPLY
                </button>
            </div>

        </form>

    </div>

</section>




    {{-- PRODUCTS MASONRY GRID --}}
    <section class="px-6 lg:px-24 pb-20">

        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">

            @foreach ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="block group break-inside-avoid animate-slide-up">

                    {{-- Image --}}
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-full object-cover rounded-sm shadow-md mb-4 transition
                                group-hover:opacity-90" />

                    {{-- Title --}}
                    <h3 class="font-display text-2xl mb-1 group-hover:text-moda-accent transition">
                        {{ $product->name }}
                    </h3>

                    {{-- Short description --}}
                    <p class="font-serif text-gray-600 text-sm mb-2">
                        {{ Str::limit($product->description, 80) }}
                    </p>

                    {{-- Price --}}
                    <p class="tracking-wide text-sm">{{ $product->price }} грн</p>

                </a>
            @endforeach

        </div>

        <div class="mt-10">
            {{ $products->withQueryString()->links() }}
        </div>

    </section>

</div>

</x-app-layout>
