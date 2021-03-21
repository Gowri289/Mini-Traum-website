<x-app-layout>


    <x-slot name="header">

        <div class="flex items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Owner Dashboard') }}
            </h2>
            <div class="flex items-center px-4 ml-10">
                    <svg class="h-8 w-10  text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{$owner_name}}</div>
                </div>
                <svg class="h-9 w-10 text-gray-400 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <div class="ml-1">
                    <div class="font-medium text-base text-gray-800">{{$owner_email}}</div>
                </div>
            </div>

            <div class="flex items-end ml-10">
                @if($properties->count() < 3)
                    <form method="GET" action="{{route('properties.create')}}">
                        <button class="bg-green-400 p-2 rounded text-white">
                            Add New Property
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 auto-cols-max gap-4">

            @foreach($properties as $property)
                <a href="{{route('properties.edit', $property)}}" class="max-w-xs rounded overflow-hidden shadow-lg m-2">
                    <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                    <div class="px-6 py-4">

                        <div class="text-grey flex">
                            <svg class="h-5 w-5 text-red-500 flex" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{$property->location}}
                        </div>
                        <div class="font-bold text-xl mb-2">{{$property->name}}</div>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <p>
                            Max {{$property->max_guests}} guests
                        </p>

                        @if($property->publish_status == false)
                            <p class="text-red-500">
                                Not published
                            </p>
                        @else
                            <p class="text-green-600">
                                Published
                            </p>
                        @endif


                    </div>
                </a>
            @endforeach
            </div>
        </div>

</x-app-layout>
