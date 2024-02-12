<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('admin.bookings.index') }}">
                    {!! __('Booking') !!}
                </a>
                {!! __(' &raquo; Edit &raquo; ') . $booking->name !!}
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

                <form action="{{ route('admin.items.update', $booking->id) }}" class="w-full" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="bg-white rounded py-10 px-7">
                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-name" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Name
                                </label>
                                <input value="{{ old('name') ?? $booking->name }}" type="text" placeholder="Han Hyo Joo" name="name" id="grid-last-name" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Full Name.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-address" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Address
                                </label>
                                <input value="{{ old('address') ?? $booking->address }}" type="text" placeholder="Seoul, Korea" name="address" id="grid-last-address" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    Address.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-city" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    City
                                </label>
                                <input value="{{ old('city') ?? $booking->city }}" type="text" placeholder="Seoul, Korea" name="city" id="grid-last-city" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    City. e.g: Kota Surabaya.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-zip" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    ZIP
                                </label>
                                <input value="{{ old('zip') ?? $booking->zip }}" type="text" placeholder="Seoul, Korea" name="zip" id="grid-last-zip" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                <div class="mt-2 text-sm text-gray-500">
                                    ZIP Code. e.g: 15730.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-status" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Booking Status
                                </label>
                                <select name="status" id="grid-last-status" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="PENDING" {{ $booking->status == 'PENDING' ? 'selected' : ''}} </option>PENDING</option>
                                    <option value="CONFIRMED" {{ $booking->status == 'CONFIRMED' ? 'selected' : ''}} </option>CONFIRMED</option>
                                    <option value="DONE" {{ $booking->status == 'DONE' ? 'selected' : ''}} </option>DONE</option>
                                </select>
                                <div class="mt-2 text-sm text-gray-500">
                                    Booking Status. e.g: PENDING, SUCCESS, CANCEL.
                                </div>
                            </div>
                        </div>

                        <div class=" flex flex-wrap mt-4 mb-6">
                            <div class="w-full">
                                <label for="grid-last-payment_status" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">
                                    Payment Status
                                </label>
                                <select name="payment_status" id="grid-last-payment_status" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="PENDING" {{ $booking->payment_status == 'PENDING' ? 'selected' : ''}} </option>PENDING</option>
                                    <option value="SUCCESS" {{ $booking->payment_status == 'SUCCESS' ? 'selected' : ''}} </option>SUCCESS</option>
                                    <option value="FAILED" {{ $booking->payment_status == 'FAILED' ? 'selected' : ''}} </option>FAILED</option>
                                    <option value="EXPIRED" {{ $booking->payment_status == 'EXPIRED' ? 'selected' : ''}} </option>EXPIRED</option>
                                </select>
                                <div class="mt-2 text-sm text-gray-500">
                                    Booking Status. e.g: PENDING, SUCCESS, CANCEL.
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