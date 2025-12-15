<x-guest-layout>
    <div class="w-full max-w-md mx-auto animate-fade-in">

        <h1 class="font-display text-4xl text-center mb-6 tracking-wide">
            Ласкаво просимо
        </h1>

        <p class="text-center text-sm text-gray-700 mb-10 font-serif">
            Уведіть дані для доступу до вашого акаунту
        </p>

        <!-- session status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm mb-1 font-semibold" for="email">Email</label>
                <input id="email" type="email" name="email"
                    class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2"
                    required autofocus autocomplete="username" />
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm mb-1 font-semibold" for="password">Пароль</label>
                <input id="password" type="password" name="password"
                    class="w-full border-b border-moda-black bg-transparent focus:border-moda-accent focus:outline-none py-2"
                    required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center space-x-2 text-sm">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-moda-accent focus:ring-moda-accent"
                           name="remember">
                    <span>Запам’ятати мене</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm underline hover:text-moda-accent transition"
                       href="{{ route('password.request') }}">
                        Забули пароль?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-moda-black hover:bg-moda-accent text-moda-cream py-3 text-center font-semibold transition">
                Увійти
            </button>

            <p class="text-center text-sm font-serif">
                Не маєте акаунту?
                <a href="{{ route('register') }}" class="underline hover:text-moda-accent"> Зареєструватися </a>
            </p>
        </form>
    </div>
</x-guest-layout>
