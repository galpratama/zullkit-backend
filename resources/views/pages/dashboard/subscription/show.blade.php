<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Subscription &raquo; #{{ $subscription->id }} {{ $subscription->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-5 text-lg font-semibold leading-tight text-gray-800">Subscription Details</h2>

            <div class="mb-10 overflow-hidden bg-white shadow sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full table-auto">
                        <tbody>
                            <tr>
                                <th class="px-6 py-4 text-right border">Name</th>
                                <td class="px-6 py-4 border">{{ $subscription->user->name }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-right border">Email</th>
                                <td class="px-6 py-4 border">{{ $subscription->user->email }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-right border">Start Date</th>
                                <td class="px-6 py-4 border">{{ $subscription->start_date }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-right border">End Date</th>
                                <td class="px-6 py-4 border">{{ $subscription->end_date }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-right border">Total Price</th>
                                <td class="px-6 py-4 border">{{ number_format($subscription->payment_total) }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-right border">Payment Status</th>
                                <td class="px-6 py-4 border">{{ $subscription->payment_status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
