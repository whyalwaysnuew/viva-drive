<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('admin.brands.index') }}">
                    {!! __('Brand') !!}
                </a>
                {!! __(' &raquo; Edit &raquo; ') . $brand->name !!}
            </h2>
        </div>
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

                <form action="{{ route('admin.brands.update', $brand->id) }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="bg-white rounded py-10 px-7">
                        <div class=" flex flex-wrap mt-4 mb-6 -mx-3">
                            <div class="w-full">
                                <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Name
                                </label>
                                <input value="{{ old('name') ?? $brand->name }}" type="text" placeholder="e.g. Porsche" name="name" required id="grid-last-name" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Brand name. e.g: Honda, McLaren, Audi, Maseratti. Max 255 characters.
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full px-3 text-right">
                                <a href="#!" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" onclick="window.history.go(-1); return false;">
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