<!DOCTYPE html>
<html>
<title>propertyDetails</title>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/Mini_Traum_CSS/Guest.css">
</head>

<body>


<div class="container-fluid ">
    <div class="row" id="webTitle">
        <div class="col-8">
            <h1>Mini Traum Website</h1>
        </div>
        <div class="col-4">
            <a href="/dashboard" type="button" class="btn btn-primary btn-lg btn-block px-4 py-1 mt-2">Dashboard</a>
        </div>
    </div>

    <form action="/{{$property->id}}/store" method="POST">
        @csrf
        <div class="container-sm mt-5" id="dataContainer">
            <div class="row">
                <div class="col-7">
                    <div class="row">
                        <h1 class="jumbotron-heading">{{strtoupper($property->name)}}</h1>
                    </div>
                    <div class="row">
                        <h3>{{$property->location}}</h3>
                    </div>
                    <div class="row">
                        <h3>Max Guests : {{$property->max_guests}}</h3>
                    </div>
                    <div class="row">
                        <img class="pd-2"
                             src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Nnx8aG90ZWx8ZW58MHx8MHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=5000"
                             alt="Card image cap">
                    </div>
                </div>

                <div class="col-5 p-0" id="searchOptions">
                    <div class="container-fluid">
                        <div class="row py-4" id="searchOptions-row1">
                            <h3>Vacation Detiails</h3>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="fromDate" class="form-label">From Date</label>
                                <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')"
                                       class="form-control py-3" name="fromDate" placeholder="From Date"
                                       min="{{date('Y-m-d')}}" value="{{$request->fromDate}}">
                            </div>
                            <div class="col">
                                <label for="toDate" class="form-label">To Date</label>
                                <input type="text" onfocus="(this.type = 'date')" onblur="(this.type = 'text')"
                                       class="form-control py-3" name="toDate" placeholder="To Date"
                                       min="{{date('Y-m-d')}}" value="{{$request->toDate}}">
                            </div>
                        </div>
                        <div class="row py-4" id="searchOptions-row2">
                            <label for="guestCount" class="form-label">Guest Count</label>
                            <input type="number" class="form-control py-3 " name="guestCount" placeholder="Guests"
                                   min="1" value="{{$request->guestCount}}">
                        </div>
                        <div class="row mt-4">
                            <button class="btn btn-warning my-3 btn-lg" type="submit">Send an enquiry to owner</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


</div>
</body>

</html>


