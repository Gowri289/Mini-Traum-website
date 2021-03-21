<!DOCTYPE html>
<html>
<title>Mini Traum Login</title>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/Mini_Traum_CSS/Guest.css">
</head>
<body>
{{-- Header --}}
<div class="container-fluid" >
    <div class="row" id="web_title">
        <h2>Mini Traum Website</h2>
        <a href="/guest">Home</a>
    </div>
</div>
<div class="row">
    <div class="container-fluid" id='property_container'>
        <div class="row my-3 p-3" id="property_display">
            <div class="col">
                <span>Property Name</span>
            </div>
            <div class="col">
                Property Location
            </div>
            <div class="col">
                Number of Guests
            </div>
            <div class="col">
                <button class="btn btn-success disabled px-5" >Accepted</button>
            </div>
        </div>
        <div class="row my-3 p-3" id="property_display">
            <div class="col">
                <span>Property Name</span>
            </div>
            <div class="col">
                Property Location
            </div>
            <div class="col">
                Number of Guests
            </div>
            <div class="col">
                <button class="btn btn-primary disabled px-5" >Pending</button>
            </div>
        </div>
        <div class="row my-3 p-3" id="property_display">
            <div class="col">
                <span>Property Name</span>
            </div>
            <div class="col">
                Property Location
            </div>
            <div class="col">
                Number of Guests
            </div>
            <div class="col">
                <button class="btn btn-danger disabled px-5" >Rejected</button>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>



