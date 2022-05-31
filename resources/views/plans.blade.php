<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suscrición') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-8 sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <h1 class="text-gray-900 text-4xl">Planes para La Biblioteca Online:</h1>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
             
                <form action="{{route('subscribe.store')}}" method="POST" id="paymentForm">
                    @csrf
                    <div class="flex gap-4 p-6">

                        @foreach ( $plans as $plan)

                        <div class="p-6 rounded-2xl" style=" border-width: 6px;
                        border-color: blueviolet; margin-left:15px">
                            <label class="btn btn-outline-info rounded m-2 p-3 w-full g-4">
                                <input type="radio" name="plan" value="{{ $plan->stripe_plan }}" required>
                                <p class="h2 font-weight-bold text-capitalize">
                                  Plan  {{ $plan->name }}
                                </p>

                                <p class="display-4 text-capitalize">
                                    {{ $plan->cost }} €
                                </p>
                            </label>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm flex items-center">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                   <div class="p-4 ml-12">
                    <input
                            type="text"
                            name="name"
                            placeholder="Enter Your Name"
                            class="w-1/3 px-4 py-2 border-b-2 border-gray-400 outline-none  focus:border-gray-400"
                        />
                    
                        <input
                                type="email"
                                name="email"
                                placeholder="Enter Your Email"
                                class="w-1/3 px-4 py-2 border-b-2 border-gray-400 outline-none  focus:border-gray-400"
                            />
                    </div>
                    <div class="grid grid-cols-1 ml-12">
                        @include('components.stripe-form')
                    </div>
                    <div class="flex items-center mb-4 mt-4 p-4 ml-12">
                        <button id="payButton"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Comprar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
            
            
</x-app-layout>