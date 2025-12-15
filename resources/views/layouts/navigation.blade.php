<nav class="bg-moda-cream border-b border-moda-black/20">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex justify-between items-center h-20">

            {{-- LEFT: LOGO + MENU --}}
            <div class="flex items-center space-x-12">

                {{-- LOGO --}}
                <a href="{{ route('products.index') }}"
                   class="font-display text-3xl tracking-wide text-moda-black hover:text-moda-accent transition">
                    MODA
                </a>

                {{-- MAIN MENU --}}
                <div class="hidden sm:flex items-center space-x-8 font-sans text-[15px]">
                    <a href="{{ route('products.index') }}"
                       class="relative pb-1 hover:text-moda-accent transition
                       @if(request()->routeIs('products.index')) text-moda-accent @endif">
                        Каталог
                        <span class="absolute left-0 -bottom-[2px] w-full h-[1px] bg-moda-accent"></span>
                    </a>
                </div>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="hidden sm:flex items-center space-x-8 font-sans text-[15px]">


                {{--  MOODBOARD SECTION --}}
                @auth
                    <div x-data="{ openMood: false }" class="relative">

                        <button @click="openMood = !openMood"
                                class="flex items-center space-x-2 text-moda-black hover:text-moda-accent transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4 6h16M4 12h10M4 18h7" />
                            </svg>
                            <span>Moodboard</span>
                        </button>

                        {{-- DROPDOWN --}}
                        <div x-show="openMood"
                             @click.outside="openMood = false"
                             x-transition
                             class="absolute right-0 mt-2 bg-white border border-moda-black/30 shadow-xl
                                    w-56 py-2 z-50">

                            <a href="{{ route('moodboards.index') }}"
                               class="block px-5 py-3 hover:bg-moda-gray/40 font-serif">
                                Всі moodboard-и
                            </a>

   
                            @if(Auth::user()->moodboards()->count())
                                <div class="border-t border-moda-black/20 my-2"></div>

                                @foreach(Auth::user()->moodboards as $mb)
                                    <a href="{{ route('moodboards.show', $mb) }}"
                                       class="block px-5 py-2 hover:bg-moda-gray/40 font-serif text-sm">
                                        • {{ $mb->name }}
                                    </a>
                                @endforeach
                            @endif

                        </div>

                    </div>
                @endauth


                {{--  ADMIN SETTINGS WHEEL --}}
                @auth
                    @if(Auth::user()->role === 'admin')

                        <div x-data="{ open: false }" class="relative">

                            <button @click="open = !open"
                                    class="flex items-center space-x-2 text-moda-black hover:text-moda-accent transition">
                                <svg class="w-6 h-6 transition duration-300"
                                     :class="open ? 'rotate-90 text-moda-accent' : ''"
                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10.5 6h3m-3 12h3m-6-9h9m-7.5 6h6M12 3v2.25M12 18.75V21M4.5 12H6.75M18 12h2.25M6.364 6.364l1.591 1.591M15.727 15.727l1.591 1.591M6.364 17.636l1.591-1.591M15.727 8.273l1.591-1.591" />
                                </svg>
                            </button>

                            <div x-show="open"
                                 @click.outside="open = false"
                                 x-transition
                                 class="absolute right-0 mt-2 bg-white border border-moda-black/30 shadow-xl w-48 py-2 z-50">

                                <a href="{{ route('categories.index') }}"
                                   class="block px-5 py-3 hover:bg-moda-gray/40 font-serif">
                                    Категорії
                                </a>

                                <a href="{{ route('admin.products.index') }}"
                                   class="block px-5 py-3 hover:bg-moda-gray/40 font-serif">
                                    Товари
                                </a>

                                <a href="{{ route('profile.edit') }}"
                                   class="block px-5 py-3 hover:bg-moda-gray/40 font-serif">
                                    Профіль
                                </a>

                            </div>
                        </div>

                    @endif
                @endauth


                {{-- USER MENU --}}
                @auth
                    <div x-data="{ openUser: false }" class="relative">

                        <button @click="openUser = !openUser"
                                class="flex items-center space-x-2 text-moda-black hover:text-moda-accent transition">
                            <span class="font-semibold">{{ Auth::user()->name }}</span>

                            <svg class="w-4 h-4 transition"
                                :class="openUser ? 'rotate-180 text-moda-accent' : ''"
                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openUser"
                             @click.outside="openUser = false"
                             x-transition
                             class="absolute right-0 mt-2 bg-white border border-moda-black/30 shadow-xl
                                    w-48 py-2 z-50">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block w-full text-left px-5 py-3 hover:bg-moda-gray/40 font-serif">
                                    Вийти
                                </button>
                            </form>

                        </div>

                    </div>

                @else
                    <a href="{{ route('login') }}"
                       class="text-moda-black hover:text-moda-accent transition">
                        Увійти
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-5 py-2 bg-moda-black text-moda-cream hover:bg-moda-accent transition font-semibold">
                        Реєстрація
                    </a>
                @endauth

            </div>

        </div>
    </div>
</nav>
