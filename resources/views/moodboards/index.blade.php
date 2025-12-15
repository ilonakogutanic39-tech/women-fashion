<x-app-layout>
    <div class="max-w-5xl mx-auto py-12 px-6 lg:px-0 text-moda-black">

        <div class="flex items-center justify-between mb-10">
            <div>
                <p class="text-xs tracking-[0.3em] text-moda-accent mb-2">
                    PERSONAL MOODBOARDS
                </p>
                <h1 class="font-display text-3xl tracking-wide">
                    Мої moodboard-и
                </h1>
            </div>
        </div>

        {{-- створення --}}
        <div class="mb-10 border border-moda-black/15 p-5 bg-moda-cream/60">
            <form method="POST" action="{{ route('moodboards.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                @csrf

                <div class="md:col-span-2">
                    <label class="block text-xs tracking-[0.2em] mb-2 uppercase">
                        назва нового moodboard
                    </label>
                    <input type="text" name="name"
                           class="w-full border-b border-moda-black bg-transparent py-2 text-sm focus:outline-none focus:border-moda-accent"
                           placeholder="напр. “вечірні образи”" required>
                </div>

                <div class="flex items-center space-x-2 mb-3 md:mb-0">
                    <input type="checkbox" name="is_public" value="1"
                           class="h-4 w-4 border-gray-400 rounded focus:ring-moda-accent">
                    <span class="text-xs font-serif text-gray-700">
                        зробити публічним
                    </span>
                </div>

                <button
                    class="md:col-span-3 md:w-auto px-6 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent text-xs tracking-[0.2em] uppercase transition">
                    створити
                </button>
            </form>
        </div>

        {{-- список --}}
        @if($moodboards->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($moodboards as $moodboard)
                    <div class="border border-moda-black/10 bg-white p-4 flex flex-col justify-between">
                        <div>
                            <h2 class="font-display text-xl mb-2">
                                {{ $moodboard->name }}
                            </h2>
                            <p class="text-xs text-gray-600 mb-2 font-serif">
                                {{ $moodboard->products_count }} товар(ів)
                            </p>

                            <p class="text-xs mb-2">
                                статус:
                                @if($moodboard->is_public)
                                    <span class="text-green-700">публічний</span>
                                @else
                                    <span class="text-gray-700">приватний</span>
                                @endif
                            </p>

                            @if($moodboard->is_public)
                                <div class="mt-2">
                                    <p class="text-[11px] text-gray-500 mb-1">
                                        публічне посилання:
                                    </p>
                                    <input type="text" readonly
                                           value="{{ route('moodboards.public', $moodboard->share_token) }}"
                                           class="w-full text-[11px] border border-moda-black/20 px-2 py-1 bg-moda-cream/40">
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 flex items-center justify-between text-xs">
                            <a href="{{ route('moodboards.show', $moodboard) }}"
                               class="underline hover:text-moda-accent">
                                відкрити
                            </a>

                            <div class="flex items-center space-x-3">
                                <form method="POST" action="{{ route('moodboards.toggle', $moodboard) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="hover:text-moda-accent">
                                        @if($moodboard->is_public)
                                            зробити приватним
                                        @else
                                            зробити публічним
                                        @endif
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('moodboards.destroy', $moodboard) }}"
                                      onsubmit="return confirm('Видалити moodboard?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-700">
                                        видалити
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-600 font-serif">
                Ви ще не створили жодного moodboard. Додайте товар до moodboard зі сторінки товару.
            </p>
        @endif

    </div>
</x-app-layout>
