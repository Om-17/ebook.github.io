<?php include_once('./includes/header.php');

$masterModel = new MasterModel('users');
$today = date('Y-m-d');
$yearConditions = ['YEAR(joining_date)' => 'YEAR("' . $today . '")','is_admin' => 0];
$yearcount = $masterModel->count($yearConditions);
$MonthConditions = ['MONTH(joining_date)' => 'MONTH("' . $today . '")','is_admin' => 0];
$monthcount = $masterModel->count($MonthConditions);
$todayConditions = ['DATE(joining_date)' => 'DATE("' . $today . '")','is_admin' => 0];
$todaycount = $masterModel->count($todayConditions);
$totalConditions = ['is_admin' => 0];
$totalcount = $masterModel->count($totalConditions);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - bookwise</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include_once('./config/css.config.php') ?>
  <?php include_once('../loader.php') ?>


</head>

<body>
  <?php include_once('./includes/sidebar.php') ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <?php



                ?>
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><button class="dropdown-item" id="totalFilter">Total</button></li>
                    <li><button class="dropdown-item" id="todayFilter">Today</button></li>
                    <li><button class="dropdown-item" id="monthFilter">This Month</button></li>
                    <li><button class="dropdown-item" id="yearFilter">This Year</button></li>

                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Users <span id="usersubtitle">| Total</span></h5>
                 
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="userCount">
                        <?php echo $totalcount; ?> Users
                      </h6>
                      <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span
                        class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <!-- <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>$3,264</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span
                        class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div> -->
            <!-- End Revenue Card -->

            <!-- Customers Card -->
            <!-- <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Customers <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1244</h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span
                        class="text-muted small pt-2 ps-1">decrease</span>

                    </div>
                  </div>

                </div>
              </div>

            </div> -->
            <!-- End Customers Card -->


          </div>

        </div>
    </section>

  </main><!-- End #main -->

  <?php include_once('./config/js.config.php') ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <script>
    $('#dashboard-link').removeClass('collapsed') 
  </script>

  <script>
   
    function updateUserCount(count) {
      document.getElementById('userCount').textContent = count + ' Users';
    }


    // Event listeners for filter options
    document.getElementById('todayFilter').addEventListener('click', function () {
      $('#usersubtitle').text('| Today')      
      var today = <?php echo $todaycount ?>; 
      updateUserCount(today);
    });
    document.getElementById('totalFilter').addEventListener('click', function () {
      $('#usersubtitle').text('| Total')      

      var total = <?php echo $totalcount ?>;
      updateUserCount(total);
    });

    document.getElementById('monthFilter').addEventListener('click', function () {
      $('#usersubtitle').text('| This Month')      
      
      var thisMonth = <?php echo $monthcount ?>;
      updateUserCount(thisMonth);
    });

    document.getElementById('yearFilter').addEventListener('click', function () {
      $('#usersubtitle').text('| This Year')      
     
      var thisYear = <?php echo $yearcount ?>;
      updateUserCount(thisYear);
    });
  </script>


</body>

</html>