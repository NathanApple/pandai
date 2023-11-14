<x-app-layout>

    {{-- <form action="{{ route('product.purchase') }}" method="POST"> --}}
    <form action="" method="POST">
        @csrf
        <div class="pt-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="max-w rounded overflow-hidden shadow-sm p-3 grid grid-cols-3 gap-4">
                        @foreach ($products as $product)
                            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{@$product->name}}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{@$product->description}}</p>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Rp {{@$product->price}}</p>
                                <button
                                    data-id="{{$product->id}}"
                                    type="button"
                                    class="pay-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Buy Now
                                    <i class="material-icons pl-2 tiny">shopping_cart</i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->


        {{-- <div class="pt-3">
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
        </div> --}}
    </form>

    <x-slot name="jsextra">
        <script type="text/javascript">
            $(document).ready(function(){
                $('.pay-button').click(function (){
                    $.ajax({
                        type: "get",
                        url: "{{ route('product.get-snap-token') }}",
                        data: {
                            id: $(this).attr("data-id"),
                        },
                        dataType: "json",
                        success: function (response) {
                            let redirect_route = "{{route('product.process', ['orderid' => '::orderid::'])}}";
                            redirect_route = redirect_route.replace('::orderid::', response['order_id']);
                            snap.pay(response['snap_token'], {
                              // Optional
                              onSuccess: function(result){
                                window.location.replace(redirect_route);
                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                              },
                              // Optional
                              onPending: function(result){
                                window.location.replace(redirect_route);
                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                              },
                              // Optional
                              onError: function(result){
                                window.location.replace(redirect_route);
                                /* You may add your own js here, this is just example */
                                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                              }
                            });
                        }
                    });
                });
            });
        </script>
    </x-slot>

</x-app-layout>
