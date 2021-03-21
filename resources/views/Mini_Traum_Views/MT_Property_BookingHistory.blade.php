<x-app-layout>



     <x-slot name="header">

        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">{{ __('Past Bookings') }}</h2>
</div>
</x-slot>





<div class="p-6 bg-white border-b border-gray-200 mt-10 mx-10 ">



    @forelse($bookings as $booking)

        <form method="POST" action="{{route('properties.change_status', $booking)}}">
            @csrf
            @method('put')

            <div class="grid grid-cols-3 my-8">



                <div>
                    <div class="font-bold text-lg">{{$booking->property->name}}</div>
                    <div>{{$booking->property->location}}</div>

                </div>


                <div>


                    <div>
                        <div class="font-bold text-lg">{{$booking->guest->name}}</div>
                        <div>{{$booking->guest->email}}</div>

                    </div>
                    <div>From date: {{$booking->from_date}}</div>
                    <div>To date: {{$booking->to_date}}</div>
                    <div>Guests: {{$booking->guest_count}}</div>

                </div>
                @if($booking->status == 'pending')
                    <div>
                        <x-button type="submit" name="action" value="accept" class="bg-green-400">Accept</x-button>
                        <x-button type="submit" name="action" value="reject" class="bg-red-400">Reject</x-button>
                    </div>
                @elseif($booking->status == 'accept')
                    <div >
                        <p class="text-green-500 font-bold text-xl">
                            Accepted
                        </p>
                    </div>
                @else
                    <div >
                        <p class="text-red-500 font-bold text-xl">
                            Rejected
                        </p>
                    </div>
                @endif


            </div>

        </form>

        <hr>
    @empty
        <div class="justify-center font-bold text-xl">
            No past bookings
        </div>
    @endforelse
</div>

</div>


</x-app-layout>
