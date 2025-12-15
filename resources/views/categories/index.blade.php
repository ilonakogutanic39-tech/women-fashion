<x-app-layout>
    <div class="animate-fade-in">

        <h1 class="font-display text-4xl mb-8 tracking-wide">
            Категорії
        </h1>

        <!-- success message -->
        @if (session('success'))
            <div class="mb-4 p-3 bg-moda-gray text-moda-black">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <p class="font-serif text-gray-700">Управління категоріями магазину</p>

            <a href="{{ route('categories.create') }}"
               class="px-5 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent transition">
                Додати категорію
            </a>
        </div>

        <table class="w-full border-collapse text-left">
            <thead class="border-b border-moda-black">
                <tr>
                    <th class="py-3">Назва</th>
                    <th class="py-3">Опис</th>
                    <th class="py-3 w-40">Дії</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr class="border-b border-moda-gray">
                        <td class="py-3">{{ $category->name }}</td>
                        <td class="py-3 text-gray-600">{{ $category->description }}</td>
                        <td class="py-3 flex space-x-3">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="text-moda-black underline hover:text-moda-accent">
                                Редагувати
                            </a>

                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Видалити категорію?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-moda-accent underline hover:text-moda-black">
                                    Видалити
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
