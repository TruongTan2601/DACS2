<?php
include_once '../../admin/connect.php';
$s = $_POST['data'];
$sqlS = DB::table('tbl_product')->where('productName', 'like', "%$s%")->get();
?>
<?php foreach ($sqlS as $row) { ?>
  <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
    <form action="shop.php" method="POST">
      <input type="hidden" name="productId" value="<?= $row['productId'] ?>">
      <input type="hidden" name="productName" value="<?= $row['productName'] ?>">
      <input type="hidden" name="productPrice" value="<?= $row['productPrice'] ?>">
      <input type="hidden" name="productImage" value="<?= $row['productImage'] ?>">
      <input type="hidden" name="productQuantity" value="1">

      <div class="products-single fix">
        <div class="box-img-hover">
          <div class="type-lb">
            <p class="sale"><?= $row["productCurrentstatus"] ?></p>
          </div>
          <img src="../admin/img/Coffee/<?= $row["productImage"] ?>" class="img-fluid" alt="Image">
          <div class="mask-icon">
            <ul>
              <li><a href="shop-detail.php?id=<?= $row['productId'] ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
              <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
              <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
            </ul>
            <!-- <a class="cart add_to_cart" href="#">Add to Cart</a> -->
            <input class="cart" name="add_cart" type="submit" value="Add to Cart">
          </div>
        </div>
        <div class="why-text">
          <h4><a href="shop-detail.php?id=<?= $row['productId'] ?>"><?= $row["productName"] ?></a></h4>
          <h5><?= number_format($row["productPrice"], 0, '', ',') ?> VNĐ</h5>
        </div>
      </div>
    </form>
  </div>
<?php } ?>