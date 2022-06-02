<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <form action="{{route('subscribe.store')}}" method="POST" id="paymentForm">
                            @csrf
                            <div class="flex gap-4 p-6">

                                @foreach ( $plans as $plan)

                                <div class="p-6 rounded-2xl" style="
                                                border-width: 6px;
                                                border-color: blueviolet;
                                                margin-left:15px">
                                                
                                    <label class="btn btn-outline-info rounded m-2 p-3 w-full g-4">
                                        <input type="radio" name="plan" value="{{ $plan->stripe_plan }}" required>
                                        <p class="h2 font-weight-bold text-capitalize">
                                            Plan {{ $plan->name }}
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

                            <div class="grid items-center mb-4">
                                <input type="text" name="name" placeholder="Enter Your Name"
                                    class="w-1/3 px-4 py-2 border-b-2 border-gray-400 outline-none  focus:border-gray-400" />
                            </div>
                            <div class="grid items-center">
                                <input type="email" name="email" placeholder="Enter Your Email"
                                    class="w-1/3 px-4 py-2 border-b-2 border-gray-400 outline-none  focus:border-gray-400" />
                            </div>
                            @include('components.stripe-form')
                            <div class="flex items-center mt-4">
                                <button id="payButton"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Pay
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>