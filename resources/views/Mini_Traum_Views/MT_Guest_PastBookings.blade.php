<!DOCTYPE html>
<html>
<title>Mini Traum Login</title>
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/Mini_Traum_CSS/Guest.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>


<div class="container-fluid " >
    <div class="row" id="webTitle">
        <div class="col-8">
            <h1 >Mini Traum Website</h1>
        </div>
        <div class="col-4">
            <a href="/dashboard" type="button" class="btn btn-primary btn-lg btn-block px-4 py-1 mt-2">Dashboard</a>
        </div>
    </div> 
</div>

<div class="container-fluid">
    <div class="row mt-3 text-danger">
            <h1 >Past Bookings<span><i class="fas fa-arrow-down"></i></span></h1>
    </div>
</div>


<div class="table-responsive t pt-5">
    <table class="table table-striped table-hover table-condensed">
        <thead>
        <tr>
            <th><strong>Property name</strong></th>
            <th><strong>Location</strong></th>
            <th><strong>From Date</strong></th>
            <th><strong>To date</strong></th>
            <th><strong>No. of Guests</strong></th>
        </tr>
        </thead>
        @foreach($bookings as $booking)
            <tbody>
            <tr>
                <th>{{strtoupper($booking->property->name)}}</th>
                <th>{{strtoupper($booking->property->location)}}</th>
                <th>{{$booking->from_date}}</th>
                <th>{{$booking->to_date}}</th>
                <th>{{$booking->guest_count}}</th>
            </tr>
            @endforeach
            </tbody>
    </table>
</div>
</div>



</body>
</html>
