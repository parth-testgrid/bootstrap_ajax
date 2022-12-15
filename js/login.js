$('#submit').click(function (e) {
  e.preventDefault();

  const email = $.trim($('#email').val());
  const password = $.trim($('#password').val());

  let errors = {};
  if (!email) {
    $('.email_error').html('Please enter email');
    errors.email_error = 'email_error';
  } else {
    $('.email_error').html('');
  }
  if (!password) {
    $('.password_error').html('Please enter password');
    errors.password_error = 'password_error';
  } else {
    $('.password_error').html('');
  }

  if (Object.keys(errors).length == 0) {
    $.ajax({
      type: "POST",
      url: "ajax/ajax_signin.php",
      data: {
        email, password
      },
      success: function (response) {
        console.log(response);
        if (response == 1) {
          window.location.href = './';
          $('.message').html('');
        } else {
          $('.message').html('Email or password is incorrect');
        }
      }
    });
  }
});