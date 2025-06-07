<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('index') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('assets/avion.png') }}" alt="Icono web" class="mx-auto block w-10 h-auto rounded mb-3">
                    <span class="font-semibold text-xl text-indigo-600 select-none">GoTogether</span>
                </a>
            </div>

            <!-- Navigation Links (desktop) -->
            <div class="hidden sm:flex sm:space-x-8 sm:items-center">
                <x-nav-link :href="route('index')" :active="request()->routeIs('index')" class="text-gray-700 hover:text-indigo-600 transition">
                    Inicio
                </x-nav-link>

                <x-nav-link :href="route('viajes.index')" :active="request()->routeIs('viajes.*')" class="text-gray-700 hover:text-indigo-600 transition">
                    Viajes
                </x-nav-link>

                <x-nav-link :href="route('destinos.index')" :active="request()->routeIs('destinos.*')" class="text-gray-700 hover:text-indigo-600 transition">
                    Destinos
                </x-nav-link>

                @if(auth()->user() && auth()->user()->isAdmin())
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')" class="text-gray-700 hover:text-indigo-600 transition">
                        Admin
                    </x-nav-link>
                @endif
            </div>

            <!-- Profile Dropdown (desktop) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md transition">
                            <span class="inline-block h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg select-none">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.index')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar Sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (mobile) -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (mobile) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-white border-t border-gray-200 shadow-md">
        <div class="pt-3 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')" class="text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                Inicio
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('viajes.index')" :active="request()->routeIs('viajes.*')" class="text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                Viajes
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('destinos.index')" :active="request()->routeIs('destinos.*')" class="text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                Destinos
            </x-responsive-nav-link>

            @if(auth()->user() && auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')" class="text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                    Admin
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="border-t border-gray-200 pt-4 pb-3">
            <div class="px-4 flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <!-- Aquí podrías poner el avatar del usuario si tienes -->
                    <span class="inline-block h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg select-none">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.index')" class="text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                    Perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                        Cerrar Sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
