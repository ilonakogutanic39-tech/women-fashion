<x-app-layout>

    <div class="max-w-3xl mx-auto py-12 animate-fade-in">

        <h1 class="font-display text-4xl tracking-wide mb-8">
            Редагувати товар
        </h1>

        {{-- Повідомлення про помилки --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-600 border-l-4 border-red-500">
                <ul class="list-disc pl-6">
                    @foreach ($errors->all() as $error)
                        <li class="font-serif">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Назва --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Назва товару</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="w-full border-b border-moda-black bg-transparent py-2 focus:border-moda-accent focus:outline-none"
                       required>
            </div>

            {{-- Опис --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Опис</label>
                <textarea name="description" rows="4"
                          class="w-full border-b border-moda-black bg-transparent py-2 focus:border-mода-accent focus:outline-none">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Ціна --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Ціна (грн)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                       class="w-full border-b border-mода-black bg-transparent py-2 focus:border-мода-accent focus:outline-none"
                       required>
            </div>

            {{-- Категорія --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Категорія</label>
                <select name="category_id"
                        class="w-full border-b border-мода-black bg-transparent py-2 focus:border-мода-accent">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Фото --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Фото товару</label>

                {{-- Превʼю поточного фото --}}
                @if($product->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-52 h-52 object-cover shadow-md border border-gray-200">
                    </div>
                @endif

                <input type="file" name="image"
                       class="w-full border-b border-мода-black bg-transparent py-2 focus:outline-none">

                <p class="text-xs text-gray-600 mt-1 font-serif">
                    Якщо вибрати нове фото — старе буде замінено.
                </p>
            </div>

            {{-- Кнопка --}}
            <div class="pt-4">
                <button
                    class="px-8 py-3 bg-мода-black text-мода-cream hover:bg-мода-accent transition font-semibold tracking-wide">
                    Оновити товар
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
