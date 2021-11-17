<?php
require 'connect.php';
Session::checkSession();

?>

<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
  <?php require 'modules/head.php' ?>
  <title>ADMIN</title>

</head>

<body>
  <?= include 'modules/sidebar.php' ?>
  <section class="home-section">
    <div class="text"><a href="#">Dashboard</a> / <span>Overview</span></div>
    <div class="block">
      <!--cardd-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3 mt-4">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-comments"></i>
              </div>
              <div class="text-left"><?= DB::table('contact')->where('check_seen', 0)->count() ?> New Messages!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="chat.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fas fa-angle-right"></i></span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3 mt-4">
          <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-couch"></i>
              </div>
              <div class="text-left"><?= DB::table('tbl_reservations')->where('check_seen', 0)->count() ?> New Booking!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="booking.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fas fa-angle-right"></i></span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3 mt-4">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-shopping-cart"></i>
              </div>
              <div class="text-left"><?= DB::table('bill')->where('check_seen', 0)->count() ?> New Orders!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="order.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fas fa-angle-right"></i></span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3 mt-4">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <div class="text-left"><?= DB::table('tbl_blogs')->count() ?> New Blogs!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="blogs.php">
              <span class="float-left">View Details</span>
              <span class="float-right"><i class="fas fa-angle-right"></i></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="home-section">
    <div class="text">
      <span><i class="fas fa-chart-line"></i> Monthly revenue chart</span>
    </div>
    <div class="block">
      <div class="chart">
        <canvas id="chart--line" class="text-center"></canvas>
      </div>
      <!-- <span>abc</span> -->
    </div>
  </section>
  <section class="home-section">
    <div class="text">
      <span><i class="fas fa-table"></i> Data Table</span>
    </div>
    <div class="block">
      <div class="card mb-3">
        <!-- <div class="card-body">
                    <i class="fas fa-table"></i> Data Table Example
                </div> -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Sonya Frost</td>
                  <td>Software Engineer</td>
                  <td>Edinburgh</td>
                  <td>23</td>
                  <td>2008/12/13</td>
                  <td>$103,600</td>
                </tr>
                <tr>
                  <td>Jena Gaines</td>
                  <td>Office Manager</td>
                  <td>London</td>
                  <td>30</td>
                  <td>2008/12/19</td>
                  <td>$90,560</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">
          Updated yesterday at 11:59 PM
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="script/script.js"></script>
  <!-- <script src="script/chart_line.js"></script> -->
  <script>
    const labels_line = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October',
      'November',
      'December'
    ];
    const data_line = {
      labels: labels_line,
      datasets: [{
        label: 'Balance (VND)',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [
          <?= DB::table('bill')->where('month', 1)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 2)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 3)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 4)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 5)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 6)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 7)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 8)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 9)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 10)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 11)->sum('subtotal') ?>,
          <?= DB::table('bill')->where('month', 12)->sum('subtotal') ?>
        ],
        fill: false,
        tension: 0
      }]
    };
    const config_line = {
      type: 'line',
      data: data_line,
      options: {}
    };
    var chartline = new Chart(
      document.getElementById('chart--line'),
      config_line
    );
  </script>
  <!-- <script src="script/admin-min.js"></script> -->
</body>

</html>