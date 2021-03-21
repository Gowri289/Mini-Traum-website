<!DOCTYPE html>
<html>
<title>Mini Traum Login</title>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/Mini_Traum_CSS/Guest.css">

</head>
<body>
{{-- Header --}}
<div class="container-fluid " >
    <div class="row" id="webTitle">
        <div class="col-8">
            <h1 >Mini Traum Website</h1>
        </div>
        <div class="col-4">
            <a href="/logout" type="button" class="btn btn-danger btn-lg btn-block px-4 py-1 mt-2">Logout</a>
        </div>
    </div>

    {{--    Here we should have two types of dashboards--}}
    {{--    --if user is already login and user type is owner show owner dashboard--}}
    {{--    --if user is already login and user type is guest show guest dashboard--}}


    <div class="row mt-3">
        <div class="col-3 pt-2" id="userData">
            <i class="material-icons">&#xe7fd;</i>  {{$guest->user_name}}
        </div>
        <div class="col-3 pt-2" id="userData">
            <i class="material-icons">&#xe0be;</i> {{$guest->user_email}}
        </div>
        <div class="col-3">
            <a href="/pastBookings"  type="button" class="btn btn-info btn-lg btn-block px-5">My Past Bookings</a>
        </div>
        <div class="col-3">
            <a href="/upComingBookings"  type="button" class="btn btn-info btn-lg btn-block px-2">My UpComing Bookings</a>
        </div>

    </div>


    <div class="container pt-5" >
        <form action="{{route('searchedProperties')}}"  method="POST">
            @csrf
            @method("POST")
            <div class="row pt-4">
                <div class="col">
                    <input type="text" class="form-control py-3" name="location" placeholder="Location">
                </div>
                <div class="col">
                    <input type="number" class="form-control py-3" name="guestCount" min="1" placeholder="Guests">
                </div>
                <div class="col">
                    <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" class="form-control py-3" min="{{date('Y-m-d')}}" name="fromDate" placeholder="From Date">
                </div>
                <div class="col">
                    <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" class="form-control py-3" min="{{date('Y-m-d')}}" name="toDate" placeholder="To Date">
                </div>
                <div class="col">
                    <button class="btn btn-primary px-5 py-2 mt-1" type="submit" >Search</button>
                </div>
            </div>

        </form>
    </div>


    <div class="table-responsive mt-5 px-5">
        <table class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th><strong>Property Name</strong></th>
                <th><strong>Property Location</strong></th>
                <th><strong>Maximum Vacancy</strong></th>
                <th><strong>Book</strong></th>
            </tr>
            </thead>
            <tbody>
            @foreach($properties as $property)
                <tr>
                    <th>{{$property->name}}</th>
                    <th>{{$property->location}}</th>
                    <th>{{$property->max_guests}}</th>
                    <th>
                        <form action="{{route('propertyDetails',[ 'id'=>$property->id,
                                                                                'fromDate'=>date('Y-m-d'),
                                                                                'toDate' => date('Y-m-d',strtotime("tomorrow")),
                                                                                'guestCount' => 1,]
                        )}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-success" >Details</button>
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
