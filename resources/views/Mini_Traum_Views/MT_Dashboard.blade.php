<!DOCTYPE html>
<html>
    <title>Mini Traum Login</title>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="/Mini_Traum_CSS/Dashboard.css">
    </head>
    <body>
        {{-- Header --}}
        <div class="container-fluid" >
            <div class="row" id="web_title">
                    <div class="col-8">
                        <h1>Mini Traum Website</h1>
                        </div>
                    <div class="col-4">
                        <form method="get" action="/logout">
                            @csrf
                            <button class="btn btn-danger px-4 mt-2" type="submit">Logout</button>
                        </form>
                    </div>
            </div>
            <div class="row">
                <h3 >Welcome  <span style="color: blue"> {{$user_data[0]->user_name}}</span> </h3>
                <h3> Email :  <span style="color: blue"> {{$user_data[0]->user_email}}</span> </h3>
                <h3> You are a :  <span style="color: blue"> {{$user_data[0]->user_type}}</span> </h3>

            </div>

        </div>

    </body>
</html>
