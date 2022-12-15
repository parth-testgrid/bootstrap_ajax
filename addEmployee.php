<?php
// $filename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
// if ($filename === 'addEmployee.php') {
//   header("location: 404.php");
// }
?>

<style>
  .error {
    color: red;
  }
</style>
<div class="container-fluid">

  <form id="new-employee-form" class="" method="post">
    <h1>New Employee</h1>
    <div class="row mb-4">
      <div class="name col-md-4">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name">
        <span id="name_error" class="text-danger error">
        </span>
      </div>
      <div class="name col-md-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
        <span id="email_error" class="text-danger error">
        </span>
      </div>
      <div class="bday col-md-4">
        <label for="">Birthday</label>
        <input class="form-control" id="birthday" name="birthday" type="date">
        <span id="birthday_error" class="text-danger error">
        </span>
      </div>
    </div>
    <div class="row mb-4 align-items-end">
      <div class="password col-md-4">
        <label for="">Password</label>
        <input class="form-control" type="password" name="password" id="password">
        <span id="password_error" class="text-danger error">
        </span>
      </div>
      <div class="gender align-self-center col-md-4">
        <label for="">Gender</label>
        <br>
        <input class="form-check-input" id="male" value="male" name="gender" type="radio">
        <label class="me-3" for="">Male</label>
        <input class="form-check-input" id="female" value="female" name="gender" type="radio">
        <label for="">Female</label>
        <br>
        <!-- <label id="gender-error" class="error" for="gender">Please select gender</label> -->
        <span id="gender_error" class="text-danger error">
        </span>
      </div>
    </div>
    <div class="row mb-4">
      <div class="marital-status col-md-4">
        <label for="">Marital Status</label>
        <br>
        <input class="form-check-input" id="married" value="married" name="marital_status" type="radio">
        <label class="me-3" for="">Married</label>
        <input class="form-check-input" id="unmarried" value="unmarried" name="marital_status" type="radio">
        <label for="">UnMarried</label>
        <br>
        <span id="marital_status_error" class="text-danger error">
        </span>
      </div>
      <div class="hobbies col-md-4">
        <label for="">Hobby</label>
        <br>
        <select class="form-select" name="hobby" id="hobby">
          <option value="reading">Reading</option>
          <option value="travelling">Travelling</option>
          <option value="singing">Singing</option>
        </select>
        <span id="hobby_error" class="text-danger error">
        </span>
      </div>
      <div class="description col-md-4">
        <label for="">Description</label>
        <textarea class="form-control" name="description" id="description" cols="70" rows="5" placeholder="Description"></textarea>
        <span id="description_error" class="text-danger error">
        </span>
      </div>
    </div>
    <div class="form-actions d-flex justify-content-end gap-2">
      <button id="submit" class="btn btn-primary" type="submit">Submit</button>
      <button class="btn btn-primary" id="reset" type="reset">Reset</button>
    </div>
  </form>
</div>

<script>
  $(document).ready(function() {
    $.validator.addMethod("pwcheck", function(value) {
      return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
        &&
        /[a-z]/.test(value) // has a lowercase letter
        &&
        /\d/.test(value) // has a digit
    })
    $("#new-employee-form").validate({
      ignore: "hidden",
      rules: {
        name: 'required',
        email: 'required',
        password: {
          required: true,
          pwcheck: true,
        },
      },
      messages: {
        name: "Please enter your name",
        email: "Please enter email",
        password: {
          required: "Please enter password",
          pwcheck: "Password should have atleast 8 characters, one lower case and a digit"
        },
      },
      groups: {
        gender: "male female",
        marital_status: "married unmarried",
      },
      errorPlacement: function(error, element) {
        switch (element.attr("name")) {
          case "name":
            error.insertBefore("#name_error");
            break;
          case "email":
            error.insertBefore("#email_error");
            break;
          case "password":
            error.insertBefore("#password_error");
            break;

          default:
            break;
        }
      },
      submitHandler: function(form) {
        console.log(form);
        $.ajax({
          type: "POST",
          url: "ajax/ajax_add_emp.php",
          data: $(form).serialize(),
          success: function(response) {
            console.log(response);
            if (response == 1) {
              $('#new-employee-form').trigger('reset');
              window.location.href = 'http://localhost/bootstrap_ajax';
            } else {
              alert("something went wrong");
            }
          }
        });
      }
    });
    $('#reset').click(function(e) {
      $('.error').html('');
    });
  });
</script>