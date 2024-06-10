<?php
require '../../backend/db.php';
include '../../backend/functions.php';
include '../../backend/session.php';
include '../../backend/check_session.php';

$all_users = get_all_users();

echo '<title>All Users</title>';

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $query = "DELETE FROM  `users` WHERE `id` = '$id'";
  if (mysqli_query($connection, $query)) {
      header("Location: all-users.php");
  }
}
?>


<?php include '../../layouts/_layout_main_header.php' ?>

<body>
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img class="bi me-2" width="30%" height="auto" role="img" aria-label="Comapany Logo"
            src="../../resources/images/logo/kainan-landscape.png">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="all-bookings.php" class="nav-link px-2 text-white">All Bookings</a></li>
          <li><a href="all-users.php" class="nav-link px-2 text-secondary">All Users</a></li>
        </ul>
        <div class="text-end">
          <a href="../../backend/logout.php?logout=true"><button type="button"
              class="btn btn-outline-light me-2">Logout</button></a>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="hero bg-light">
      <div class="album py-5">
        <div class="container">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php if (!empty($all_users)) { ?>
              <?php foreach ($all_users as $row) { ?>
                <div class="col">
                  <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                      xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                      preserveAspectRatio="xMidYMid slice" focusable="false">
                      <title>Placeholder</title>
                    </svg>
                    <div class="card-body">
                      <p> <span class="fw-bold"> Name of Booker: </span><?= $row['fname'] ?> <?= $row['lname'] ?></p>
                      <p> <span class="fw-bold"> Address: </span><?= $row['address'] ?></p>
                      <p> <span class="fw-bold"> Contact Number: </span><?= $row['contact_number'] ?></p>
                      <p> <span class="fw-bold"> Email: </span><?= $row['email'] ?></p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <a  class="btn btn-sm btn-outline-secondary"  href="all-users.php?id=<?= $row['id']?>"><i class='dw dw-delete-3'></i> Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <?php } else {?>
                <p class="text-alert text-center">No Current Users as of the moment</p>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php include '../../layouts/_layout_main_footer.php' ?>
    </div>
  </main>
  <!-- <script>
        function confirmDelete() {
        // Display an alert to inform the user
        alert("Are you sure you want to delete?");

        // Display a confirmation dialog
        return confirm("This action cannot be undone. Are you sure you want to delete?");
        }
    </script> -->
</body>

</html>