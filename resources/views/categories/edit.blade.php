<x-app-layout>
    <div class="max-w-xl mx-auto animate-slide-up">

        <h1 class="font-display text-3xl mb-8 tracking-wide">
            Редагувати категорію
        </h1>

        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-semibold">Назва</label>
                <input type="text" name="name" value="{{ $category->name }}"
                       class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2"
                       required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Опис</label>
                <textarea name="description" rows="3"
                          class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2">{{ $category->description }}</textarea>
            </div>

            <button class="px-6 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent transition">
                Оновити
            </button>
        </form>
    </div>
</x-app-layout>
