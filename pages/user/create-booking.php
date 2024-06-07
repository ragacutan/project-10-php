<?php 
require '../../backend/db.php';
include '../../backend/functions.php';
include '../../backend/session.php';
include '../../backend/check_session.php';

echo '<title>Create Booking</title>';

$categories = get_categories();

if (isset($_POST['submit'])) {
	if (empty($errors)) {
		$save_material = create_booking( $_SESSION['id'],$_POST['category_id'], $_POST['date'], $_POST['time'], $_POST['remarks']);
		if ($save_material) {
			header("Location: my-bookings.php");
		} else {
			$errors[] = "Could not create a blog post. Please try again later.";
		}
	}
}


?>
<?php include '../../layouts/_layout_main_header.php' ?>
<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <img class="bi me-2" width="30%" height="auto" role="img" aria-label="Comapany Logo"
          src="../../resources/images/logo/kainan-landscape.png">
      </a>
      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
        <li><a href="my-bookings.php" class="nav-link px-2 text-white">My Bookings</a></li>
      </ul>
      <div class="text-end">
        <a href="pages/auth/create.php"><button type="button" class="btn btn-warning">Profile</button></a>
        <a href="../../backend/logout.php?logout=true"><button type="button"
            class="btn btn-outline-light me-2">Logout</button></a>
      </div>
    </div>
  </div>
</header>
<main>
  <div class="hero">
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="display-4 fw-bold lh-1 mb-3 text-white">Create Booking</h1>
          <p class="col-lg-10 fs-5 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut quaerat alias commodi
            dolorem sequi eaque rerum inventore veritatis ratione odit voluptatem sed beatae, ipsam voluptatum!
            Provident neque sunt iusto obcaecati!</p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <form class="p-4 p-md-5 border rounded-3 bg-light" method="post">
            <div class="form-floating mb-3">
              <select type="text" class="form-control" id="floatingInput" name="category_id" value="">
                <option value="">--- Select Category ---</option>
									<?php if (!empty($categories)) { ?>
										<?php foreach ($categories as $row) { ?>
											<option value="<?= $row['id'] ?>" <?= ($row['id'] == 'category_id') ? 'selected' : '' ?>>
												<?= $row['category_name'] ?>
											</option>
										<?php } ?>
									<?php } ?>
                </select>
              <label for="floatingInput">Booking Category</label>
            </div>
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="floatingInput" name="date"
                value="">
              <label for="floatingInput">Date</label>
            </div>
            <div class="form-floating mb-3">
              <input type="time" class="form-control" id="floatingInput" name="time"
                value="">
              <label for="floatingInput">Time</label>
            </div>
            <div class="form-floating mb-3">
              <textarea type="text" class="form-control" rows="10" id="floatingInput" name="remarks" value=""></textarea>
              <label for="floatingInput">Remarks</label>
            </div>
            <input class="w-100 btn btn-lg btn-primary" name="submit" type="submit" value="Save Booking">
            <hr class="my-4">
            <small class="text-muted">No Longer Interested?<a href="index.php">Cancel Booking</a></small>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include '../../layouts/_layout_form_footer.php' ?>
</body>

</html>