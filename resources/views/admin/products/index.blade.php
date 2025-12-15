<x-app-layout>

<div class="max-w-6xl mx-auto py-16 px-6 text-moda-black">

    <h1 class="font-display text-4xl mb-8 tracking-wide">
        Управління товарами
    </h1>

    {{-- кнопка створення --}}
    <a href="{{ route('products.create') }}"
       class="px-6 py-3 bg-moda-black text-moda-cream hover:bg-moda-accent transition rounded-sm inline-block mb-8">
        ➕ Додати товар
    </a>

    {{-- повідомлення --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300 rounded-sm overflow-hidden">
        <thead class="bg-moda-gray/20">
            <tr class="text-left font-serif text-sm tracking-wider">
                <th class="px-4 py-3">Фото</th>
                <th class="px-4 py-3">Назва</th>
                <th class="px-4 py-3">Категорія</th>
                <th class="px-4 py-3">Ціна</th>
                <th class="px-4 py-3">Дії</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
                <tr class="border-t border-gray-200 hover:bg-moda-gray/10">

                    {{-- Фото --}}
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-16 h-16 object-cover rounded-sm shadow">
                    </td>

                    {{-- Назва --}}
                    <td class="px-4 py-3 font-semibold">
                        {{ $product->name }}
                    </td>

                    {{-- Категорія --}}
                    <td class="px-4 py-3">
                        {{ $product->category->name ?? '—' }}
                    </td>

                    {{-- Ціна --}}
                    <td class="px-4 py-3">
                        {{ number_format($product->price, 2) }} грн
                    </td>

                    {{-- Дії --}}
                    <td class="px-4 py-3 flex space-x-4">

                        {{-- Редагувати --}}
                        <a href="{{ route('products.edit', $product) }}"
                           class="text-blue-600 hover:text-blue-800 font-serif">
                            Редагувати
                        </a>

                        {{-- Видалити --}}
                        <form action="{{ route('products.destroy', $product) }}"
                              method="POST"
                              onsubmit="return confirm('Видалити товар?')">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 hover:text-red-800 font-serif">
                                Видалити
                            </button>
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-8">
        {{ $products->links() }}
    </div>

</div>

</x-app-layout>
