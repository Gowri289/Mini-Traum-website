<x-app-layout>



    <x-slot name="header">

        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Create') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <form method="POST" action="{{ route('properties.store') }}">
                    @csrf

                    <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Property Title')"></x-label>

                            <x-input id="name" class="block mt-1 py-2 w-full" type="text" name="name" required autofocus></x-input>
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <x-label for="location" :value="__('Location')"></x-label>

                            <x-input id="location" class=" block mt-1 w-full py-2 " type="text" name="location"  required></x-input>
                        </div>

                        <!-- Max Guests -->
                        <div class="mt-4">
                            <x-label for="max_guests" :value="__('Max Guests')"></x-label>

                            <x-input id="max_guests" class="block mt-1 py-2 w-full"
                                     type="number"
                                     name="max_guests" min="1" ></x-input>
                        </div>





                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Publish') }}
                            </x-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
