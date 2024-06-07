<?php
require '../../backend/db.php';
include '../../backend/functions.php';
include '../../backend/session.php';

echo '<title>Login Page</title>';

$errors = [];

if (isset($_POST["submit"])) {

  $errors = validate_login_request($_POST['email'], $_POST['password']);

    global $connection;
    $sql = "SELECT * FROM users WHERE email = '".$_POST['email']."'";
    $result = mysqli_query($connection, $sql);

    $user = mysqli_fetch_object($result);
    if($user->email == null){
        $errors[] = "Email Not Found";
    }
    
    if(empty($errors) && $user->account_type == "admin") {
        $user = login_account($_POST['email'], $_POST['password']);
        if(!empty($user)) {
            $_SESSION['id'] = $user['id'];

            header("Location: ../admin/index.php");
        } else{
            $errors[] = "The email address or password that you've entered does not match any account.";
        }
    }

    if(empty($errors) && $user->account_type == "user") {
        $user = login_account($_POST['email'], $_POST['password']);
        if(!empty($user)) {
            $_SESSION['id'] = $user['id'];

            header("Location: ../user/index.php");
        } else{
            $errors[] = "The email address or password that you've entered does not match any account.";
        }
    }
}
?>

<?php include '../../layouts/_layout_form_header.php' ?>

<body class="text-center">
  <main class="form-signin">
    <form method="POST">
      <img class="mb-4" src="../../resources/images/Logo/kainan-icon-only.png" alt="" width="200" height="200">
      <h1 class="h3 mb-3 fw-normal">Welcome Back User</h1>
      <p class="mt-3 mb-3 text-muted">Enter Your Email and Password to Continue</p>
      <span style="font-size: 15px;">
        <?php if (!empty($errors)) { ?>
          <?php include "../../layouts/_error_message.php" ?>
        <?php } ?>
      </span>
      <div class="form-floating">
        <input type="email" name="email" id="email" class="form-control" id="floatingInput"
          placeholder="name@example.com">
        <label for="floatingInput">Email</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" id="password" class="form-control" id="floatingPassword"
          placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Login</button>
      <p class="mt-3 mb-3 text-muted">Don't Have An Account? <a href="create.php">Sign Up Here</a></p>
      <p class="mt-1 mb-3 text-muted">Go Back? <a href="../../index.php">Click Here</a></p>
    </form>
  </main>
</body>

</html>