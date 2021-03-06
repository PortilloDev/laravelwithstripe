<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order confirmation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(isset($book))
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="flex items-center">
                                <h2>Thank you for purchasing your order.!</h2>
                            </div>
                            <div class="flex items-center">
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class="underline text-gray-900 dark:text-white">   {{ $book['name'] }}</a></div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center">
                                    <label for="price">Amount paid : {{ $book['price'] }} €</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="flex items-center">
                            <h2>Thank you for purchasing your subscription!</h2>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>