
<nav id="js-primary-nav" class="primary-nav" role="navigation">

    <div class="info-card">
        <img src="../profile/<?php echo $_SESSION['m_img']; ?>" style="width: 40px;height: 40px;" class=" cursor-pointer profile-image rounded-circle">
        <!--ตำแหน่งเปลี่ยนรูปโปรไฟล์-->
        <div class="info-card-text">
            <a href="#" class="d-flex align-items-center text-white">
                <span class="text-truncate text-truncate-sm d-inline-block">
                <?php echo $_SESSION['m_username']; ?>
                </span>
            </a>
            <span class="d-inline-block text-truncate text-truncate-sm text-warning"><?php echo $_SESSION['m_level']; ?></span>
        </div>
        <img src="img/card-backgrounds/cover-12-lg.png" class="cover" alt="cover">

    </div>
    <ul id="js-nav-menu" class="nav-menu">
        <li class="">
            <a href="admin_page.inc.php" >
                <i class="fal fa-cog "></i>
                <span class="nav-link-text ">ระบบการจัดการ</span>
            </a>
        </li>
        <li class="">
            <a href="admin_order.inc.php" >
                <i class="fal fa-cart-arrow-down "></i>
                <span class="nav-link-text ">รายการออเดอร์สินค้า</span>
            </a>
        </li>
        <li class="">
            <a href="admin_member.inc.php" >
                <i class="far fa-users "></i>
                <span class="nav-link-text  ">เพิ่ม/ลบ/แก้ไข/สมาชิก</span>
            </a>
        </li>
        <li class="">
            <a href="admin_type.inc.php" >
                <i class="far fa-th-list "></i>
                <span class="nav-link-text ">เพิ่ม/ลบ/แก้ไข/ประเภทสินค้า</span>
            </a>
        </li>
        <li class="">
            <a href="admin_prd.inc.php" >
                <i class="fal fa-cart-plus "></i>
                <span class="nav-link-text ">เพิ่ม/ลบ/แก้ไข/สินค้า</span>
            </a>
        </li>
        <li class="">
            <a href="admin_comment.inc.php" >
                <i class="fal fa-comment-alt-plus "></i>
                <span class="nav-link-text ">ความคิดเห็นต่อสินค้า</span>
            </a>
        </li>
        <li class="">
            <a href="admin_report.inc.php" >
                <i class="fal fa-chart-bar "></i>
                <span class="nav-link-text ">รายงานยอดการขายสินค้า</span>
            </a>
        </li>
        <li class="">
            <a href="admin_bank.inc.php" >
                <i class="far fa-landmark "></i>
                <span class="nav-link-text ">บัญชีธนาคาร</span>
            </a>
        </li>
        <li class="">
            <a href="admin_profile.inc.php?m_id=<?php echo $row['m_id']; ?>" >
                <i class="far fa-id-card "></i>
                <span class="nav-link-text ">โปรไฟล์</span>
            </a>
        </li>
        <li class="">
            <a href="admin_edit_admin.inc.php?m_id=<?php echo $row['m_id']; ?>" >
                <i class="far fa-user-edit "></i>
                <span class="nav-link-text ">แก้ไขโปรไฟล์</span>
            </a>
        </li>
        <li class="">
            <a href="admin_edit_pass.inc.php" >
                <i class="fal fa-key "></i>
                <span class="nav-link-text">แก้ไขรหัสผ่าน</span>
            </a>
        </li>
        <li class="">
            <a href="admin_counter.inc.php" >
                <i class="far fa-users-class "></i>
                <span class="nav-link-text ">รายงานยอดผู้เข้าชมเว็บไซต์</span>
            </a>
        </li>
        <li class="">
            <a href="admin_login.inc.php?act=log_login" >
                <i class="fal fa-sign-in-alt "></i>
                <span class="nav-link-text ">ประวัติการ Login</span>
            </a>
        </li>

        <li class="">
            <a href="admin_logout.inc.php" >
            <i class="far fa-sign-out-alt text-success"></i>
                <span class="nav-link-text text-success">ออกจากระบบ</span>
            </a>
        </li>

    </ul>
    <div class="filter-message js-filter-message bg-success-600"></div>
</nav>