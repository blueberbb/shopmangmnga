<?php
session_start();
include('./Admin/connect/conndb.php');
$query = "SELECT t.*,COUNT(p.p_id) as ptotal
FROM tbl_prd_type as t
LEFT JOIN tbl_prd as p ON t.t_id=p.ref_t_id
GROUP BY t.t_id" or die("Error:" . mysqli_error($conn));
$result = mysqli_query($conn, $query);

@$p_id = mysqli_real_escape_string($conn, $_GET['p_id']);
$act = mysqli_real_escape_string($conn, $_GET['act']);

//add to cart
if ($act == 'add' && !empty($p_id)) {
  if (isset($_SESSION['cart'][$p_id])) {
    $_SESSION['cart'][$p_id]++;
  } else {
    $_SESSION['cart'][$p_id] = 1;
  }
}
if ($act == 'remove' && !empty($p_id))  //ลบสินค้าในตะกร้าตามไอดี
{
  unset($_SESSION['cart'][$p_id]);
}

//update cart
if ($act == 'update') {
  $amount_array = $_POST['amount'];
  foreach ($amount_array as $p_id => $amount) {
    $_SESSION['cart'][$p_id] = $amount;
  }
}


//cancel cart
if ($act == 'cancel') {
  unset($_SESSION['cart']);
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>cart</title>
  <style>
    .bg-alpha {
      background: rgba(0, 0, 0, 0.7);
    }
  </style>
</head>

<body style="background: #ffffff; font-family: 'Prompt', sans-serif;">

  <nav id="navbar" class="navbar navbar-expand-lg  navbar-dark bg-alpha">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="./images/logo.png" alt="" width="40" height="40">

      </a>
      <button class="navbar-toggler bg-light " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php"><b>หน้าหลัก</b></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

              <b class="text-info">เลือกประเภทสินค้า</b>
              <i class="fal fa-arrow-alt-down text-white"></i>
            </a>
            <ul class="dropdown-menu bg-alpha" aria-labelledby="navbarDropdown">
              <?php while ($row = mysqli_fetch_array($result)) { ?>
                <li>
                  <a class="dropdown-item text-white" href="./index.php?act=showbytype&t_id=<?php echo $row['t_id']; ?>&name=<?php echo $row['t_name']; ?>">
                    <b><i class="fal fa-arrow-alt-right "></i></b> <b class="text-info"><?php echo $row['t_name']; ?></b> (<?php echo $row['ptotal']; ?>)</a>
                </li>
                <!--ดึงข้อมูลจากหมวดสินค้ามาโชว์-->
              <?php } ?>
            </ul>

          </li>
          <li class="nav-item ">
            <a class="nav-link text-primary" href="#" tabindex="-1" aria-disabled=""><b>เบอร์โทร 0834007954</i></b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-warning" href="#" tabindex="-1" aria-disabled=""><b>ที่อยู่ร้าน <i class="fal fa-store-alt"></i></b></a>
          </li>
        </ul>



        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if (isset($_SESSION['m_id'])) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-family: 'Prompt', sans-serif;">

                <img src="./Admin/profile/<?php echo $_SESSION['m_img']; ?>" class="rounded-circle" width="35" height="35">
                <?php echo $_SESSION['m_username']; ?>
              </a>
              <ul class="dropdown-menu bg-alpha" aria-labelledby="navbarDropdown">

                <li><a class="dropdown-item" href="./Admin/member/member_page.inc.php"><i class="far fa-id-card" style="color: dodgerblue;"> <b style="font-family: 'Prompt', sans-serif;">รายละเอียดการสั่งซื้อ</b></i></a></li>
                <li>
                  <a class="dropdown-item" href="./Admin/check/logout.php">
                    <i class="fas fa-sign-out-alt" style="color: #03fc3d;"></i>
                    <font color="#03fc3d"><b>ออกจากระบบ</b></font>
                  </a>
                </li>
              </ul>
            </li>

      </div>
      </span>
    <?php } else { ?>

      <li class="nav-item">
        <a class="btn btn-info m-md-1 px-4" href="../Admin/login.php" style="font-family: 'Prompt', sans-serif;"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-warning m-md-1 px-3" href="../Admin/register.php" style="font-family: 'Prompt', sans-serif;"><i class="fas fa-user-plus"></i> สมัครสมาชิก</a>
      </li>
      </ul>
    <?php } ?>

    <form class="d-flex" method="get">
      <input class="form-control m-1 me-2" type="search" style="font-family: 'Prompt', sans-serif;" name="search" required placeholder="ค้นหาข้อมูล" aria-label="Search" />
      <button class="btn btn-outline-light m-1" type="submit" name="act" value="q" style="font-family: 'Prompt', sans-serif;">
        ค้นหา
      </button>
    </form>
    </div>
    </div>
  </nav>
  <br>
  <section class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12">
        <h3 class=" py-2 text-center"><i class="fas fa-cart-arrow-down text-primary" ><b style="font-family: 'Prompt', sans-serif;"> ตะกร้าสินค้า</b> </i></a></h3>

        <form id="frmcart" name="frmcart" method="post" action="?act=update">
          <div style='overflow-x:auto;'>
            <table class="table table-hover  ">

              <tr class="bg-alpha text-white">
                <th width="5%" align="center">#</th>
                <th width="10%" align="center">รูปสินค้า</th>
                <th width="40%" align="center">สินค้า</th>
                <th width="15%" align="center">ราคา</th>
                <th width="10%" align="center">จำนวน</th>
                <th width="10%" align="center">รวม(บาท)</th>
                <th width="10%" align="center"></th>
              </tr>
              <?php
              $total = 0;
              if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $p_id => $qty) {
                  $sql = "SELECT * FROM tbl_prd WHERE p_id=$p_id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $sum = $row['p_price'] * $qty;  //เอาราคาสินค้า คูณ จำนวนที่สั่งซื้อ
                  $total += $sum; //ราคารวม
                  $p_qty = $row['p_qty']; //จำนวนสินค้าในสต็อก   

                  echo "<tr >";
                  echo "<td >" . @$i += 1 . "</td>";
                  echo "<td align='center'>" . "<img src='./Admin/img_product/" . $row['p_img'] . "' width='100'>" . "</td>";
                  echo "<td >"
                    . $row["p_name"]
                    . "<br>"
                    . 'จำนวนสินค้าในสต็อก :'
                    . $row["p_qty"]
                    . ' ชิ้น'
                    . "</td>";
                  echo "<td  >"."฿" . number_format($row["p_price"], 2) . "</td>";
                  echo "<td  >";
                  echo "<input type='number' name='amount[$p_id]' value='$qty' class='form-control' min='1' max='$p_qty'/></td>";
                  echo "<td  >"."฿" . number_format($sum, 2) . "</td>";
                  //remove product
                  echo "<td width='46' align='center'><a href='cart.php?p_id=$p_id&act=remove' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'> ลบ</i></a></td>";
                  echo "</tr>";
                }
                echo "<tr>";
                echo "<td colspan='5'  align='center'><b>ราคารวม:</b></td>";
                echo "<td align='right' >" . "฿" . "<b>" . number_format($total, 2) .  "</b>" . "</td>";
                echo "<td align='left' ></td>";
                echo "</tr>";
               
              }
              if ($total > 0) {
              ?>
                <tr class="bg-alpha">
                  <td colspan="7" align="right">
                  <input type="button" class="btn btn-danger btn-sm" name="btncancel" value="ยกเลิกการสั่งซื้อสินค้า" onclick="window.location='cart.php?act=cancel';" />
                    <input type="submit" class="btn btn-secondary btn-sm" name="updateprice" value="ยืนยันการสั่งซื้อ" />
                   <?php if($act=='update'){?>
                    <input type="button" class="btn btn-warning btn-sm" name="submit2" value="สั่งซื้อสินค้า" onclick="window.location='confirm.php';" />
                   <?php } ?>
                   
                   
                  </td>
                </tr>
              <?php } else {
                echo '<h4 align="center" class="text-danger"> -ไม่มีสินค้าในตะกร้า กรุณาเลือกซื้อสินค้าใหม่อีกครั้ง- </h4>';
              } ?>
            </table>
          </div>
        </form>
      </div>
    </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>