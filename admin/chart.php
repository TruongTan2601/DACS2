<?php
require 'connect.php';
Session::checkSession();
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
  <?php require 'modules/head.php' ?>
  <title>ADMIN | Chart</title>
</head>

<body>
  <?= include 'modules/sidebar.php' ?>
  <section class="home-section">
    <div class="text"><span><i class="fas fa-chart-line"></i> Chart</span></div>
    <div class="block">
      <div class="row ml-1 mr-1">
        <div class="chart chart--page mt-3 col-xl-7 col-md-12">
          <div class="card" style="display: block;">
            <span class="card-title">Product consumption chart</span>
            <canvas class="card-body" id="chart--bar"></canvas>
          </div>
        </div>
        <div class="chart chart--page mt-3 col-xl-5 col-md-12">
          <div class="card">
            <span class="card-title">Product sales and orders chart</span>
            <canvas id="chart--pie"></canvas>
          </div>
        </div>
      </div>


    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>

  <script>
    //bar
    const labels_bar = [
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
    const data_bar = {
      labels: labels_bar,
      datasets: [{
          label: 'Black coffee',
          data: [
            <?= DB::table('bill_details')->where('month', 1)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 2)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 3)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 4)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 5)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 6)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 7)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 8)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 9)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 10)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 11)->where('productName', 'Black coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 12)->where('productName', 'Black coffee')->sum('productQuantity') ?>
          ],
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          // 'rgba(255, 159, 64, 0.2)',
          // 'rgba(255, 205, 86, 0.2)',
          // 'rgba(75, 192, 192, 0.2)',
          // 'rgba(54, 162, 235, 0.2)',
          // 'rgba(153, 102, 255, 0.2)',
          // 'rgba(201, 203, 207, 0.2)'

          // backgroundColor: [
          //     'rgba(255, 99, 132, 0.2)',
          //     // 'rgba(255, 159, 64, 0.2)',
          //     // 'rgba(255, 205, 86, 0.2)',
          //     // 'rgba(75, 192, 192, 0.2)',
          //     // 'rgba(54, 162, 235, 0.2)',
          //     // 'rgba(153, 102, 255, 0.2)',
          //     // 'rgba(201, 203, 207, 0.2)'
          // ],
          // borderColor: [
          //     'rgb(255, 99, 132)',
          //     // 'rgb(255, 159, 64)',
          //     // 'rgb(255, 205, 86)',
          //     // 'rgb(75, 192, 192)',
          //     // 'rgb(54, 162, 235)',
          //     // 'rgb(153, 102, 255)',
          //     // 'rgb(201, 203, 207)'
          // ],
          borderColor: 'rgb(255, 99, 132)',
          // 'rgb(255, 159, 64)',
          // 'rgb(255, 205, 86)',
          // 'rgb(75, 192, 192)',
          // 'rgb(54, 162, 235)',
          // 'rgb(153, 102, 255)',
          // 'rgb(201, 203, 207)'

          borderWidth: 1
        },
        {
          label: 'Milk coffee',
          data: [
            <?= DB::table('bill_details')->where('month', 1)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 2)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 3)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 4)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 5)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 6)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 7)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 8)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 9)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 10)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 11)->where('productName', 'Milk coffee')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 12)->where('productName', 'Milk coffee')->sum('productQuantity') ?>
          ],
          backgroundColor:
            // 'rgba(255, 99, 132, 0.2)',
            // 'rgba(255, 159, 64, 0.2)',
            // 'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          // 'rgba(54, 162, 235, 0.2)',
          // 'rgba(153, 102, 255, 0.2)',
          // 'rgba(201, 203, 207, 0.2)'

          // backgroundColor: [
          //     // 'rgba(255, 99, 132, 0.2)',
          //     // 'rgba(255, 159, 64, 0.2)',
          //     // 'rgba(255, 205, 86, 0.2)',
          //     'rgba(75, 192, 192, 0.2)',
          //     // 'rgba(54, 162, 235, 0.2)',
          //     // 'rgba(153, 102, 255, 0.2)',
          //     // 'rgba(201, 203, 207, 0.2)'
          // ],
          borderColor:
            // 'rgb(255, 99, 132)',
            // 'rgb(255, 159, 64)',
            // 'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
          // 'rgb(54, 162, 235)',
          // 'rgb(153, 102, 255)',
          // 'rgb(201, 203, 207)'

          borderWidth: 1
        },
        {
          label: 'Capuchino',
          data: [
            <?= DB::table('bill_details')->where('month', 1)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 2)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 3)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 4)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 5)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 6)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 7)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 8)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 9)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 10)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 11)->where('productName', 'Capuchino')->sum('productQuantity') ?>,
            <?= DB::table('bill_details')->where('month', 12)->where('productName', 'Capuchino')->sum('productQuantity') ?>
          ],
          backgroundColor:
            // 'rgba(255, 99, 132, 0.2)',
            // 'rgba(255, 159, 64, 0.2)',
            // 'rgba(255, 205, 86, 0.2)',
            // 'rgba(75, 192, 192, 0.2)',
          // 'rgba(54, 162, 235, 0.2)',
          // 'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)',

          // backgroundColor: [
          //     // 'rgba(255, 99, 132, 0.2)',
          //     // 'rgba(255, 159, 64, 0.2)',
          //     // 'rgba(255, 205, 86, 0.2)',
          //     'rgba(75, 192, 192, 0.2)',
          //     // 'rgba(54, 162, 235, 0.2)',
          //     // 'rgba(153, 102, 255, 0.2)',
          //     // 'rgba(201, 203, 207, 0.2)'
          // ],
          borderColor:
            // 'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            // 'rgb(255, 205, 86)',
            // 'rgb(75, 192, 192)',
          // 'rgb(54, 162, 235)',
          // 'rgb(153, 102, 255)',
          // 'rgb(201, 203, 207)'

          borderWidth: 1
        }
      ]
    };
    const config_bar = {
      type: 'bar',
      data: data_bar,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        // title: {
        //     display: 'true',
        //     text: 'Số lượng sản phẩm bán ra'
        // }
      },
    };
    var chartbar = new Chart(
      document.getElementById('chart--bar'),
      config_bar
    );


    //pie
    const labels_pie = [
      'Product sales',
      'Orders',
    ];
    const data_pie = {
      labels: labels_pie,
      datasets: [{
        label: 'My First Dataset',
        data: [
          <?= DB::table('bill_details')->count() ?>,
          <?= DB::table('bill')->count() ?>
        ],
        backgroundColor: [
          'rgb(255, 205, 86)',
          '#22CFCF',
        ],
        hoverOffset: 4
      }]
    };
    const config_pie = {
      type: 'pie', //doughnut
      data: data_pie,
      options: {}
    };
    var chartpie = new Chart(
      document.getElementById('chart--pie'),
      config_pie
    );
  </script>

  <script src="script/script.js"></script>
  <!-- <script src="script/chart_line.js"></script> -->
  <!-- <script src="script/chart_pie.js"></script> -->
  <!-- <script src="script/chart_bar.js"></script> -->
</body>

</html>