<h1 class="text-center">Employees List</h1>
<div class="mb-4">
  <a id="add_new2" role="button" class="btn btn-primary text-white p-2" class="nav-link employee-action px-3">Add New</a>
  <?php
  if (isset($_POST['pageid'])) {
    $current_page = $_POST['pageid'];
  } else {
    $current_page = 1;
  }
  ?>
  <input type="text" hidden id="current_page" value="<?= $current_page ?>">
</div>
<?php
require_once "../config.php";

if (session_status() == 1) {
  session_start();
}

$results_per_page = 4;

$current_user_id = $_SESSION['user_id'];

// total no of results stored in database
$sqlQuery = "SELECT * FROM employees WHERE parent_id = $current_user_id";
if ($result = mysqli_query($conn, $sqlQuery)) {
  $numOfRows = mysqli_num_rows($result);
  if ($numOfRows > 0) {

    // determine which page no the visitor is currently on
    if (isset($_REQUEST['pageid'])) {
      $page = $_REQUEST['pageid'];
    } else {
      $page = 1;
    }

    // determine the sql LIMIT starting number for the results on the displaying page  
    $start_from = ($page - 1) * $results_per_page;

    // retrive the selected results from database
    $retrieveQuery = "SELECT * FROM employees WHERE parent_id = $current_user_id LIMIT $start_from, $results_per_page";
    $result = mysqli_query($conn, $retrieveQuery);
?>
    <table border="solid 1px black" style="border-collapse: collapse" class="employee_table table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Birthday</th>
          <th>Gender</th>
          <th>Marital status</th>
          <th>Hobby</th>
          <th>Description</th>
          <th>Parent ID</th>
          <th colspan="3" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr id="<?php echo $row['id'] ?>">
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['birthday'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['marital_status'] ?></td>
            <td><?php echo $row['hobby'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><?php echo $row['parent_id'] ?></td>
            <td><a role="button" id="<?php echo $row['id'] ?>" class="view_employee btn btn-info">View</a></td>
            <td><a role="button" id="<?php echo $row['id'] ?>" class="edit_employee btn btn-warning">Edit</a></td>
            <td><a role="button" id="<?php echo $row['id'] ?>" class="delete_employee btn btn-danger">Delete</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php
  } else { ?>
    <p>No data found</p>
  <?php }
} else { ?>
  <p>Something went wrong</p>
<?php }
mysqli_close($conn);
?>

<script>
  $(document).ready(function() {
    $.ajax({
      type: "POST",
      url: "employeeList.php",
      data: {
        current_page_id: $('#current_page').val(),
      },
    });
  });

  $('#add_new2').click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "addEmployee.php",
      data: {
        action: "add_new",
      },
      success: function(response) {
        $('#main-content').html(response);
      }
    });
  });

  $('.view_employee').click(function(e) {
    const id = e.target.id;
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "viewEmployee.php",
      data: {
        action: "view_employee",
        id
      },
      success: function(response) {
        $('#main-content').html(response);
      }
    });
  });

  $('.edit_employee').click(function(e) {
    const id = e.target.id;
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "editEmployee.php",
      data: {
        action: "edit_employee",
        id
      },
      success: function(response) {
        $('#main-content').html(response);
      }
    });
  });

  $('.delete_employee').click(function(e) {
    const id = e.target.id;
    e.preventDefault();

    swal({
        title: "Are you sure?",
        text: "This Will Delete the record permanentely",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes!",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "POST",
            url: "ajax/ajax_delete_emp.php",
            data: {
              action: "edit_employee",
              id
            },
            success: function(response) {
              if (response == 1) {
                e.target.closest('tr').remove();
              }
            }
          });
          swal("Deleted!", "Employee has been deleted successfully.", "success");
        } else {
          swal("Cancelled", "Your employee is safe :)", "error");
        }
      });

  });
</script>