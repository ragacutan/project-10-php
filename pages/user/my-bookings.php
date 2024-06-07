<?php
require '../../backend/db.php';
include '../../backend/functions.php';
include '../../backend/session.php';
include '../../backend/check_session.php';

$my_bookings = get_my_booking($_SESSION['id']);

echo '<title>My Bookings</title>';

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $query = "DELETE FROM  `bookings` WHERE `id` = '$id'";
  if (mysqli_query($connection, $query)) {
      header("Location: my-bookings.php");
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
          <li><a href="my-bookings.php" class="nav-link px-2 text-secondary">My Bookings</a></li>
        </ul>
        <div class="text-end">
          <a href="profile.php"><button type="button" class="btn btn-warning">Profile</button></a>
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
            <?php if (!empty($my_bookings)) { ?>
              <?php foreach ($my_bookings as $row) { ?>
                <div class="col">
                  <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                      xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                      preserveAspectRatio="xMidYMid slice" focusable="false">
                      <title>Placeholder</title>
                      <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                        dy=".3em">Thumbnail</text>
                    </svg>
                    <div class="card-body">
                      <p> <span class="fw-bold"> Date Booked: </span><?= date("F m, Y @ g:H a", strtotime($row['date_created'])); ?></p>
                      <p> <span class="fw-bold"> Scheduled Booked: </span><?= date("F m, Y", strtotime($row['date'])); ?> @ <?= $row['time']?></p>
                      <p class="card-text fw-bold">REMARKS:</p>
                      <p class="card-text"><?= $row['remarks'] ?></p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                          <a  class="btn btn-sm btn-outline-secondary"  href="my-bookings.php?id=<?= $row['booking_id']?>"><i class='dw dw-delete-3'></i> Delete</a>
                        </div>
                        <small class="text-muted">9 mins</small>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
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