<!DOCTYPE html>
<html>
<title>Mini Traum Login</title>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/Mini_Traum_CSS/Guest.css">

</head>
<body>
{{-- Header --}}
<div class="container-fluid " >
    <div class="row" id="webTitle">
        <div class="col-8">
            <h1 >Mini Traum Website</h1>
        </div>
        <div class="col-2">
            <a href="/dashboard" type="button" class="btn btn-primary btn-lg btn-block px-2 py-1 mt-2">Dashboard</a>
        </div>
        <div class="col-2">
            <a href="/logout" type="button" class="btn btn-danger btn-lg btn-block px-4 py-1 mt-2">Logout</a>
        </div>
    </div>
    </div>


    <div class="container pt-5" >
        <form action="{{route('searchedProperties')}}"  method="POST">
            @csrf
{{--            @method("POST")--}}
            <div class="row pt-4">
                <div class="col">
                    <input type="text" class="form-control py-3" name="location" placeholder="Location" value="{{$request->location}}">
                </div>
                <div class="col">
                    <input type="number" class="form-control py-3" name="guestCount" min="1" placeholder="Guests" value="{{$request->guestCount}}">
                </div>
                <div class="col">
                    <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" class="form-control py-3" min="{{date('Y-m-d')}}" name="fromDate" placeholder="From Date" value="{{$request->fromDate}}">
                </div>
                <div class="col">
                    <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')" class="form-control py-3" min="{{date('Y-m-d')}}" name="toDate" placeholder="To Date" value="{{$request->toDate}}">
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
                <th><strong>Current Vacancy</strong></th>
                <th><strong>Book</strong></th>
            </tr>
            </thead>
            <tbody>
                @if(empty($properties))
                    <tr>
                        <th>No Matches</th>
                    </tr>
                @else
                    @foreach($properties as $property)
                        <form action="{{route('propertyDetails', ['id'=> $property['property_id'],
                                                                  'fromDate'=>$request->fromDate,
                                                                  'toDate' => $request->toDate,
                                                                  'guestCount' => $request->guestCount,]
                        )}}" method="POST">
                        @csrf
                        <tr>
                            <th>{{$property['name']}}</th>
                            <th>{{$property['location']}}</th>
                            <th>{{$property['max_guests']}}</th>
                            <th>{{$property['vacancy']}}</th>
                            <th><button type="submit" class="btn btn-outline-success" >Details</button>
                            </th>
                        </tr>
                        </form>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
