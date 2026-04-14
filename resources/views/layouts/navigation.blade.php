<nav class="bg-white border-b shadow-sm">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LOGO -->
            <a href="{{ route('products.index') }}"
               class="text-xl font-bold text-gray-800 flex items-center gap-2">
                🛒 <span>WebShop</span>
            </a>

            <!-- RIGHT -->
            <div class="flex items-center gap-4">

                <!-- USER DROPDOWN -->
                <div class="relative">

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 text-sm text-gray-700 hover:text-gray-900 focus:outline-none">
                                <span class="font-medium">
                                    {{ Auth::user()->name }}
                                </span>

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <!-- PROFILE -->
                            <x-dropdown-link href="{{ route('profile.edit') }}">
                                👤 Profil
                            </x-dropdown-link>

                            <!-- LOGOUT -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    🚪 Logout
                                </button>

                            </form>

                        </x-slot>

                    </x-dropdown>

                </div>

            </div>

        </div>
    </div>

</nav>