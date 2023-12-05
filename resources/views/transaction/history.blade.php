<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($transactions as $transaction)
                @php
                    switch ($transaction->status) {
                        case 'success':
                            $trColor = 'text-green-800';
                            break;
                        case 'expire':
                            $trColor = 'text-red-800';
                            break;
                        case 'failure':
                            $trColor = 'text-red-800';
                            break;
                        default:
                            $trColor = '';
                            break;
                    }
                @endphp
                <div class="mb-2 p-6 bg-white border overflow-hidden shadow-sm border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white {{@$trColor}}">Status: {{__($transaction->status)}}</h5>
                    <div class="mb-1 font-bold text-lg">
                        {{ $transaction->pointProduct->name }}
                    </div>
                    <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Price: Rp {{@$transaction->total}}</p>
                    <p class="my-auto text-xs">
                        {{ @date_format(date_create(@$transaction->created_at), 'H:i, j M Y') }}
                    </p>
                </div>

                {{-- <a vclass="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                    <div class="max-w rounded overflow-hidden shadow-sm">
                        <div class="px-6 pt-4 flex gap-2">
                            <div class="mr-auto flex flex-col">
                                <p class="my-auto text-base">
                                    Status: {{$transaction->status}}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pt-1 pb-4">
                            <div class="font-bold text-xl">{{ $transaction->pointProduct->name }}</div>
                        </div>
                    </div>
                </a> --}}
            @endforeach
        </div>
    </div>

</x-app-layout>
