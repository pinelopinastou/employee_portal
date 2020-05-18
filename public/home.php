<?php require_once "../src/helpers/request_helper.php" ?>
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
          <h1 class="h3 mb-2 text-gray-800">Welcome!</h1>

          <a href="new_request.php" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
              <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add a new request</span>
          </a>
          <div class="my-2"></div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">My past requests</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Date Submitted</th>
                      <th>Dates Requested</th>
                      <th>Days Requested</th>
                      <th>Status</th>
                    </tr>
                    <?php RequestHelper::requests_list()?>
                  </thead>
                  <tfoot>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php require_once "../src/views/footer.php"; ?>

</body>

</html>
