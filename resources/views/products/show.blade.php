<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <x-heroicon-o-cube class="w-5 h-5 text-gray-600" />
                <span>Detalji proizvoda</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- BACK --}}
            <div class="mb-4">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-xl shadow transition">

                    <x-heroicon-o-arrow-left class="w-4 h-4" />
                    <span>Nazad</span>

                </a>
            </div>

            {{-- CARD --}}
            <div class="bg-white shadow rounded-2xl overflow-hidden">

                {{-- IMAGE --}}
                @if($product->image)
                    <div class="p-6 flex justify-center bg-gray-50">

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            class="w-72 h-72 object-cover rounded-xl border cursor-pointer hover:scale-105 transition"
                            onclick="openImageModal(this.src)"
                        >

                    </div>
                @endif

                <div class="p-6 space-y-4">

                    {{-- NAME --}}
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <x-heroicon-o-tag class="w-6 h-6 text-gray-500" />
                        {{ $product->name }}
                    </h1>

                    {{-- DESCRIPTION --}}
                    <p class="text-gray-600">
                        {{ $product->description }}
                    </p>

                    <hr>

                    {{-- PRICE --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2 text-gray-500">
                            <x-heroicon-o-currency-dollar class="w-5 h-5" />
                            Cijena
                        </div>

                        <div class="text-green-600 font-bold">
                            {{ number_format($product->price, 2) }} KM
                        </div>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2 text-gray-500">
                            <x-heroicon-o-cube class="w-5 h-5" />
                            Kategorija
                        </div>

                        <div class="text-gray-800 font-medium">
                            {{ $product->category->name ?? 'Nema' }}
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="flex gap-3 pt-4">

                        <a href="{{ route('products.edit', $product->id) }}"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition">

                            <x-heroicon-o-pencil class="w-4 h-4" />
                            <span>Uredi</span>

                        </a>

                        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Obrisati proizvod?')"
                                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl transition">

                                <x-heroicon-o-trash class="w-4 h-4" />
                                <span>Izbriši</span>

                            </button>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- IMAGE MODAL --}}
    <div id="imageModal"
         class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

        <span class="absolute top-5 right-5 text-white text-3xl cursor-pointer"
              onclick="closeImageModal()">✕</span>

        <img id="modalImage"
             class="max-w-5xl max-h-[90vh] rounded-xl shadow-lg">
    </div>

    <script>
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.getElementById('modalImage').src = src;
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('imageModal').addEventListener('click', function (e) {
            if (e.target === this) closeImageModal();
        });
    </script>

</x-app-layout>