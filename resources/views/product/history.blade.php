<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pertanyaan') }}
            </h2>
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                {{ __('Ajukan Pertanyaan') }}
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($transactions as $transaction)
                <a class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
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
                </a>
            @endforeach
        </div>
    </div>

</x-app-layout>
