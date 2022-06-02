<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment process') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <form action="{{route('pay')}}" method="POST" id="paymentForm">
                            @csrf
                            <input type="hidden" name="book" id="book" value="{{$book}}">
                            <div class="flex items-center">
                                <img src="{{Storage::url($book->image->url)}}" alt="" height="50px" width="50px">
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class="underline text-gray-900 dark:text-white">   {{ $book->name }}</a></div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center">
                                    <label for="price">Amount to pay is: {{ $book->price }} €</label>
                                    <input type="hidden" name="price" value="{{$book->price}}">
                                </div>
                            </div>
                           @include('components.stripe-form')
                          
                            <div class="flex items-center">
                                <button id="payButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Pay </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>