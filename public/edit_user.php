<?php require "../src/controllers/users_controller.php";

$users_controller = new UsersController();
$users_controller->edit();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $users_controller->update();
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
                <h1 class="h4 text-gray-900 mb-4">Edit user</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group <?php echo (!empty($users_controller->first_name_err)) ? 'has-error' : ''; ?>">
                  <label for="first_name">First Name </label>
                  <input name="first_name" class="form-control" value="<?php echo $users_controller->first_name; ?>">
                  <span class="help-block"><?php echo $users_controller->first_name_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($users_controller->last_name_err)) ? 'has-error' : ''; ?>">
                  <label for="last_name"> Last Name </label>
                  <input name="last_name" class="form-control" value="<?php echo $users_controller->last_name; ?>">
                  <span class="help-block"><?php echo $users_controller->last_name_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($users_controller->email_err)) ? 'has-error' : ''; ?>">
                  <label for="email"> Email </label>
                  <input name="email" type="email" class="form-control" value="<?php echo $users_controller->email; ?>">
                  <span class="help-block"><?php echo $users_controller->email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($users_controller->password_err)) ? 'has-error' : ''; ?>">
                  <label for="password"> Password </label>
                  <input type="password" name="password" class="form-control" value="<?php echo $users_controller->password; ?>">
                  <span class="help-block"><?php echo $users_controller->password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($users_controller->confirm_password_err)) ? 'has-error' : ''; ?>">
                  <label for="confirm-password"> Confirm Password </label>
                  <input type="password" name="confirm_password" class="form-control" value="<?php echo $users_controller->confirm_password; ?>">
                  <span class="help-block"><?php echo $users_controller->confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                  <label for="type"> User Type </label>
                   <select id="user_types" name="user_type" class="form-control" value="<?php echo $users_controller->user_type; ?>">
                      <option <?php echo $users_controller->user_type=="admin"? "selected='selected'" : "" ;  ?>v value="admin">Admin</option>
                      <option <?php echo $users_controller->user_type=="employee"? "selected='selected'" : "" ;  ?>value="employee">Employee</option>
                    </select> 
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Update User">
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
