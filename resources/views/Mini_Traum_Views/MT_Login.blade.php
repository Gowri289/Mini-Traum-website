<!DOCTYPE html>
<html>
    <title>Mini Traum Login</title>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="/Mini_Traum_CSS/Registration.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        {{-- Header --}}
        <div class="container-fluid" >
            <div class="row pt-3" id="web_title">
                <h2>Mini Traum Website</h2>
            </div>
            <div class="row mt-3">
                <div class="col-4"></div>
                <div class="col-4" id="Login_Form" >
                    <div class="col" id="Login_Title">
                        Login
                    </div>
                    <div class="col">
                        <form action="/login" method="post">
                            @csrf
                        <div class="col py-2">
                            <label for="Mini_Traum_Login_Email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="Mini_Traum_Login_Email" placeholder="name@example.com"
                                value={{request()->session()->has('flashedEmail') ? request()->session()->get('flashedEmail') : ''}}>
                            @if(!empty($login_errors) && !empty($login_errors['empty_email']))
                            <span id="error_msg" style=" font-size: 14px; color: red;">Email cannot be empty</span>
                            @elseif(!empty($login_errors) && !empty($login_errors['user_not_exists']))
                            <span id="error_msg" style=" font-size: 14px; color: red;">User with this email does not exist</span>
                            @endif
                          </div>
                        <div class="col py-2">
                            <label for="Mini_Traum_Login_Password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="Mini_Traum_Login_Password" placeholder="Password">
                          @if(!empty($login_errors) && !empty($login_errors['empty_password']))
                          <span id="error_msg" style=" font-size: 14px; color: red;">Password cannot be empty</span>
                          @elseif(!empty($login_errors) && !empty($login_errors['incorrect_credentials']))
                          <span id="error_msg" style=" font-size: 14px; color: red;">Please Enter Correct Password</span>
                          @endif
                          </div>
                          <div class="col pt-1">
                        <p>Not a user? Resgister <a href="/register">Here </a></p>
                          </div>
                          <div class="col py-2">
                            <button class="btn btn-primary px-5" type="submit">Login</button>
                          </div>
                    </form>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
        {{-- Modal to display errors --}}
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Errors while logging in</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Incorrect Email address</p>
                  <p>Incorrect password</p>
                </div>
              </div>
            </div>
          </div>
    </body>
</html>
