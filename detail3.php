<?php
  include('./Admin/connect/conndb.php');
  $p_id = $_GET['p_id'];
  $sql = "SELECT * FROM tbl_prd as p LEFT JOIN tbl_prd_type as t ON p.ref_t_id=t.t_id WHERE p.p_id=$p_id";
  $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
  $row = mysqli_fetch_array($result);
  extract($row);

  $sql2 = "UPDATE tbl_prd SET p_view=p_view+1 WHERE p_id=$p_id";

  $result2 = mysqli_query($conn, $sql2) or die("Error in query:$sql2" . mysqli_error($conn));
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Product Card/Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

</head>

<body >
<br><br><br><br>
  <div class="card-wrapper">
    <div class="card">
      <!-- card left -->
      <div class="product-imgs">
        <div class="img-display">
          <div class="img-showcase">
            <img src="./Admin/img_product/<?php echo $row['p_img']; ?>" alt="shoe image"><!--ขนาดรูปภาพ 640*640 photoshop -->
            <img src="./Admin/img_product/<?php echo $row['p_img1']; ?>" alt="shoe image">
            <img src="./Admin/img_product/<?php echo $row['p_img2']; ?>" alt="shoe image">
            <img src="./Admin/img_product/<?php echo $row['p_img3']; ?>" alt="shoe image">
          </div>
        </div>
        <div class="img-select">
          <div class="img-item" >
            <a href="#" data-id="1" >
              <img src="./Admin/img_product/<?php echo $row['p_img']; ?>" alt="shoe image" >
            </a>
          </div>
          <div class="img-item">
            <a href="#" data-id="2">
              <img src="./Admin/img_product/<?php echo $row['p_img1']; ?>" alt="shoe image">
            </a>
          </div>
          <div class="img-item">
            <a href="#" data-id="3">
              <img src="./Admin/img_product/<?php echo $row['p_img2']; ?>" alt="shoe image">
            </a>
          </div>
          <div class="img-item">
            <a href="#" data-id="4">
              <img src="./Admin/img_product/<?php echo $row['p_img3']; ?>" alt="shoe image">
            </a>
          </div>
        </div>
      </div>
      <!-- card right -->
      <div class="product-content">
        <h2 class="product-title" style="font-family: 'Prompt', sans-serif;"><?php echo $row['p_name']; ?></h2>

        <div class="product-rating">
          <div class="rate mb-3">
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
            <i class="fas fa-star text-warning"></i>
          </div>
          <span><b>VIEW:</b> (<?php echo $row['p_view']; ?>)</span>
          
        </div>
        <div class="product-price">
          <p class="new-price " ><span><b style="font-family: 'Prompt', sans-serif;">ราคา <?php echo number_format($row['p_price'], 2); ?> บาท </b></span></p>
        </div>
        <div class="product-detail" >
          <h4><b style="font-family: 'Prompt', sans-serif;">รายละเอียดสินค้า:</b> </h4>
          <h6 style="font-family: 'Prompt', sans-serif;"><?php echo $row['p_detail']; ?></h6>
        </div>
        <div class="purchase-info">
          <a href="index.php">
            <button type="button" class="btn" style="background-color: #000;font-family: 'Prompt', sans-serif;">
              กลับหน้าหลัก <i class="fal fa-home-lg-alt"></i>
            </button>
          </a>
          <a href="cart.php?p_id=<?php echo $row['p_id']; ?>&act=add" >
          <button type="button" class="btn" style="background-color:#009900; font-family: 'Prompt', sans-serif;" target="_blank">
            เพิ่มสินค้า + <i class="fas fa-shopping-cart"></i>
          </button>
          </a>
        </div>

        <div>
          <p><b>Share At: </b></p>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61f3f735f88900dd"></script>
          <div class="addthis_inline_share_toolbox_t9ig"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" style="text-align: center;">
    <div class="row">
      <div class="col"><br>
        <h4 style="font-family: 'Prompt', sans-serif;"> แสดงความคิดเห็นต่อสินค้า </h4>
        <form action="comment_save.php" method="post" class="from-horizontal">
          <div>
            <textarea name="c_datail" class="form-control" cols="30" rows="2" required></textarea>
          </div>
          <input type="hidden" name="ref_p_id" value="<?php echo $row['p_id']; ?>">
          <br>
          <button type="submit" class="btn btn-primary" style="font-family: 'Prompt', sans-serif;"> แสดงความคิดเห็น <i class="fal fa-comment-alt-dots "></i></button>
        </form>
      </div>
    </div>
    <br>
    <div>
      <h4 style="font-family: 'Prompt', sans-serif;">รายการแสดงความคิดเห็นต่อสินค้า</h4>
      <?php

include('comment_list.php');
      ?>

    </div>
  </div>
  </div>
  </div>
  </div>
  <script src="script.js"></script>

  <footer class="card text-center py-2 text-white  bg-alpha" style="background: rgba(0, 0, 0, 0.7); ">
    <br>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
      $(document).ready(function () {
        $(".dropdown-submenu a.test").on("click", function (e) {
          $(this).next("ul").toggle();
          e.stopPropagation();
          e.preventDefault();
        });
      });
    </script>

</body>

</html>