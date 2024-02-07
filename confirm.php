<?php
session_start();
include('./Admin/connect/conndb.php');
//ถ้านำออกไม่ใช่สมาชิกก็สามารถซื้อสินค้าได้
if ($_SESSION['m_name'] == '') {
  echo "<script type='text/javascript'>";
  echo "alert('คุณยังไม่ได้เข้าสู่ระบบ กรุณาเข้าสู่ระบบก่อนซื้อสินค้าทุกครั้ง');";
  echo "window.location = './Admin/login.php'; ";
  echo "</script>";
}

$m_id = $_SESSION['m_id'];

$qmember = "SELECT m_fname, m_name, m_lname, m_address, m_email, m_phone FROM tbl_member WHERE m_id=$m_id";
$rsmember = mysqli_query($conn, $qmember) or die("Error in query: $qmember " . mysqli_error($conn));
$rowmember = mysqli_fetch_array($rsmember);
//ถ้านำออกไม่ใช่สมาชิกก็สามารถซื้อสินค้าได้
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
  <?php
  $query = "SELECT t.*,COUNT(p.p_id) as ptotal
FROM tbl_prd_type as t
LEFT JOIN tbl_prd as p ON t.t_id=p.ref_t_id
GROUP BY t.t_id" or die("Error:" . mysqli_error($conn));
  $result = mysqli_query($conn, $query);
  ?>
  <nav id="navbar" class="navbar navbar-expand-lg  navbar-dark bg-alpha">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" alt="" width="40" height="40">

      </a>
      <button class="navbar-toggler bg-light " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php"><b>หน้าหลัก</b></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

              <b class="text-info">เลือกประเภทสินค้า</b>
              <i class="fal fa-arrow-alt-down text-white"></i>
            </a>
            <ul class="dropdown-menu bg-alpha" aria-labelledby="navbarDropdown">
              <?php while ($row = mysqli_fetch_array($result)) { ?>
                <li>
                  <a class="dropdown-item text-white" href="index.php?act=showbytype&t_id=<?php echo $row['t_id']; ?>&name=<?php echo $row['t_name']; ?>">
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

                <li><a class="dropdown-item" href="Admin/member/member_page.inc.php"><i class="far fa-id-card" style="color: dodgerblue;"> <b style="font-family: 'Prompt', sans-serif;">รายละเอียดการสั่งซื้อ</b></i></a></li>
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
        <a class="btn btn-info m-md-1 px-4" href="./Admin/login.php" style="font-family: 'Prompt', sans-serif;"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-warning m-md-1 px-3" href="./Admin/register.php" style="font-family: 'Prompt', sans-serif;"><i class="fas fa-user-plus"></i> สมัครสมาชิก</a>
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
        <h3 class=" py-2 text-center text-primary"><i class="far fa-handshake"> <b style="font-family: 'Prompt', sans-serif;">ยืนยันการสั่งซื้อสินค้า</b></i></h3>


        <div style='overflow-x:auto;'>
          <table class="table table-hover  ">

            <tr class="bg-alpha text-white">
              <th width="5%" align="center">#</th>
              <th width="10%">รูปสินค้า</th>
              <th width="50%">สินค้า</th>
              <th width="10%" align="center">ราคา</th>
              <th width="10%" align="center">จำนวน</th>
              <th width="5%" align="center">รวม(บาท)</th>

              <?php
              $total = 0;
              if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $p_id => $qty) {
                  $sql = "SELECT * FROM tbl_prd WHERE p_id=$p_id";
                  $query = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_array($query);
                  $sum = $row['p_price'] * $qty;  //เอาราคาสินค้า คูณ จำนวนที่สั่งซื้อ
                  $total += $sum; //ราคารวม
                  echo "<tr>";
                  echo "<td >" . @$i += 1 . "</td>";
                  echo "<td>" . "<img src='./Admin/img_product/" . $row['p_img'] . "' width='100'>" . "</td>";
                  echo "<td >" . $row["p_name"] . "</td>";
                  echo "<td  >" . "฿"  . number_format($row["p_price"], 2) . "</td>";
                  echo "<td  align='right'>";
                  echo "<input type='number' name='amount[$p_id]' value='$qty' class='form-control' readonly/></td>";
                  echo "<td  align='right'>" . "฿" . number_format($sum, 2) . "</td>";
                  echo "</tr>";
                }
                echo "<tr class='bg-alpha text-white'>";
                echo "<td colspan='5'  align='center'><b>ราคารวม :</b></td>";
                echo "<td align='right' >" . "฿" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                echo "</tr>";
              }

              ?>


          </table>
        </div>


        <div class="card bg-alpha text-white">
          <h4 class="text-center">รายละเอียดในการจัดส่งสินค้า</h4>
          <div class="card-body">

            <form id="formUpdate" method="POST" action="saveorder.php">

              <div class="row">


                <div class="form-group col-md-6">
                  <label for="name" class="text-white">ชื่อ-สกุล :</label>
                  <input type="text" class="form-control" id="name" name="m_name" value="<?php echo $rowmember['m_fname'] . $rowmember['m_name'] . ' ' . $rowmember['m_lname']; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label for="email" class="text-white">อีเมลล์ :</label>
                  <input type="email" class="form-control" id="email" name="m_email" value="<?php echo $rowmember['m_email']; ?>">
                </div>

                <div class="form-group col-md-6">
                  <label for="phone" class="text-white">เบอร์โทร :</label>
                  <input type="text" class="form-control" id="phone" name="m_phone" value="<?php echo $rowmember['m_phone']; ?>">
                </div>



                <div class="form-group col-md-6">
                  <label for="address" class="text-white">ที่อยู่ :</label>
                  <input class="form-control" id="address" name="m_address" rows="5" value="<?php echo $rowmember['m_address']; ?>">
                </div>
              </div>

              <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
              <input type="hidden" name="total" value="<?php echo $total; ?>">
              <br>
              <div class="d-grid gap-2">
                <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <input type="submit" name="submit" class="btn btn-primary" value="สั่งซื้อสินค้า">
              </div>
            </form>
          </div>
        </div> <!-- สิ้นสุด-->

      </div>
    </div>

  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>