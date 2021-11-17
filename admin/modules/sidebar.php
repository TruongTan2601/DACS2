<div class="sidebar">
  <div class="logo-details">
    <i class="fas fa-mug-hot icon"></i>
    <!-- <i class='bx bxl-c-plus-plus icon'></i> -->
    <div class="logo_name">TreCoffee</div>
    <i class="bx bx-menu" id="btn"></i>
  </div>
  <ul class="nav-list">
    <li>
      <i class="bx bx-search"></i>
      <input type="text" placeholder="Search..." />
      <span class="tooltip">Search</span>
    </li>
    <li>
      <a href="index.php">
        <i class="bx bx-grid-alt"></i>
        <span class="links_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li>
    <li>
      <a href="manageruser.php">
        <i class="bx bx-user"></i>
        <span class="links_name">User</span>
      </a>
      <span class="tooltip">User</span>
    </li>
    <li>
      <a href="chat.php">
        <i class="bx bx-chat"></i>
        <span class="links_name">Messages</span>
      </a>
      <span class="tooltip">Messages</span>
    </li>
    <li>
      <a href="chart.php">
        <i class="bx bx-pie-chart-alt-2"></i>
        <span class="links_name">Analytics</span>
      </a>
      <span class="tooltip">Analytics</span>
    </li>
    <li>
      <a href="uploadproduct.php">
        <i class="bx bx-folder"></i>
        <span class="links_name">Products</span>
      </a>
      <span class="tooltip">Products</span>
    </li>
    <li>
      <a href="order.php">
        <i class="bx bx-cart-alt"></i>
        <span class="links_name">Order</span>
      </a>
      <span class="tooltip">Order</span>
    </li>
    <li>
      <a href="booking.php">
        <i class="fas fa-couch"></i>
        <span class="links_name">Booking</span>
      </a>
      <span class="tooltip">Booking</span>
    </li>
    <li>
      <a href="blogs.php">
        <i class="far fa-newspaper"></i>
        <span class="links_name">Blogs</span>
      </a>
      <span class="tooltip">Blogs</span>
    </li>
    <li>
      <a href="image.php">
        <i class="bx bx-image"></i>
        <span class="links_name">Image</span>
      </a>
      <span class="tooltip">Image</span>
    </li>
    <li>
      <a href="#">
        <i class="bx bx-cog"></i>
        <span class="links_name">Setting</span>
      </a>
      <span class="tooltip">Setting</span>
    </li>
    <?php Session::get("adminName") ?>
    <li class="profile">
      <div class="profile-details">
        <i class="fas fa-users-cog"></i>
        <div class="name_job">
          <div class="name">TruongTan</div>
          <div class="job">Admin User</div>
        </div>
      </div>
      <?php
      if (isset($_POST['logout'])) {
        Session::logout();
        header("Location: login.php");
      }
      ?>
      <form method="post">
        <button type="submit" name="logout">
          <i class="bx bx-log-out" id="log_out"></i>
        </button>
      </form>

    </li>
  </ul>
</div>