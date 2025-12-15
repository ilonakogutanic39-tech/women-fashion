<x-app-layout>

<div class="max-w-3xl mx-auto py-16 px-6 text-moda-black">

    {{-- Title --}}
    <h1 class="font-display text-4xl mb-8 tracking-wide">
        Профіль користувача
    </h1>

    {{-- Success Message --}}
    @if (session('status') === 'profile-updated')
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300">
            Дані профілю успішно оновлено.
        </div>
    @endif


    {{-- UPDATE PROFILE FORM --}}
    <section class="mb-16">

        <h2 class="font-serif text-xl mb-4">Особиста інформація</h2>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')

            {{-- Name --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Ім’я</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border-b border-gray-400 bg-transparent py-2
                              focus:border-moda-accent focus:outline-none">
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border-b border-gray-400 bg-transparent py-2
                              focus:border-moda-accent focus:outline-none">
            </div>

            {{-- Save Button --}}
            <div>
                <button
                    class="px-6 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent transition tracking-wide">
                    Зберегти зміни
                </button>
            </div>

        </form>
    </section>



    {{-- UPDATE PASSWORD --}}
    <section class="mb-16">

        <h2 class="font-serif text-xl mb-4">Змінити пароль</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            {{-- Current --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Поточний пароль</label>
                <input type="password" name="current_password"
                       class="w-full border-b border-gray-400 bg-transparent py-2
                              focus:border-moda-accent focus:outline-none">
            </div>

            {{-- New password --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Новий пароль</label>
                <input type="password" name="password"
                       class="w-full border-b border-gray-400 bg-transparent py-2
                              focus:border-moda-accent focus:outline-none">
            </div>

            {{-- Confirm --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Підтвердження пароля</label>
                <input type="password" name="password_confirmation"
                       class="w-full border-b border-gray-400 bg-transparent py-2
                              focus:border-moda-accent focus:outline-none">
            </div>

            <button
                class="px-6 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent transition tracking-wide">
                Оновити пароль
            </button>

        </form>

    </section>



    {{-- DELETE ACCOUNT --}}
    <section class="pb-12">

        <h2 class="font-serif text-xl mb-4 text-red-600">Видалення акаунту</h2>

        <p class="text-gray-600 mb-6 max-w-md font-serif">
            Після видалення обліковий запис буде втрачено назавжди.
        </p>

<form method="POST" action="{{ route('profile.destroy') }}"
      onsubmit="return confirm('Ви впевнені, що хочете видалити акаунт?')">

    @csrf
    @method('DELETE')

    <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Підтвердіть пароль</label>
        <input type="password" name="password"
               class="w-full border-b border-gray-400 bg-transparent py-2
                      focus:border-moda-accent focus:outline-none">
    </div>

    <button
        class="px-6 py-2 bg-red-600 text-white hover:bg-red-700 transition tracking-wide">
        Видалити акаунт
    </button>

</form>


    </section>

</div>

</x-app-layout>
