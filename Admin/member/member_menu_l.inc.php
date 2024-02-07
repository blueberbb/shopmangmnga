<nav id="js-primary-nav" class="primary-nav" role="navigation">

    <div class="info-card">
        <img src="../profile/<?php echo $m_img; ?>" style="width: 40px;height: 40px;" class=" cursor-pointer profile-image rounded-circle" alt="Dr. Codex Lantern">
        <!--ตำแหน่งเปลี่ยนรูปโปรไฟล์-->
              
        <div class="info-card-text">
            
            <a href="#" class="d-flex align-items-center text-white">
                <span class="text-truncate text-truncate-sm d-inline-block">
                    <?php echo $_SESSION['m_username']; ?>
                </span>
            </a>
            <span class="d-inline-block text-truncate text-truncate-sm"><?php echo $_SESSION['m_level']; ?></span>
        </div>
        <img src="img/card-backgrounds/cover-12-lg.png" class="cover" alt="cover">

    </div>
    
    <ul id="js-nav-menu" class="nav-menu">
    <li class="">
            <a href="">
                <i class="fal fa-sign-in-alt "></i>
                <span class="nav-link-text">Last Login: <?php echo date ('d-m-Y', strtotime($lastlogin)); ?></span>
            </a>
        </li>
        <li class="">
            <a href="member_page.inc.php">
                <i class="far fa-ballot-check "></i>
                <span class="nav-link-text">รายละเอียดการสั่งซื้อ/จอง/ชำระเงิน/เช็คเลขที่ขนส่ง</span>
            </a>
        </li>
        <!-- <li class="">
            <a href="member_order_detail.inc.php">
                <i class="fal fa-file-invoice-dollar "></i>
                <span class="nav-link-text ">รายละเอียดการสั่งสินค้า</span>
            </a>
        </li> -->
        <li class="">
            <a href="member_edit_member.inc.php?m_id=<?php echo $row['m_id']; ?>">
                <i class="fal fa-user-edit "></i>
                <span class="nav-link-text">แก้ไขโปรไฟล์</span>
            </a>
        </li>
        <li class="">
            <a href="member_edit_pass.inc.php">
                <i class="fal fa-key "></i>
                <span class="nav-link-text">แก้ไขระหัสผ่าน</span>
            </a>
        </li>

        <li class="">
            <a href="../../index.php">
                <i class="far fa-shopping-cart "></i>
                <span class="nav-link-text">กลับหน้าสินค้า</span>
            </a>
        </li>

        <li class="">
            <a href="../check/logout.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?');">
                <i class="far fa-sign-out-alt text-success"></i>
                <span class="nav-link-text text-success">ออกจากระบบ</span>
            </a>
        </li>

    </ul>
    <div class="filter-message js-filter-message bg-success-600"></div>
</nav>