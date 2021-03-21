<!DOCTYPE html>
<html>
<title>Mini Traum Login</title>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/Mini_Traum_CSS/Guest.css">
</head>
<body>


    <div class="container-fluid " >
        <div class="row" id="webTitle">
            <div class="col-8">
                <h1 >Mini Traum Website</h1>
            </div>
            <div class="col-2">
                <a href="/dashboard" class="btn btn-primary mt-2" >Dashboard</a>
            </div>
            <div class="col-2">
                <a href="/logout" class="btn btn-danger mt-2 px-4">Logout</a>
            </div>
        </div> 
    </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-8 text-primary mt-4">
            <h1 >Future Bookings<span><i class="fas fa-arrow-down"></i></span></h1>
        </div>
    </div>
</div>


<div class="table-responsive pt-5">
    <table class="table table-striped table-hover table-condensed">
        <thead>
        <tr>
            <th><strong>Property name</strong></th>
            <th><strong>location</strong></th>
            <th><strong>From Date</strong></th>
            <th><strong>To date</strong></th>
            <th><strong>No. of Guests</strong></th>
            <th><strong>Booking Status</strong></th>
            <th><strong>Cancel/Update</strong></th>
        </tr>
        </thead>
        @foreach($bookings as $booking)
            <tbody>
            <tr class="my-2">
                <td>{{strtoupper($booking->property->name)}}</td>
                <td>{{strtoupper($booking->property->location)}}</td>
                <td>{{$booking->from_date}}</td>
                <td>{{$booking->to_date}}</td>
                <td>{{$booking->guest_count}}</td>
                @if($booking->status == 'pending')
                    <th>
                        <p class="text-warning">
                            PENDING
                        </p>
                    </th>
                @elseif($booking->status == 'accept')
                    <th >
                        <p class="text-success">
                           ACCEPTED
                        </p>
                    </th>
                @else
                    <th >
                        <p class="text-danger">
                            REJECTED
                        </p>
                    </th>
                @endif
                <th>
                    @if($booking->status == 'pending')
                        <a href="/upComingBookings/{{$booking->id}}/edit" class="btn btn-success">Edit</a>
                        <a href="/upComingBookings/{{$booking->id}}/cancel" class="btn btn-danger"> Cancel</a>
                    @endif
                </th>
            </tr>

            </tbody>
        @endforeach
    </table>
</div>

</body>
</html>
