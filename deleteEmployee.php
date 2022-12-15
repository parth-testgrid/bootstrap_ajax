<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mb-3">Delete Record</h2>
      <form method="post">
        <div class="alert alert-danger">
          <input type="text" hidden id="id" name="id" value="<?php echo trim($_POST["id"]); ?>" />
          <p>Are you sure you want to delete this employee record?</p>
          <div>
            <button type="submit" id="submit" class="btn btn-danger">Yes</button>
            <a href="./" class="btn btn-secondary">No</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('#submit').click(function(e) {
    e.preventDefault();
    const id = $('#id').val();
    console.log(id);
    $.ajax({
      type: "POST",
      url: "ajax/ajax_delete_emp.php",
      data: {
        id,
      },
      success: function(response) {
        if (response == 1) {
          window.location.href = "./";
        } else {
          alert(response)
        }
      }
    });
  });
</script>