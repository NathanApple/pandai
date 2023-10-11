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

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    <div class="px-6 pb-4">
                        <div class="text-sm text-slate-500 font-bold">{{ @$question->points }} Token</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
            <div class="max-w rounded overflow-hidden shadow-sm">
                <form method="POST" action="{{ route('question.view.answer', ['id' => $question->id ]) }}">
                    @csrf
                        <div 
                        class="text-lg w-full mb-4 rounded-lg">
                            <div class="px-4 py-2 bg-white border-1 dark:bg-gray-800">
                                <textarea name="answer" id="answer" rows="10"
                                    class="w-full px-0 text-base text-gray-900 bg-white border-0 
                                    dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400 resize-none"
                                    placeholder="{{__('Tulis Jawaban Anda')}}" required></textarea>
                            </div>
                            <div class="flex items-center justify-between px-3 pt-2">
                                <button type="submit"
                                    class="inline-flex items-center py-2 px-7 text-xs font-medium text-center text-white
                                    bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                    {{ __('Jawab') }}
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>


</x-app-layout>
