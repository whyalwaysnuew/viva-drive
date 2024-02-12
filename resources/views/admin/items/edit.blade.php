<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('admin.items.index') }}">
                    {!! __('Item') !!}
                </a>
                {!! __(' &raquo; Edit &raquo; ') . $item->name !!}
            </h2>
        </div>
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $('.select2').select2();
        </script>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bols text-white bg-red-500 rounded-t">
                            Something went wrong!
                        </div>
                        <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.items.update', $item->id) }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="bg-white rounded py-10 px-7">
                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Name
                                </label>
                                <input value="{{ old('name') ?? $item->name }}" type="text" placeholder="e.g. Cayman" name="name" required id="grid-last-name" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Item name. e.g: Cayman, Veyron, R8 LMS Ultra. Max 255 characters.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-brands" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Brand
                                </label>
                                <select name="brand_id" id="grid-last-brands" class="select2 block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="{{ $item->brand->id }}" selected >Tidak diubah ({{ $item->brand->name }})</option>
                                    <option disabled > ------------ </option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : ''}}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="mt-2 text-sm text-gray-500">
                                    Select 1 Brand.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-types" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Type
                                </label>
                                <select name="type_id" id="grid-last-types" class="select2 block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="{{ $item->type->id }}" selected >Tidak diubah ({{ $item->type->name }})</option>
                                    <option disabled > ------------ </option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : ''}}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="mt-2 text-sm text-gray-500">
                                    Select 1 Type.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-features" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Features
                                </label>
                                <input value="{{ old('features') ?? $item->features }}" type="text" placeholder="e.g. Autodrive" name="features" id="grid-last-features" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Feature name. e.g: Autodrive, Offroad, Fast. Max 255 characters.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-photos" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Photos
                                </label>
                                <input multiple accept="image/png, image/jpeg, image/jpg, image/webp" type="file" placeholder="e.g. Autodrive" name="photos[]" id="grid-last-photos" class="block w-full leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Photo items. Upload more than 1.
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-3 px-3 mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label for="grid-last-price" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Price
                                </label>
                                <input value="{{ old('price') ?? $item->price }}" type="number" placeholder="e.g. 15000000" name="price" required id="grid-last-price" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Price. e.g: 15000000. Required. 
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="grid-last-star" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Rating
                                </label>
                                <input value="{{ old('star') ?? $item->star }}" type="number" placeholder="e.g. 4" name="star" required id="grid-last-star" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" min="1" max="5" step=".01">
                                <div class="mt-2 text-sm text-gray-500">
                                    Rating. e.g: 5. Optional. 
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="grid-last-review" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Review
                                </label>
                                <input value="{{ old('review') ?? $item->review }}" type="number" placeholder="e.g. 3" name="review" required id="grid-last-review" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Rating. e.g: 3. Optional. 
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full px-3 text-right">
                                <a href="#!" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" onclick="window.history.go(-1); return false;">
                                    Back
                                </a>
                                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>