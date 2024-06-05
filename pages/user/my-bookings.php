<?php
require '../../backend/db.php';
include '../../backend/functions.php';
include '../../backend/session.php';
include '../../backend/check_session.php';

echo '<title>My Bookings</title>';

if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
}

?>


<?php include '../../layouts/_layout_main_header.php' ?>

<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <img class="bi me-2" width="30%" height="auto" role="img" aria-label="Comapany Logo" src="../../resources/images/logo/kainan-landscape.png">
      </a>
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
        <li><a href="my-bookings.php" class="nav-link px-2 text-secondary">My Bookings</a></li>
      </ul>
      <div class="text-end">
        <a href="profile.php"><button type="button" class="btn btn-warning">Profile</button></a>
        <a href="../../backend/logout.php?logout=true"><button type="button" class="btn btn-outline-light me-2">Logout</button></a>
      </div>
    </div>
  </div>
</header>
<main>
  <div class="hero">
    <p>No Bookings Yet</p>
  </div>
</main>
<?php include '../../layouts/_layout_main_footer.php' ?>
</body>

</html>