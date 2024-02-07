<?php
$search = $_GET['search'];

$query = "SELECT * FROM `tbl_prd` WHERE `p_name` LIKE '%$search%' OR `p_detail` LIKE '%$search%'ORDER BY `p_id`DESC"
or die("Error:" . mysqli_error($conn));
// echo $query;
// exit;
// $result = $conn->query($sql);
$result = mysqli_query($conn, $query);
?>

<div class="container">
  <div class="row">
  <?php foreach ($result as $result) { ?>
      <div class="col-12 col-sm-6 col-md-3 py-2">
        <div class="card h-100 shadow border-0" >
          <a href="detail.php?p_id=<?php echo $result['p_id'];?>" class="setimg-card-img">
          <img src="./Admin/img_product/<?php echo $result['p_img'];?>" class="card-img-top " height="100%">
          </a>
          <div class="card-body text-center">
            <h5 class="card-title "><?php echo $result['p_name'];?></h5>
            <p class="card-text">
            <?php echo $result['p_intro']; ?>
            <br >
            <b>ราคา <?php echo number_format($result['p_price'],2); ?> บาท </b>
            </p>
          </div>
          <div class="p-3">
            <a href="detail.php?p_id=<?php echo $result['p_id'];?>" class="btn btn-primary d-grid gap-2">เลือกดูสินค้า</a>
          </div>
        </div>
      </div>
    <?php } ?>


  </div>
</div>