$('#logout').click(function (e) {
  console.log("clicked logout");
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: "logout.php",
    data: { logout: "logout" },
    success: function (response) {
      console.log(response);
      if (response == 1) {
        window.location.href = 'login';
      }
    }
  });
});