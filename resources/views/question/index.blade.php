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
                                <p class="my-auto text-base">
                                    {{ @$question->user->name }}
                                </p>
                                <p class="my-auto text-xs">
                                    {{ @date_format(date_create(@$question->user->created_at), 'H:i, j M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pt-1 pb-4">
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

</x-app-layout>
