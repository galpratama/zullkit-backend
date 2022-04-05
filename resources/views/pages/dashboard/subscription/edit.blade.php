<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Subscription &raquo; {{ $item->name }} &raquo; Edit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                            There's something wrong!
                        </div>
                        <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form class="w-full" action="{{ route('dashboard.subscription.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                                Payment Status
                            </label>
                            <select name="payment_status" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                <option value="{{ $item->payment_status }}">{{ $item->payment_status }}</option>
                                <option disabled>-------</option>
                                <option value="PENDING">PENDING</option>
                                <option value="SUCCESS">SUCCESS</option>
                                <option value="CANCELLED">CANCELLED</option>
                                <option value="FAILED">FAILED</option>
                                <option value="SHIPPING">SHIPPING</option>
                                <option value="SHIPPED">SHIPPED</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                Update Subscription
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</x-app-layout>
