$(document).ready(function () {
  $.validator.addMethod("pwcheck", function (value) {
    return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
      &&
      /[a-z]/.test(value) // has a lowercase letter
      &&
      /\d/.test(value) // has a digit
  });
  $("#signup_form").validate({
    ignore: "hidden",
    rules: {
      name: "required",
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        pwcheck: true,
      },
      password_again: {
        required: true,
        equalTo: "#password",
      }
    },
    messages: {
      name: "Please enter name",
      email: {
        required: "Please enter an email",
        email: "Please enter a valid email",
      },
      password: {
        required: "please enter password",
        pwcheck: "Password should have atleast 8 characters, one lower case and a digit",
      },
      password_again: {
        required: "Please enter password again",
        equalTo: "Passwords do not match, please enter same password again",
      }
    },
    errorPlacement: function (error, element) {
      switch (element.attr("name")) {
        case "name":
          error.insertBefore(".name_error");
          break;
        case "email":
          error.insertBefore(".email_error");
          break;
        case "password":
          error.insertBefore(".password_error");
          break;
        case "password_again":
          error.insertBefore(".password_again_error");
          break;

        default:
          break;
      }
    },
    submitHandler: function (form) {
      console.log(form);
      $.ajax({
        type: "POST",
        url: "ajax/ajax_signup.php",
        data: $(form).serialize(),
        success: function (response) {
          console.log(response);
          if (response == 1) {
            swal("Success!", "Signed Up successfully!", "success");
            $('#signup_form').trigger('reset');
            // window.location.href = 'login.php';
          }
          if (response == 2) {
            swal("A user with this email already exists!");
          }
        }
      });
    }
  });
});


// $('#submit').click(function (e) {
//   e.preventDefault();
  // const name = $.trim($('#name').val());
  // const email = $.trim($('#email').val());
  // const password = $.trim($('#password').val());
  // const password_again = $.trim($('#password_again').val());

  // let errors = {};
  // if (!name) {
  //   $('.name_error').html('Please enter name');
  //   errors.name_error = 'name_error';
  // } else {
  //   $('.name_error').html('');
  // }
  // if (!email) {
  //   $('.email_error').html('Please enter email');
  //   errors.email_error = 'email_error';
  // } else {
  //   $('.email_error').html('');
  // }
  // if (!password) {
  //   $('.password_error').html('Please enter password');
  //   errors.password_error = 'password_error';
  // } else {
  //   $('.password_error').html('');
  // }
  // if (!password_again) {
  //   $('.password_again_error').html('Please enter password again');
  //   errors.password_again_error = 'password_again_error';
  // } else {
  //   $('.password_again_error').html('');
  // }
  // if (password_again !== password) {
  //   $('.password_again_error').html('Passwords do not match');
  //   errors.password_again_error = 'password_again_error';
  // }

  // if (Object.keys(errors).length == 0) {
  //   $.ajax({
  //     type: "POST",
  //     url: "ajax/ajax_signup.php",
  //     data: {
  //       name,
  //       email,
  //       password,
  //       password_again
  //     },
  //     success: function (response) {
  //       console.log(response);
  //       if (response == 1) {
  //         swal("Success!", "Signed Up successfully!", "success");
  //         $('#signup_form').trigger('reset');
  //         // window.location.href = 'login.php';
  //       }
  //       if (response == 2) {
  //         swal("A user with this email already exists!");
  //       }
  //     }
  //   });
  // }

// });
