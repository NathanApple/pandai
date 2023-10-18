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

    <form action="{{ route('product.purchase') }}" method="POST">
        @csrf
        <div class="pt-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="max-w rounded overflow-hidden shadow-sm p-3">
                        <div>
                            <label for="points" class="block text-sm font-medium leading-6 text-gray-900">Total Token (Generator)</label>
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input type="text" name="points" id="points" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
                                <div class="absolute inset-y-0 right-3 flex items-center">
                                <label for="currency" class="">POINT</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Purchase
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>




</x-app-layout>
