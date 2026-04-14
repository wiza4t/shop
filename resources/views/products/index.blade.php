<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">
                🛒 WebShop - Proizvodi
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- TOP BAR --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow transition">

                    <x-heroicon-o-plus class="w-5 h-5" />
                    <span>Dodaj proizvod</span>
                </a>

                <form method="GET" action="{{ route('products.index') }}" class="w-full md:w-1/3">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="🔍 Pretraži proizvode..."
                           class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring focus:outline-none">
                </form>

            </div>

            {{-- TABLE --}}
            <div class="bg-white shadow rounded-2xl overflow-hidden">

                {{-- HEADER --}}
                <div class="hidden md:grid grid-cols-5 bg-gray-100 px-6 py-3 text-sm font-semibold text-gray-600">
                    <div>Naziv</div>
                    <div>Opis</div>
                    <div>Cijena</div>
                    <div>Kategorija</div>
                    <div>Akcije</div>
                </div>

                {{-- ROWS --}}
                <div class="divide-y">

                    @forelse($products as $product)

                        <div class="grid grid-cols-1 md:grid-cols-5 gap-3 px-6 py-4 items-center">

                            {{-- NAME --}}
                            <div class="font-semibold text-gray-900">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="text-blue-600 hover:underline">
                                    {{ $product->name }}
                                </a>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="text-gray-600 text-sm">
                            <p class="text-gray-600 text-sm">
    {{ \Illuminate\Support\Str::limit($product->description, 90) }}
</p>
                            </div>

                            {{-- PRICE --}}
                            <div class="text-green-600 font-bold flex items-center gap-1">
                                <x-heroicon-o-currency-dollar class="w-4 h-4" />
                                {{ number_format($product->price, 2) }} KM
                            </div>

                            {{-- CATEGORY --}}
                            <div class="flex items-center gap-2 text-gray-700">

                                @php
                                    $icon = 'cube';

                                    $name = strtolower($product->category->name ?? '');

                                    if (str_contains($name, 'račun')) $icon = 'computer-desktop';
                                    elseif (str_contains($name, 'elektr')) $icon = 'bolt';
                                    elseif (str_contains($name, 'sport')) $icon = 'trophy';
                                    elseif (str_contains($name, 'mob')) $icon = 'device-phone-mobile';
                                @endphp

                                <x-dynamic-component :component="'heroicon-o-' . $icon"
                                                     class="w-5 h-5 text-gray-500" />

                                <span>{{ $product->category->name ?? 'Nema kategorije' }}</span>
                            </div>

                            {{-- ACTIONS --}}
                            <div class="flex gap-2">

                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-xl text-sm transition">

                                    <x-heroicon-o-pencil class="w-4 h-4" />
                                    <span>Uredi</span>
                                </a>

                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Obrisati proizvod?')"
                                            class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-xl text-sm transition">

                                        <x-heroicon-o-trash class="w-4 h-4" />
                                        <span>Izbriši</span>
                                    </button>

                                </form>

                            </div>

                        </div>

                    @empty

                        <div class="p-10 text-center text-gray-500">
                            Nema proizvoda u bazi.
                        </div>

                    @endforelse

                </div>
            </div>

        </div>
    </div>
</x-app-layout>