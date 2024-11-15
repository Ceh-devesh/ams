<?php include_once('controller/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Anideaz Attendance management system</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
      body{
      font-family: "Outfit";
      }
    </style>
  </head>
  <body>
    <div class="loader"></div>
    <div id="app">
      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <?php include_once('header.php'); ?>
        <?php include_once('nav.php'); ?>
        <div class="main-content">
          <section class="section">
            <div class="section-body">
              <div class="d-flex ">
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <a href="./employee.php">
                    <div class="card">
                      <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                          <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                              <div class="card-content">
                                <h5 class="font-15">Total Employees</h5>
                                <h2 class="mb-3 font-18"></h2>
                              </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                              <div class="banner-img">
                                <img src="assets/img/banner/1.png" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-xl-3 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                  <a href="./attendance.php"><div class="card">
                    <div class="card-statistic-4">
                      <div class="align-items-center justify-content-between">
                        <div class="row ">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                              <h5 class="font-15"> Attendance records</h5>
                              <h2 class="mb-3 font-18"></h2>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                              <img src="assets/img/banner/2.png" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <a href="./salary.php">
                  <div class="card">
                    <div class="card-statistic-4">
                      <div class="align-items-center justify-content-between">
                        <div class="row ">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                              <h5 class="font-15">Salary Management</h5>
                              <h2 class="mb-3 font-18"></h2>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                              <img src="assets/img/banner/3.png" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 cards4">
                  <a href="./expense.php">
                  <div class="card">
                    <div class="card-statistic-4">
                      <div class="align-items-center justify-content-between">
                        <div class="row ">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                              <h5 class="font-15">Total Expenditure</h5>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                              <img src="assets/img/banner/4.png" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></a>
                </div>
              </div>
            </div>
        </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Anideaz Private Limiteds</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
  <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>