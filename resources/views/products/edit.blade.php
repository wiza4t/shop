<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            ✏️ Uredi proizvod
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white shadow rounded-2xl p-6">

                <form action="{{ route('products.update', $product->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- NAME --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Naziv</label>
                        <input type="text" name="name"
                               value="{{ $product->name }}"
                               class="w-full border rounded-xl px-4 py-2"
                               required>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Opis</label>
                        <textarea name="description"
                                  class="w-full border rounded-xl px-4 py-2"
                                  required>{{ $product->description }}</textarea>
                    </div>

                    {{-- PRICE --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Cijena</label>
                        <input type="number" step="0.01" name="price"
                               value="{{ $product->price }}"
                               class="w-full border rounded-xl px-4 py-2"
                               required>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-1">Kategorija</label>
                        <select name="category_id"
                                class="w-full border rounded-xl px-4 py-2">

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- CURRENT IMAGE --}}
                    @if($product->image)
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-1">Trenutna slika</label>

                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-40 h-40 object-cover rounded-xl border">
                        </div>
                    @endif

                    {{-- NEW IMAGE --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-1">Nova slika</label>
                        <input type="file" name="image"
                               class="w-full border rounded-xl px-4 py-2">
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex gap-3">

                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl">

                         <span>Sačuvaj izmjene</span>
                        </button>

                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-xl">

                            ← <span>Nazad</span>
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>