<?php
require '../../backend/db.php';
include '../../backend/functions.php';

echo '<title>Sign Up</title>';

$errors = [];

if (isset($_POST["submit"])) {

  $errors = validate_save_profile($_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['contact_number'], $_POST['email'], $_POST['password']);

  if (empty($errors)) {
      if (!check_existing_email($_POST['email'])) {
          $user = save_registration($_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['contact_number'], $_POST['email'], $_POST['password']);
          if (!empty($user)) {
              $_SESSION['id'] = $user['id'];
              $_SESSION['email'] = $user['email'];
          }
          // Redirect to home page
          header("Location: login.php");
      } else {
          $errors[] = "The email address is already existing.";
      }
  }
}
?>

<?php include '../../layouts/_layout_form_header.php' ?>
<body class="text-center">
  <main class="form-signin">
    <form method="POST">
      <img class="mb-4" src="../../resources/images/Logo/kainan-icon-only.png" alt="" width="200" height="200">
      <h1 class="h3 mb-3 fw-normal">Create An Account</h1>
      <span style="font-size: 15px;">
        <?php if (!empty($errors)) { ?>
          <?php include "../../layouts/_error_message.php" ?>
        <?php } ?>
			</span>
      <div class="form-floating">
        <input type="text" name="fname" id="fname" class="form-control" id="floatingInput" placeholder="eg. John">
        <label for="floatingInput">First Name</label>
      </div>
      <div class="form-floating">
        <input type="text" name="lname" id="lname" class="form-control" id="floatingInput" placeholder="eg. Doe">
        <label for="floatingInput">Last Name</label>
      </div>
      <div class="form-floating">
        <input type="text" name="address" id="address" class="form-control" id="floatingInput" placeholder="eg. 20th Street, Manila">
        <label for="floatingInput">Home Address</label>
      </div>
      <div class="form-floating">
        <input type="number" name="contact_number" id="contact_number" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Contact Number</label>
      </div>
      </div>
      <div class="form-floating">
        <input type="email" name="email" id="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" id="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign Up</button>
      <p class="mt-3 mb-3 text-muted">Already Have An Account? <a href="login.php">Login Here</a></p>
      <p class="mt-1 mb-3 text-muted">Go Back? <a href="../../index.php">Click Here</a></p>
    </form>
  </main>
</body>

</html>