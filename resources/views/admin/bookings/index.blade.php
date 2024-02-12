<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            var datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
    
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'item.brand.name',
                        name: 'item.brand.name',
                    },
                    // {
                    //     data: 'item.name',
                    //     name: 'item.name'
                    // },
                    // {
                    //     data: 'start_date',
                    //     name: 'start_date'
                    // },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                ]
            })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                
            </div>
            <div class="overflow-hidden shadow-xl sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                {{-- <th style="max-width: 1%">ID</th> --}}
                                <th>User</th>
                                <th>Brand</th>
                                <th>Item</th>
                                {{-- <th>Start</th>
                                <th>End</th> --}}
                                <th>Booking Status</th>
                                <th>Payment Status</th>
                                <th>Total Price</th>
                                <th style="max-width: 1%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
