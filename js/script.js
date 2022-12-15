const charts = document.querySelectorAll(".chart");
if (params) {
  var request = JSON.parse(params);
}
charts.forEach(function (chart) {
  var ctx = chart.getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [
        {
          label: "# of Votes",
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});

$(document).ready(function () {
  $(".data-table").each(function (_, table) {
    $(table).DataTable();
  });
});

const sidebarACtion = document.querySelector('.employee-actions');

$(document).ready(function () {
  $('#add_new').click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "ajax/ajax_load.php",
      data: {
        action: "add_new",
      },
      success: function (response) {
        $('#main-content').html(response);
      }
    });
  });

  $("#profile").click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "profile.php",
      success: function (response) {
        $('#main-content').html(response);
      }
    });
  });

  $('#view_all').click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "ajax/ajax_load.php",
      data: {
        action: "employee_list",
        page: request.page
      },
      success: function (response) {
        $('#main-content').html(response);
      }
    });
  });

  $("#view_tree").click(function (e) { 
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "ajax/user_tree.php",
      success: function (response) {
        console.log(response);
        $('#main-content').html(response);                
      }
    });
  });

  $.ajax({
    type: "POST",
    url: "ajax/ajax_load.php",
    data: {
      action: "employee_list",
      page: request.page
    },
    success: function (response) {
      $('#main-content').html(response);
    }
  });
});