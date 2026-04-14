<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            ➕ Dodaj proizvod
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white shadow rounded-2xl p-6">

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- NAME --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Naziv</label>
                        <input type="text" name="name"
                               class="w-full border rounded-xl px-4 py-2 focus:ring"
                               required>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Opis</label>
                        <textarea name="description"
                                  class="w-full border rounded-xl px-4 py-2 focus:ring"
                                  required></textarea>
                    </div>

                    {{-- PRICE --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Cijena</label>
                        <input type="number" step="0.01" name="price"
                               class="w-full border rounded-xl px-4 py-2 focus:ring"
                               required>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Kategorija</label>
                        <select name="category_id"
                                class="w-full border rounded-xl px-4 py-2 focus:ring"
                                required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- IMAGE UPLOAD --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Slika proizvoda</label>

                        <input type="file" name="image"
                               accept="image/*"
                               onchange="previewImage(event)"
                               class="w-full border rounded-xl px-4 py-2">

                        {{-- PREVIEW --}}
                        <div class="mt-4">
                            <img id="preview"
                                 class="hidden w-32 h-32 object-cover rounded-lg border">
                        </div>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex gap-3">

                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow">

                            ✔️ <span>Sačuvaj</span>
                        </button>

                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-xl shadow">

                            ← <span>Nazad</span>
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- PREVIEW SCRIPT --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
                preview.classList.remove('hidden');
            }
        }
    </script>

</x-app-layout>