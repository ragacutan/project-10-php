<?php 
require '../../backend/db.php';
include '../../backend/functions.php';
include '../../backend/session.php';
include '../../backend/check_session.php';

echo '<title>User Page</title>';

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
          <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="my-bookings.php" class="nav-link px-2 text-white">My Bookings</a></li>
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
      <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6">
            <img src="resources/images/hero.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700"
              height="500" loading="lazy">
          </div>
          <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Welcome! <span class="text-warning text-decoration-underline"><?php echo $row['fname'] .' '. $row['lname'] ?></span></h1>
            <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most
              popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system,
              extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
              <a href="create-booking.php"><button type="button" class="btn btn-warning btn-lg px-4 me-md-2">Book Now!</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include '../../layouts/_layout_main_footer.php' ?>
</body>

</html>