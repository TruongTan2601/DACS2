<?php
include_once '../../admin/connect.php';
$s = $_POST['data'];
$sql = DB::table('coupon')->where('couponName', 'like', "%$s%")->get();

?>
<?php foreach ($sql as $row) { ?>
  <?php $times = floor((time() - strtotime($row['couponEndDate'])) / (60 * 60 * 24)) ?>
  <?php if ($times <= 0) { ?>
    <div class="row coupon_s" style="padding-bottom: 20px;">
      <div class="col-md-1 icon-coupon">
        <i class="fa fa-gift" style="font-size: 45px; padding-right: 25px;" aria-hidden="true"></i>
      </div>
      <div class="col-md-7 coupon">
        <div class="coupon-name">
          <h3><?= $row['couponName'] ?></h3>
        </div>
        <div class="coupon-g">
          <?= $row['couponContent'] ?>
        </div>
      </div>
      <div class="col-md-3 coupon-click">
        <form method="post">
          <input type="hidden" name="couponId" value="<?= $row['couponDiscount'] ?>">
          <input type="submit" name="coupon" class="btn hvr-hover" style="color: #fff;" value="USE COUPON">
        </form>
      </div>
    </div>
  <?php } else {
  } ?>
<?php } ?>