<x-app-layout>



    <x-slot name="header">

        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Property Details') }}
            </h2>

            <div class="flex justify-between">

                <form method="POST" action="{{route('properties.publish', $property)}}">
                    @csrf
                    @method('put')

                    @if($property->publish_status)
                        <x-button class="ml-4">
                            {{ __('Unpublish') }}
                        </x-button>
                    @else
                        <x-button class="ml-4">
                            {{ __('Publish') }}
                        </x-button>
                    @endif
                </form>

                <form method="POST" action="{{route('properties.destroy', $property)}}">
                    @csrf
                    @method('delete')
                    <x-button class="ml-4 bg-red-400">
                        {{ __('Delete') }}
                    </x-button>

                </form>

            </div>



        </div>
    </x-slot>


    <div class="py-12">
        <div class="mx-w-full mx-auto sm:px-6 lg:px-8">

            <div class="mx-w-full bg-white overflow-hidden shadow-sm sm:rounded-lg m-2 cursor-pointer">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-start">

                        <img class="w-1/2 p-10" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">

                        <div class="m-10">
                            <form method="POST" action="{{ route('properties.update', $property) }}">
                            @csrf
                            @method('put')

                            <!-- Name -->
                                <div>
                                    <x-label for="name" :value="__('Property Name')" />

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$property->name}}" required autofocus />
                                </div>
                                <!-- Location -->
                                <div class="mt-4">
                                    <x-label for="location" :value="__('Location')" />

                                    <x-input id="location" class="block mt-1 w-full" type="text" value="{{$property->location}}" name="location" required />
                                </div>

                                <!-- Max Guests -->
                                <div class="mt-4">
                                    <x-label for="max_guests" :value="__('Max Guests')" />

                                    <x-input id="max_guests" class="block mt-1 w-full" type="number" value="{{$property->max_guests}}" name="max_guests" min="1" />
                                </div>


                                <div class="flex items-center justify-end mt-4">

                                    <x-button class="ml-4 bg-green-400">
                                        {{ __('Save') }}
                                    </x-button>
                                </div>

                                <div>


                            </form>
                        </div>



                    </div>
                </div>
            </div>



        </div>


        <div class="font-bold mt-10 text-lg ml-10">
            Bookings

        </div>



        <div class="p-6 bg-white border-b border-gray-200 mt-10">
            @foreach($property->bookings as $booking)

                @if($booking->status == 'pending')
                    <form method="POST" action="{{route('properties.change_status', $booking)}}">
                        @csrf
                        @method('put')

                        <div class="grid grid-cols-3 my-8">

                            <div>
                                <div class="font-bold text-lg">{{$booking->guest->user_name}}</div>
                                <div>{{$booking->guest->user_email}}</div>

                            </div>


                            <div>
                                <div>From date: {{$booking->from_date}}</div>
                                <div>To date: {{$booking->to_date}}</div>
                                <div>Guests: {{$booking->guest_count}}</div>
                            </div>

                            <div>
                                <x-button type="submit" name="action" value="accept" class="bg-green-400">Accept</x-button>
                                <x-button type="submit" name="action" value="reject" class="bg-red-400">Reject</x-button>
                            </div>
                        </div>

                    </form>
                @endif

                <hr>

            @endforeach
        </div>

    </div>
    </div>






</x-app-layout>
