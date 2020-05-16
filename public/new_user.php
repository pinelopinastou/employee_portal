<!DOCTYPE html>
<html lang="en">
<?php require_once "../head.php"; ?>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php require_once "../sidebar.php"; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <?php require_once "../topbar.php"; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create new user</h1>
              </div>
              <form class="user">
                <div class="form-group">
                  <label for="email"> First Name </label>
                  <input type="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email"> Last Name </label>
                  <input type="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email"> Email </label>
                  <input type="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password"> Password </label>
                  <input type="password" class="form-control">
                </div>
                <div class="form-group">
                  <label for="confirm-password"> Confirm Password </label>
                  <input type="password" class="form-control">
                </div>
                <div class="form-group">
                  <label for="type"> User Type </label>
                   <select id="user_types" name="type" class="form-control">
                      <option value="admin">Admin</option>
                      <option value="employee">Employee</option>
                    </select> 
                </div>
                <a href="../home.php" class="btn btn-primary btn-user btn-block">
                  Create
                </a>
                <hr>
              </form>
              <hr>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php require_once "footer.php"; ?>

</body>

</html>
