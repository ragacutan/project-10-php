<?php
require '../../backend/db.php';
include '../../backend/functions.php';
include '../../backend/session.php';
include '../../backend/check_session.php';

echo '<title>User Profile</title>';

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
        <li><a href="my-bookings.php" class="nav-link px-2 text-white">My Bookings</a></li>
      </ul>
      <div class="text-end">
        <a href="profile.php"button" class="btn btn-warning">Profile</button></a>
        <a href="../../backend/logout.php?logout=true"><button type="button" class="btn btn-outline-light me-2">Logout</button></a>
      </div>
    </div>
  </div>
</header>
<main>
  <div class="hero">
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 mb-3 text-white">View Profile</h1>
          <p class="col-lg-10 fs-5 text-white" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut quaerat alias commodi
            dolorem sequi eaque rerum inventore veritatis ratione odit voluptatem sed beatae, ipsam voluptatum!
            Provident neque sunt iusto obcaecati!</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <form class="p-4 p-md-5 border rounded-3 bg-light" method="post">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="fname"
                value="<?php echo $row['fname'] ?>" disabled>
              <label for="floatingInput">First Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="lname"
                value="<?php echo $row['lname'] ?>" disabled>
              <label for="floatingInput">Last Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="address"
                value="<?php echo $row['address'] ?>" disabled>
              <label for="floatingInput">Home Address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="contact_number"
                value="<?php echo $row['contact_number'] ?>" disabled>
              <label for="floatingInput">Contact Number</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" value="<?php echo $row['email'] ?>" disabled>
              <label for="floatingInput">Email</label>
            </div>
            <a href="update-profile.php?id=<?php echo $id; ?>"><button class="w-100 btn btn-lg btn-primary"
                type="button">Update Profile</button></a>
            <hr class="my-4">
            <small class="text-muted">Want to go back? <a href="index.php">Go Back</a></small>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include '../../layouts/_layout_main_footer.php' ?>
</body>

</html>