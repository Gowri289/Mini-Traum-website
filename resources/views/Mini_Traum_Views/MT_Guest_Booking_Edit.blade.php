<!DOCTYPE html>
<html>
<title>Edit Booking Details</title>
<head>
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/Mini_Traum_CSS/Guest.css">

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

<div class="container pt-5" >
    <form action="/upComingBookings/{{$bookings->id}}/update"  method="POST">
        @csrf
        @method("POST")
        <div class="row pt-4">
            <div class="col">
                <label for="guestCount" class="form-label">Guest Count</label>
                <input type="number" class="form-control py-3" name="guestCount" placeholder="Guests" min="1" value="{{$bookings->guest_count}}">
            </div>
            <div class="col">
                <label for="fromDate" class="form-label">From Date</label>
                <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" class="form-control py-3" name="fromDate" placeholder="From Date"  value="{{$bookings->from_date}}">
            </div>
            <div class="col">
                <label for="toDate" class="form-label">To Date</label>
                <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" class="form-control py-3" name="toDate" placeholder="To Date"  value="{{$bookings->to_date}}">
            </div>
        </div>

        <div class="row pt-2">
            <button class="btn btn-info btn-block btn-lg" type="submit" >Update</button>
        </div>
    </form>
</div>

</body>
</html>



</body>

</html>


