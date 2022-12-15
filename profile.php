<?php
require_once 'config.php';
include_once 'actions.php';
// if (!isset($_SESSION['current_user']) && isset($_POST['id'])) {
//   header("location: login.php");
// }
// if (isset($_SESSION['current_user']) && !isset($_POST['id'])) {
//   header("location: index.php");
// }
// if (!isset($_SESSION['current_user']) && !isset($_POST['id'])) {
//   header("location: login.php");
// }

if (isset($_SESSION['user_id']) && !empty(trim($_SESSION["user_id"]))) {
  $id = $_SESSION['user_id'];

  $selectQuery = "SELECT * FROM employees WHERE id=$id";

  if ($result = mysqli_query($conn, $selectQuery)) {
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      $name = $row['name'];
      $email = $row['email'];
      $birthday = $row['birthday'];
      $gender = $row['gender'];
      $marital_status = $row['marital_status'];
      $hobby = $row['hobby'];
      $description = trim($row['description']);
    }
  }
  mysqli_close($conn);
} else {
  echo "Something Went wrong!";
}

?>

<div class="container-fluid">
  <form id="edit-employee-form">
    <h1>Edit Profile</h1>
    <div class="row mb-4">
      <div class="name col-md-4">
        <label for="">Name</label>
        <input type="text" name="id" id="id" hidden value="<?php if (isset($id)) echo $id ?>">
        <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) echo $name ?>">
        <span id="name_error" class="text-danger error">
        </span>
      </div>
      <div class="name col-md-4">
        <label for="">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email ?>">
        <span id="email_error" class="text-danger error">
        </span>
      </div>
      <div class="name col-md-4">
        <label for="">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="">
        <span id="password_error" class="text-danger error">
        </span>
      </div>
    </div>
    <div class="row mb-4">
      <div class="bday col-md-4">
        <label for="">Birthday</label>
        <input class="form-control" id="birthday" name="birthday" type="date" value="<?php if (isset($birthday)) echo $birthday ?>">
        <span id="birthday_error" class="text-danger error">
        </span>
      </div>
      <div class="gender col-md-4">
        <label for="">Gender</label>
        <br>
        <input class="form-check-input" id="male" <?php if (isset($gender) && $gender === "male") echo "checked"; ?> value="male" name="gender" type="radio">
        <label class="me-3" for="">Male</label>
        <input class="form-check-input" id="female" <?php if (isset($gender) && $gender === "female") echo "checked"; ?> value="female" name="gender" type="radio">
        <label for="">Female</label>
        <br>
        <span id="gender_error" class="text-danger error">
        </span>
      </div>
      <div class="marital-status col-md-4">
        <label for="">Marital Status</label>
        <br>
        <input class="form-check-input" id="married" <?php if (isset($marital_status) && $marital_status === "married") echo "checked"; ?> value="married" name="marital_status" type="radio">
        <label class="me-3" for="">Married</label>
        <input class="form-check-input" id="unmarried" <?php if (isset($marital_status) && $marital_status === "unmarried") echo "checked"; ?> value="unmarried" name="marital_status" type="radio">
        <label for="">UnMarried</label>
        <br>
        <span id="marital_status_error" class="text-danger error">
        </span>
      </div>
    </div>
    <div class="row mb-4 justify-content-center">
      <div class="hobbies col-md-6">
        <label for="">Hobby</label>
        <br>
        <select class="form-select" name="hobby" id="hobby">
          <option <?php if (isset($hobby) && $hobby == "reading") echo "selected" ?> value="reading">Reading</option>
          <option <?php if (isset($hobby) && $hobby == "travelling") echo "selected" ?> value="travelling">Travelling</option>
          <option <?php if (isset($hobby) && $hobby == "singing") echo "selected" ?> value="singing">Singing</option>
        </select>
        <span id="hobby_error" class="text-danger error">
        </span>
      </div>
      <div class="description col-md-6">
        <label for="">Description</label>
        <textarea class="form-control" name="description" id="description" cols="70" rows="5" placeholder="Description"><?php if (isset($description)) echo trim($description) ?></textarea>
        <span id="description_error" class="text-danger error">
        </span>
      </div>
    </div>
    <div class="form-actions d-flex justify-content-end gap-2">
      <button id="submit" class="btn btn-primary" type="submit">Save</button>
      <button class="btn btn-primary" id="reset" type="reset">Reset</button>
    </div>
  </form>
</div>

<script>
  $(document).ready(function() {
    $('#reset').click(function(e) {
      $('.error').html('');
    });

    $('#submit').click(function(e) {
      e.preventDefault();

      const id = $.trim($('#id').val());
      const name = $.trim($('#name').val());
      const email = $.trim($('#email').val());
      const password = $.trim($('#password').val());
      const birthday = $.trim($('#birthday').val());
      const gender = $('input[name="gender"]:checked').val();
      const marital_status = $('input[name="marital_status"]:checked').val();
      const hobby = $('#hobby').find(":selected").val();
      const description = $.trim($('#description').val());

      let errors = {};
      if (!name) {
        $('#name_error').html('Please enter name');
        errors.name_error = 'name_error';
      } else {
        $('#name_error').html('');
      }
      if (!email) {
        $('#email_error').html('Please enter email');
        errors.email_error = 'email_error';
      } else {
        $('#email_error').html('');
      }
      if (!password) {
        $('#password_error').html('Please enter password');
        errors.password_error = 'password_error';
      } else {
        $('#password_error').html('');
      }
      if (!birthday) {
        $('#birthday_error').html('Please enter birthday');
        errors.birthday_error = 'birthday_error';
      } else {
        $('#birthday_error').html('');
      }
      if (!gender) {
        $('#gender_error').html('Please select gender');
        errors.gender_error = 'gender_error';
      } else {
        $('#gender_error').html('');
      }
      if (!marital_status) {
        $('#marital_status_error').html('Please select marital status');
        errors.marital_status_error = 'marital_status_error';
      } else {
        $('#marital_status_error').html('');
      }
      if (!hobby) {
        $('#hobby_error').html('Please select hobby');
        errors.hobby_error = 'hobby_error';
      } else {
        $('#hobby_error').html('');
      }
      if (!description) {
        errors.description_error = 'description_error';
        $('#description_error').html('Please enter description');
      } else {
        $('#description_error').html('');
      }

      console.log(errors);
      if (Object.keys(errors).length == 0) {
        $.ajax({
          type: "POST",
          url: "ajax/ajax_edit_profile.php",
          data: {
            action: 'edit_employee',
            id,
            name,
            email,
            password,
            birthday,
            gender,
            marital_status,
            hobby,
            description
          },
          success: function(response) {
            console.log(response);
            if (response == 1) {
              $('#edit-employee-form').trigger('reset');
              window.location.href = 'http://localhost/bootstrap_ajax';
            } else {
              alert("something went wrong");
            }
          }
        });
      }
    });
  });
</script>