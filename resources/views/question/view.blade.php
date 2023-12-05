<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Question') }}
            </h2>
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                {{ __('Ask Question') }}
            </button>
        </div>
    </x-slot>

    <div class="pt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w rounded overflow-hidden shadow-sm">
                    <div class="px-6 pt-4 flex gap-2">
                        <div class="pr-3">
                            <img src="{{ @$question->user->profile_photo_url }}"
                                alt="{{ @$question->user->name }}"
                                class="h-10 w-10 rounded-full flex items-center justify-center object-cover">
                        </div>
                        <div class="mr-auto flex flex-col">
                            <p class="my-auto text-lg">
                                {{ @$question->user->name }}
                            </p>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class=" text-xl">{!! nl2br(@$question->question) !!}</div>
                    </div>
                    <div class="px-6 pb-4">
                        <div class="text-sm text-slate-500 font-bold">{{ @$question->points }} Token</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-3 ">
        <h1 class="text-3xl font-bold pl-3">Jawaban</h1>
    </div>

    @if (@$allowAnswer)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-1">
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
    @endif


    @foreach ($answers as $answer)
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                    <div class="max-w rounded overflow-hidden shadow-sm">
                        <div class="px-6 pt-4 flex gap-1">
                            <div class="pr-2 pt-1">
                                <img src="{{ @$answer->user->profile_photo_url }}"
                                    alt="{{ @$answer->user->name }}"
                                    class="h-8 w-8 rounded-full flex items-center justify-center object-cover">
                            </div>
                            <div class="mr-auto flex flex-col">
                                <p class="text-md" style="color:gray">
                                    {{ @$answer->user->name }}
                                </p>
                                <p class="text-xs">
                                    {{ @date_format(date_create(@$answer->created_at), 'H:i, j M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pb-4 pt-2">
                            <div class="text-xl">{!! nl2br(@$answer->answer) !!}</div>
                        </div>
                        <div class="px-6 pb-4 pt-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


</x-app-layout>
