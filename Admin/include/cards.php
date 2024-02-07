<?php

  $query = "SELECT * FROM tbl_prd GROUP BY p_id DESC"//ORDER BY RAND() คำสั่งสุ่มสินค้า GROUP BY p_id DES รันตาม id ที่เพิ่มล่าสุด
    or die("Error:" . mysqli_error($conn));
  // echo $query;
  // exit;
  // $result = $conn->query($sql);
  $result = mysqli_query($conn, $query);
?>

<div class="container-fluid">
  <div class="row">
    <?php foreach ($result as $result) { ?>
      <div class="col-xs-6 col-sm-6 col-md-3 py-2">
        <div class="card h-100 shadow border-0">
          <a href="detail.php?p_id=<?php echo $result['p_id']; ?>" class="setimg-card-img">
             <img src="./Admin/img_product/<?php echo $result['p_img']; ?>" class="card-img-top " height="100%">  <!--ขนาดรูปภาพ 640*640 photoshop -->
          </a>
          <div class="card-body ">

            <div class="rate mb-3 ">
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
              <i class="fas fa-star text-warning"></i>
            </div>

            <p class="card-text ">
            <h5><?php echo $result['p_name']; ?></h5>
            <span class="card-title mb-3">
              <?php echo $result['p_intro']; ?>
              <br>
              <b>฿<?php echo number_format($result['p_price'], 2); ?> </b>
              </p>
          </div>
          <div class="py-1" style="text-align: center;">
            <a href="detail.php?p_id=<?php echo $result['p_id']; ?>" class="btn btn btn-outline-dark">
              รายละเอียดสินค้า
            </a>
            <?php if ($result['p_qty'] > 0){ ?>
              <!-- <a href="cart.php?p_id=<?php echo $result['p_id']; ?>&act=add" target='_blank'> เมื่อกดจะเด้งไปอีกหน้า-->
              <a href="cart.php?p_id=<?php echo $result['p_id']; ?>&act=add">
                <button type="button" class="btn btn btn-outline-dark" > เพิ่มเข้าตะกร้า
                  <span><i class="fal fa-cart-plus"></i></span>
                </button>
              </a>
            <?php }else{
              echo '<button class="btn btn-danger" disabled>สินค้าหมด !!</button>';
            } ?>
          </div>
          

        </div>
      </div>
    <?php } ?>


  </div>
</div>