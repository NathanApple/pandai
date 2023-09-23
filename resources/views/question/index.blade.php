<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pertanyaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <div class="max-w rounded overflow-hidden shadow-lg">
                    <div class="px-6 pt-4 flex gap-2">
                        <div class="pr-3">
                            <img src="https://media.istockphoto.com/id/1316134499/photo/a-concept-image-of-a-magnifying-glass-on-blue-background-with-a-word-example-zoom-inside-the.webp?b=1&s=170667a&w=0&k=20&c=e-i4hdu7dT3PIuf4xQMglnnORiwBAC_ZUgXw6aorB1M="
                                class="h-10 w-10 rounded-full flex items-center justify-center">
                        </div>
                        <div class="mr-auto flex flex-col">
                            <p class="my-auto text-lg">
                                Nama User
                            </p>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl">Apa itu entre?</div>
                    </div>
                    <div class="px-6 pb-5">
                        <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                            Jawab
                        </button>
                    </div>

                </div>

            </div>
        </div>

        
    </div>
</x-app-layout>