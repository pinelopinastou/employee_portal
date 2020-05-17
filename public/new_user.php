<?php require "../src/controllers/users_controller.php";
$user_controller = new UsersController();
$user_controller->new();
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $user_controller->create();
 } ?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "../src/views/head.php"; ?>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php require_once "../src/views/sidebar.php"; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create new user</h1>
              </div>
              <form class="user"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($user_controller->first_name_err)) ? 'has-error' : ''; ?>">
                  <label for="first_name">First Name </label>
                  <input name="first_name" class="form-control" value="<?php echo $user_controller->first_name; ?>">
                  <span class="help-block"><?php echo $user_controller->first_name_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($user_controller->last_name_err)) ? 'has-error' : ''; ?>">
                  <label for="last_name"> Last Name </label>
                  <input name="last_name" class="form-control" value="<?php echo $user_controller->last_name; ?>">
                  <span class="help-block"><?php echo $user_controller->last_name_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($user_controller->email_err)) ? 'has-error' : ''; ?>">
                  <label for="email"> Email </label>
                  <input name="email" type="email" class="form-control" value="<?php echo $user_controller->email; ?>">
                  <span class="help-block"><?php echo $user_controller->email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($user_controller->password_err)) ? 'has-error' : ''; ?>">
                  <label for="password"> Password </label>
                  <input type="password" name="password" class="form-control" value="<?php echo $user_controller->password; ?>">
                  <span class="help-block"><?php echo $user_controller->password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($user_controller->confirm_password_err)) ? 'has-error' : ''; ?>">
                  <label for="confirm-password"> Confirm Password </label>
                  <input type="password" name="confirm_password" class="form-control" value="<?php echo $user_controller->confirm_password; ?>">
                  <span class="help-block"><?php echo $user_controller->confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                  <label for="type"> User Type </label>
                   <select id="user_types" name="user_type" class="form-control" value="<?php echo $user_type; ?>">
                      <option value="admin">Admin</option>
                      <option value="employee">Employee</option>
                    </select> 
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Create User">
                </div>
                <hr>
              </form>
              <hr>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php require_once "../src/views/footer.php"; ?>

</body>

</html>
