<?php
require_once "config.php";
include_once "actions.php";
?>
<div id="container" class="container-fluid employee-list">
  <div class="table-content">
  </div>
  <div class="pagination">
    <?php
    $results_per_page = 4;

    if (isset($_POST['current_page_id'])) {
      $current_page_id = $_POST['current_page_id'];
    } else {
      $current_page_id = 1;
    }

    $current_user_id = $_SESSION['user_id'];

    $selectQuery = "SELECT COUNT(id) FROM employees WHERE parent_id = $current_user_id";
    $countResult = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_row($countResult);
    $total_records = $row[0];

    // total no of pages
    $totalNumOfPages = ceil($total_records / $results_per_page);
    $pageLink = '';


    echo '<a data-pageid="1" class="me-2 btn btn-info first_btn d-none"> First </a>';
    echo '<a data-pageid="" class="me-2 d-none prev_btn btn btn-primary"> Prev </a>';

    for ($i = 1; $i <= $totalNumOfPages; $i++) {
      if ($i == 1) {
        $pageLink .= '<a data-pageid="' . $i . '" class="mx-1 active btn btn-primary" >' . $i . '</a>';
      } else {
        $pageLink .= '<a data-pageid="' . $i . '" class="mx-1 btn btn-primary">' . $i . '</a>';
      }
    }

    echo $pageLink;

    echo '<a data-pageid="2" class="ms-2 next_btn btn btn-primary">Next</a>';
    echo '<a data-pageid="' . $totalNumOfPages . '" class="ms-2 btn btn-info last_btn"> Last </a>';
    ?>
    <input type="text" hidden id="total_rows" value="<?php echo $totalNumOfPages ?>">

  </div>
</div>

<script>
  $(document).ready(function() {
    $.ajax({
      type: "POST",
      url: "ajax/pagination.php",
      success: function(response) {
        $('.table-content').html(response);
      }
    });
  });

  $('[data-pageid]').click(function(e) {
    e.preventDefault();
    var pageid = e.target.attributes['data-pageid'].value;
    const total_rows = $('#total_rows').val();
    $.ajax({
      type: "POST",
      url: "ajax/pagination.php",
      data: {
        pageid
      },
      success: function(response) {
        $('.table-content').html(response);

        const current_page = $('#current_page').val();

        // Logic for previous button
        if (current_page > 1) {
          $('.prev_btn').attr('data-pageid', +current_page - 1);
          $('.prev_btn').removeClass('d-none');
        } else {
          $('.prev_btn').addClass('d-none');
        }

        // Logic for next button
        if (current_page < total_rows) {
          $('.next_btn').attr('data-pageid', +current_page + 1);
          $('.next_btn').removeClass('d-none');
        } else {
          $('.next_btn').addClass('d-none');
        }

        if (current_page == total_rows) {
          $('.last_btn').addClass('d-none');
        } else {
          $('.last_btn').removeClass('d-none');
        }

        if (!current_page || current_page == 1) {
          $('.first_btn').addClass('d-none');
        } else {
          $('.first_btn').removeClass('d-none');
        }
      }
    });
  });
</script>