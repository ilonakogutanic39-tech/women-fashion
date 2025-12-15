<x-guest-layout>
    <div class="w-full max-w-md mx-auto animate-fade-in">

        <h1 class="font-display text-4xl text-center mb-6 tracking-wide">
            Створення акаунту
        </h1>

        <p class="text-center text-sm text-gray-700 mb-10 font-serif">
            Заповніть форму, щоб приєднатися до магазину MODA
        </p>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm mb-1 font-semibold" for="name">Ваше ім’я</label>
                <input id="name" type="text" name="name"
                       class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2"
                       required autofocus autocomplete="name" />
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm mb-1 font-semibold" for="email">Email</label>
                <input id="email" type="email" name="email"
                       class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2"
                       required autocomplete="username" />
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm mb-1 font-semibold" for="password">Пароль</label>
                <input id="password" type="password" name="password"
                       class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2"
                       required autocomplete="new-password" />
            </div>

            <!-- Confirm -->
            <div>
                <label class="block text-sm mb-1 font-semibold" for="password_confirmation">Підтвердження пароля</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2"
                       required autocomplete="new-password" />
            </div>

            <!-- Is Admin -->
            <div class="flex items-center space-x-2 mt-4">
                <input id="is_admin" type="checkbox" name="is_admin" value="1"
                       class="h-4 w-4 border-gray-400 rounded focus:ring-moda-accent">
                <label for="is_admin" class="text-sm font-serif text-gray-800">
                    Хочу стати адміністратором
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-moda-black hover:bg-moda-accent text-moda-cream py-3 text-center font-semibold transition">
                Зареєструватися
            </button>

            <p class="text-center text-sm font-serif">
                Уже маєте акаунт?
                <a href="{{ route('login') }}" class="underline hover:text-moda-accent"> Увійти </a>
            </p>
        </form>

    </div>
</x-guest-layout>
