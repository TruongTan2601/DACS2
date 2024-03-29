<?php
require './connect.php';
$user = Session::get("adminUser");

$tbl_user = DB::table("tbl_user")->get();
$tbl_staff = DB::table("tbl_staff")->get();
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
<?php require 'modules/head.php' ?>
  <title>ADMIN | Product</title>
</head>

<body>
  <?= include 'modules/sidebar.php' ?>
  <section class="home-section">
    <div class="text"><span><i class="fas fa-user"></i> Manager Users</span></div>
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
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Start date</th>
                  <th>Amount spent</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Start date</th>
                  <th>Amount spent</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($tbl_user as $row) { ?>
                  <tr>
                    <td><?= $row["userName"] ?></td>
                    <td><?= $row["userEmail"] ?></td>
                    <td><?= $row["userPhone"] ?></td>
                    <td><?= $row["userAddress"] ?></td>
                    <td><?= $row["userStartdate"] ?></td>
                    <td><?= DB::table('bill')->where('userId', $row['userId'])->sum('subtotal') ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
  </section>
  <section class="home-section">
    <div class="text"><span><i class="fas fa-user"></i> Manager Staffs</span></div>
    <div class="block">
      <div class="card mb-3">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Email</th>
                  <th>Date of birth</th>
                  <th>Start date</th>
                  <th>Salary</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Email</th>
                  <th>Date of birth</th>
                  <th>Start date</th>
                  <th>Salary</th>
                  <th>Option</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($tbl_staff as $row) { ?>
                  <tr>
                    <td><?= $row["staffName"] ?></td>
                    <td><?= $row["staffPosision"] ?></td>
                    <td><?= $row["staffEmail"] ?></td>
                    <td><?= $row["staffBirth"] ?></td>
                    <td><?= $row["staffStartdate"] ?></td>
                    <td><?= $row["staffSalary"] ?></td>
                    <td><a href="#"><i class="fas fa-user-cog"></i></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="home-section">
    <div class="text"><span onclick="showstaffsign();"><i class="fas fa-user-plus"></i> Create account for Staff</span></div>
    <div class="block staff--signup hidden">
      <div class="text-left mt-3 mb-5 staff">
        <div style="display: block;">
          <form action="" class="needs-validation" novalidate>
            <div class="form-group">
              <label for="uname">Username:</label>
              <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
              <label for="pwd">Confirm Password:</label>
              <input type="password" class="form-control" id="confirmpwd" placeholder="Confirm password" name="confirmpswd" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="row ml-3">
              <div class="form-group form-check col-xl-3 col-lg-3 col-md-12">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="remember" required> Inventory management
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
              </div>
              <div class="form-group form-check col-xl-3 col-lg-3 col-md-12">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="remember" required> Salesman
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
              </div>
              <div class="form-group form-check col-xl-3 col-lg-3 col-md-12">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="remember" required> Accountant
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
              </div>
              <div class="form-group form-check col-xl-3 col-lg-3 col-md-12">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="remember" required> Inventory
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-dark">Submit</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
  <script src="script/script.js"></script>
  <script src="script/admin.js"></script>
  <script src="script/validator.js"></script>
</body>

</html>