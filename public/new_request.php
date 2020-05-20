<?php require "../src/controllers/requests_controller.php";
$requests_controller = new RequestsController();
$requests_controller->new();
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $requests_controller->create();
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
      <div id="content">
        <?php require_once "../src/views/topbar.php"; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Submit request</h1>
              </div>
              <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                  <label for="email"> Date from </label>
                  <input type="date" id="date_from" name="date_from">
                  <span class="help-block"><?php echo $requests_controller->date_from_err; ?></span>
                </div>
                <div class="form-group">
                  <label for="email"> Date to </label>
                  <input type="date" id="date_to" name="date_to">
                  <span class="help-block"><?php echo $requests_controller->date_to_err; ?></span>
                </div>
                <div class="form-group">
                  <label for="email"> Reason </label>
                  <input type="text" class="form-control" name="reason" value="<?php echo $requests_controller->reason;?>">
                  <span class="help-block"><?php echo $requests_controller->reason_err; ?></span>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Submit">
                </div>
                <hr>
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
      <script src="js/date_input.js"></script>
</body>

</html>
