<!DOCTYPE html>
<html>
    <title>Mini Traum Register</title>
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
                        Register
                    </div>
                    <div class="col">
                        <form action="/register" method="post">
                            @csrf
                        <div class="col pt-2 pd-1">
                            <label for="Mini_Traum_Register_Name" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="Mini_Traum_Register_Name" placeholder="Name"
                                   value={{request()->session()->has('flashedUserName') ? request()->session()->get('flashedUserName') : ''}}
                            >
                            @if(!empty($reg_errors) && !empty($reg_errors['empty_name']))
                            <span id="error_msg">User Name cannot be empty</span>
                            @endif
                          </div>
                          <div class="col pt-2 pd-1">
                            <label for="Mini_Traum_Register_Email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="Mini_Traum_Register_Email" placeholder="name@example.com"
                                   value={{request()->session()->has('flashedEmail') ? request()->session()->get('flashedEmail') : ''}}
                            >
                              @if(!empty($reg_errors) && !empty($reg_errors['empty_email']))
                                  <span id="error_msg">Email cannot be empty</span>
                              @elseif(!empty($reg_errors) && !empty($reg_errors['user_exists']))
                                  <span id="error_msg">User with this Email already exists</span>
                              @endif
                          </div>
                        <div class="col pt-2 pd-1">
                            <label for="Mini_Traum_Register_Password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="Mini_Traum_Register_Password" placeholder="Password">
                            @if(!empty($reg_errors) && !empty($reg_errors['empty_password']))
                            <span id="error_msg">Password Cannot be empty</span>
                            @endif
                          </div>
                          <div class="col pt-2 pd-1">
                            <label for="Mini_Traum_Register_ConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="Mini_Traum_Register_ConfirmPassword" placeholder="Confirm Password">
                              @if(!empty($reg_errors) && !empty($reg_errors['empty_confirm_password']))
                              <span id="error_msg">Confirm Password cannot be empty</span>
                              @elseif(!empty($reg_errors) && !empty($reg_errors['password_not_match']))
                                  <span id="error_msg">Password and Confirm password should be same</span>
                              @endif
                          </div>
                          <div class="col pt-2 pd-1" style="text-align: center">
                        <p>Already a user? Login <a href="/login">Here </a></p>
                          </div>
                          <div class="row">
                            <div class="col py-2">
                                <button class="btn btn-primary px-3" type="submit" name="Mini_Traum_User_Type" value="guest">Register as Guest</button>
                              </div>
                              <div class="col py-2">
                                <button class="btn btn-primary" type="submit" name="Mini_Traum_User_Type" value="owner">Register as Owner</button>
                              </div>
                          </div>
                    </form>
                    </div>
                </div>
                <div class="col-4"> </div>
            </div>
        </div>
        {{-- Modal to display errors --}}
        <div class="modal" tabindex="-1" id="register_model">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Errors while logging in</h5>
                  <button type="button" class="btn-close" id="register_model_close"></button>
                </div>
                <div class="modal-body">
                  <p>Incorrect Email address</p>
                  <p>Incorrect password</p>
                  <p>Enter same passwords in both fields</p>
                  <p>User Already Exists</p>
                </div>
              </div>
            </div>
          </div>
{{--    Script to display errors--}}
    <script>
        // $('dcoument').ready(function (){
        //     $('#register_model').show();
        //     $('#register_model_close').onclick(function (){
        //         $('#register_model').hide();
        //     });
        // });
    </script>
    </body>
</html>
