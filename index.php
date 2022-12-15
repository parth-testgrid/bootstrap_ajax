<?php
session_start();

if (!isset($_SESSION['current_user'])) {
  session_reset();
  header('location: login');
}

include_once "actions.php";

if (isset($_SESSION['current_user'])) {
  $current_user = $_SESSION['current_user'];
  $user_id = $_SESSION['user_id'];
}

?>
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
  <title>Employee management</title>
  <script src="./js/jquery-3.6.1.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js" defer></script>
  <!-- <script src="./js/jquery.validate.js" defer></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js" defer></script>
  <script src="./js/jquery.dataTables.min.js" defer></script>
  <script src="./js/dataTables.bootstrap5.min.js" defer></script>
  <script src="./js/bootstrap.bundle.min.js" defer></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js" integrity="sha512-XVz1P4Cymt04puwm5OITPm5gylyyj5vkahvf64T8xlt/ybeTpz4oHqJVIeDtDoF5kSrXMOUmdYewE4JS/4RWAA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="js/main.js" defer></script>
  <script>
    var params = '<?= json_encode($_REQUEST) ?>';
  </script>
  <script src="js/script.js" defer></script>
</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="./">Employee management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php if (isset($current_user)) { ?>
        <div role="button" id="profile" class="current-user badge bg-info p-2">
          <?php echo $current_user; ?>
          <span class="mx-2">UID: <?php echo $user_id ?></span>
        </div>
      <?php } ?>
      <a role="button" id="logout" class="btn btn-warning ms-2">Logout</a>
    </div>
  </nav>
  <!-- top navigation bar -->
  <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <a href="./" class="nav-link px-3 active">
              <span class="me-2"><i class="bi bi-house-door"></i></span>
              <span>Home</span>
            </a>
          </li>
          <li class="my-2">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Interface
            </div>
          </li>
          <li>
            <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#layouts">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Employees</span>
              <span class="ms-auto">
                <span class="right-icon">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </span>
            </a>
            <div class="collapse show" id="layouts">
              <ul class="navbar-nav ps-3 employee-actions">
                <li>
                  <a role="button" id="<?php echo $add_new ?>" class="nav-link employee-action px-3">
                    Add new
                  </a>
                </li>
                <li>
                  <a role="button" id="<?php echo $view_all ?>" class="nav-link employee-action px-3">
                    View All
                  </a>
                </li>
                <li>
                  <a role="button" id="view_tree" class="nav-link employee-action px-3">
                    View Tree
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- offcanvas -->
  <main class="mt-5 pt-3">
    <div id="main-content" class="container-fluid p-3">
    </div>
  </main>

</body>

</html>