<x-app-layout>
    <div class="max-w-2xl mx-auto animate-slide-up">

        <h1 class="font-display text-3xl mb-8 tracking-wide">
            Додати товар
        </h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-1 font-semibold">Назва</label>
                <input type="text" name="name"
                       class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent py-2"
                       required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Опис</label>
                <textarea name="description" rows="4"
                          class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent py-2"></textarea>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Ціна</label>
                <input type="number" step="0.01" name="price"
                       class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent py-2"
                       required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Категорія</label>
                <select name="category_id"
                        class="w-full border-b border-moda-black bg-transparent py-2 focus:border-moda-accent">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Фото товару</label>
                <input type="file" name="image"
                       class="w-full border-b border-moda-black py-2">
            </div>

            <button class="px-6 py-2 bg-mода-black text-mода-cream hover:bg-mода-accent transition">
                Додати
            </button>

        </form>
    </div>
</x-app-layout>
