<?php
session_start();

if (isset($_SESSION['current_user'])) {
  header('location: ./');
}
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Employee Sign Up</title>
  <script src="./js/jquery-3.6.1.min.js" defer></script>
  <script src="./js/jquery.validate.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js" defer></script>
  <script src="./js/jquery.dataTables.min.js" defer></script>
  <script src="./js/dataTables.bootstrap5.min.js" defer></script>
  <script src="./js/bootstrap.bundle.min.js" defer></script>
  <script src="https: //unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js" integrity="sha512-XVz1P4Cymt04puwm5OITPm5gylyyj5vkahvf64T8xlt/ybeTpz4oHqJVIeDtDoF5kSrXMOUmdYewE4JS/4RWAA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="./js/signup.js" defer></script>
</head>

<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="d-flex justify-content-center">
                <div class="">
                  <div class="errors text-center text-danger">
                    <!-- user already exist err -->
                  </div>
                  <div class="success text-center text-success">
                    <!-- registration success -->
                  </div>
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Employee Sign up</p>
                  <form method="POST" id="signup_form" class="mx-1 mx-md-4">
                    <div class="d-flex flex-row align-items-center">
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" name="name" id="name" class="form-control" />
                        <label class="form-label" for="form3Example1c">Your Name</label>
                      </div>
                    </div>
                    <div class="text-danger mb-4 name_error">
                      <!-- name error -->
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="email" name="email" class="form-control" />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                      </div>
                    </div>
                    <div class="text-danger mb-4 email_error">
                      <!-- email error -->
                    </div>
                    <div class="d-flex flex-row align-items-center">
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="password" name="password" class="form-control" />
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>
                    <div class="text-danger mb-4 password_error">
                      <!-- password err -->
                    </div>
                    <div class="d-flex flex-row align-items-center ">
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" name="password_again" id="password_again" class="form-control" />
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                      </div>
                    </div>
                    <div class="text-danger password_again_error mb-4">
                      <!-- enter passsword again err  -->
                      <!-- passsword not match err  -->
                    </div>
                    <div class="d-flex just mx-4 mb-3 mb-lg-4">
                      <button type="submit" id="submit" class="btn btn-primary">Register</button>
                    </div>
                  </form>
                  <div class="text-center">
                    <p class="">Already Have an account? <a class="link btn btn-info ms-2" href="login">Login</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>