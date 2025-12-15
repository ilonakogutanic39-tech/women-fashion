<x-app-layout>
    <div class="animate-fade-in max-w-4xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- фото --}}
            <div>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-full h-[550px] object-cover shadow-lg">
                @else
                    <div class="w-full h-[550px] bg-gray-300"></div>
                @endif
            </div>

            {{-- опис + moodboard --}}
            <div>
                <h1 class="font-display text-4xl mb-4 tracking-wide">
                    {{ $product->name }}
                </h1>

                <p class="text-moda-accent text-2xl font-semibold mb-6">
                    {{ number_format($product->price, 2) }} грн
                </p>

                <p class="font-serif text-gray-700 mb-6 leading-relaxed">
                    {{ $product->description }}
                </p>

                <a href="{{ route('products.index') }}"
                   class="px-6 py-3 bg-moda-black text-moda-cream hover:bg-moda-accent transition inline-block mb-10">
                    Повернутися до каталогу
                </a>

                {{-- moodboard блок тільки для авторизованих --}}
                @auth
                    @if (session('status') === 'product-added-to-moodboard')
                        <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-200 px-3 py-2 font-serif">
                            Товар додано до moodboard.
                        </div>
                    @endif

                    <div class="border-t border-moda-black/20 pt-6 mt-4">
                        <h2 class="font-serif text-lg mb-4">
                            Додати до moodboard
                        </h2>

                        <form method="POST"
                              action="{{ route('moodboards.addFromProduct', $product) }}"
                              class="space-y-4">
                            @csrf

                            @if($moodboards->count())
                                <div>
                                    <label class="block text-xs tracking-[0.2em] mb-2 uppercase">
                                        обрати існуючий
                                    </label>
                                    <select name="moodboard_id"
                                            class="w-full bg-transparent border border-moda-black/40 px-3 py-2 text-sm focus:outline-none focus:border-moda-accent">
                                        <option value="">— не обрано —</option>
                                        @foreach($moodboards as $m)
                                            <option value="{{ $m->id }}">
                                                {{ $m->name }} ({{ $m->products_count ?? $m->products()->count() }} шт.)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div>
                                <label class="block text-xs tracking-[0.2em] mb-2 uppercase">
                                    або створити новий
                                </label>
                                <input type="text" name="new_moodboard_name"
                                       placeholder="назва moodboard"
                                       class="w-full bg-transparent border border-moda-black/40 px-3 py-2 text-sm focus:outline-none focus:border-moda-accent">
                            </div>

                            <button
                                class="px-5 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent text-xs tracking-[0.2em] uppercase">
                                зберегти в moodboard
                            </button>
                        </form>
                    </div>
                @endauth

            </div>

        </div>

    </div>
</x-app-layout>
