ิ<br>
<br>
<br>
<?php
  $query = "SELECT t.*,COUNT(p.p_id) as ptotal FROM tbl_prd_type as t LEFT JOIN tbl_prd as p ON t.t_id=p.ref_t_id GROUP BY t.t_id" or die("Error:" . mysqli_error($conn));
  $result = mysqli_query($conn, $query);
?>
<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark bg-alpha">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
              <img src="images/logo1.png" alt="" width="40" height="40" >
              
            </a>
            <button class="navbar-toggler bg-light " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page"  href="index.php"><b>หน้าหลัก</b></a>
                </li>
               
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  
                  <b class="text-light" >เลือกประเภทสินค้า</b>
                  <i class="fal fa-arrow-alt-down text-white"></i>
                  </a>
                  <ul class="dropdown-menu bg-alpha" aria-labelledby="navbarDropdown" >
                    <?php  while ($row = mysqli_fetch_array($result)) { ?>
                    <li>
                      <a class="dropdown-item text-white"  href="index.php?act=showbytype&t_id=<?php echo $row['t_id']; ?>&name=<?php echo $row['t_name']; ?>">
                      <b ><i class="fal fa-arrow-alt-right "  ></i></b> <b class="text-light"><?php echo $row['t_name']; ?></b> (<?php echo $row['ptotal']; ?>)</a></li><!--ดึงข้อมูลจากหมวดสินค้ามาโชว์-->
                    <?php } ?>
                  </ul>
        <li class="nav-item">
        <a class="nav-link text-success" href="#" tabindex="-1" aria-disabled=""><b>ที่อยู่ร้าน <i class="fal fa-store-alt"></i></b></a>
        </li>
              </ul>
             

              <ul class="navbar-nav ms-auto mb-2 mb-lg-0" >
                <!-- ใสตะกรา -->
              <!-- <span class="text-end position-relative ">
                        <div class="btn-group">
                            <a class="btn btn-white btn-sm" href="cart.php">
                                ตะกร้าของคุณ <i class="fas fa-shopping-cart fa-2x"></i>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger z-10">
                                    <?php echo isset($_SESSION['cart_item']) ? count($_SESSION['cart_item']) : 0; ?>
                                </span>
                            </a>
                            <button type="button" class="btn btn-sm btn-white dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <?php if(!empty($_SESSION['cart_item'])): ?>
                                <ul class="dropdown-menu dropdown-menu-end" style="font-size: 0.9rem;">
                                    <?php 
                                        foreach ($_SESSION['cart_item'] as $value):
                                    ?>
                                    <li class="dropdown-item" style="width: 270px">  
                                        <img src="<?php echo $value['p_img'] ?>" class="img-fluid" width="50px" alt="AppzStory">
                                        <span><?php echo substr($value['p_name'], 0 , 20) ?>... </span>
                                        <span class="badge rounded-pill bg-danger">
                                            <?php echo $value['p_amount'] ?>
                                        </span>
                                    </li>
                                    <?php endforeach; ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-end" href="cart.php">ดูตะกร้าของคุณ</a></li>
                                </ul>
                            <?php else: ?>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">ไม่มีสินค้าในตะกร้า</li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </span> -->
             <!-- ตะกร้า -->
               <?php if(isset($_SESSION['m_id'])) {?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-family: 'Prompt', sans-serif;">
                  
                  <img  src="./Admin/profile/<?php echo $_SESSION['m_img']; ?>" class="rounded-circle" width="35" height="35">
                  <?php echo $_SESSION['m_username']; ?>
                   </a>
                  <ul class="dropdown-menu bg-alpha" aria-labelledby="navbarDropdown" >
                  
                    <li><a class="dropdown-item" href="Admin/member/member_page.inc.php"><i class="far fa-id-card" style="color: dodgerblue;"> <b style="font-family: 'Prompt', sans-serif;">รายละเอียดการสั่งซื้อ</b></i></a></li>
                    <li>
                      <a class="dropdown-item" href="./Admin/check/logout.php" >
                      <i class="fas fa-sign-out-alt" style="color: #03fc3d;"></i>
                      <font color="#03fc3d"><b>ออกจากระบบ</b></font>
                      </a>
                    </li>
                  </ul>
                </li>
                <?php } else{ ?>

                <li class="nav-item">
                  <a class="btn btn-outline-light m-md-1 px-4" href="./Admin/login.php" style="background: #000000; color: #ffffff; font-family: 'Prompt', sans-serif;"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-outline-light m-md-1 px-3" href="./Admin/register.php" style="background: #000000; color: #ffffff; font-family: 'Prompt', sans-serif;"><i class="fas fa-user-plus"></i> สมัครสมาชิก</a>
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

