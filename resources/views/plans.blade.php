<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription') }}
        </h2>
    </x-slot>
    @push('styles')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    @endpush
    <div class="container m-auto">
        <div class="flex flex-wrap items-center justify-center w-full text-center">
            <!-- 3 x pricing plan columns here -->
            <!-- basic plan -->

            <div class="grid grid-cols-2">
                @foreach ( $plans as $plan)
                <div class="w-full  p-4">
                    <div class="flex flex-col rounded border-2 border-blue-700 bg-blue-700">
                        <div class="py-5 text-blue-700 bg-white">
                            <h3> Plan {{ $plan->name }}</h3>
                            <p class="text-5xl font-bold">
                                {{ $plan->cost }}.<span class="text-3xl">00</span> €
                            </p>
                            <input type="hidden" id="stripe_plan" value="{{$plan->stripe_plan }}">
                        </div>
                        <div class="py-5 bg-blue-700 text-white rounded-b">
                            <div class="mb-5">
                                <p>{{$plan->description }}</p>
                                <p>Another feature plan feature</p>
                                <p>Yet another plan feature</p>
                            </div>
                            <div>
                                <button type="button" data-id="{{$plan->stripe_plan}}" class="px-5 py-2 mt-3 uppercase openModal  rounded bg-white text-blue-700 font-semibold hover:bg-blue-900 hover:text-white">Get Started</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @include('components.modal-pay-suscription')
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    
        $(document).ready(function () {
            $('.openModal').on('click', function(e){
                $('#interestModal').removeClass('invisible');
                $('#type_plan').val($(this).attr('data-id'));

            });
            $('.closeModal').on('click', function(e){
                $('#interestModal').addClass('invisible');
            });
        });
        </script>
@endpush

</x-app-layout>