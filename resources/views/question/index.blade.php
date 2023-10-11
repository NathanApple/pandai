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

            @foreach ($questions as $question)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                    <div class="max-w rounded overflow-hidden shadow-sm">
                        <div class="px-6 pt-4 flex gap-2">
                            <div class="pr-3">
                                <img src="https://media.istockphoto.com/id/1316134499/photo/a-concept-image-of-a-magnifying-glass-on-blue-background-with-a-word-example-zoom-inside-the.webp?b=1&s=170667a&w=0&k=20&c=e-i4hdu7dT3PIuf4xQMglnnORiwBAC_ZUgXw6aorB1M="
                                    class="h-10 w-10 rounded-full flex items-center justify-center">
                            </div>
                            <div class="mr-auto flex flex-col">
                                <p class="my-auto text-lg">
                                    {{ @$question->user->name }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl">{{ @$question->question }}</div>
                        </div>
                        <div class="px-6 pb-5">
                            <a href="{{ route("question.view", ['id' => $question->id ]) }}"
                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                Jawab
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Pertanyaan') }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="defaultModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form name="postQuestion" id="postQuestion" method="POST" action="{{url('question/storeQuestion')}}">
                @csrf
                    <div
                        class="text-lg w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="px-4 py-2 bg-white border-none dark:bg-gray-800">
                            <label for="question" class="sr-only">{{ __('Pertanyaanmu') }}</label>
                            <textarea name="question" id="question" rows="10"
                                class="w-full px-0 text-base text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                placeholder="{{__('Tulis Pertanyaan Anda')}}" required></textarea>
                        </div>
                        <div class="flex items-center justify-between px-3 py-2 bg-gray-200">
                            <button type="submit" data-modal-hide="defaultModal"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                {{ __('Ajukan Pertanyaan') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
