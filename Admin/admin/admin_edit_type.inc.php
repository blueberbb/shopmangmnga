<?php
session_start();
include_once('../connect/conndb.php');

if (!isset($_GET['t_id'])) {
    header('Location:admin_type.inc.php');
}
$sql = "SELECT * FROM tbl_prd_type WHERE t_id = '" . $_GET['t_id'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_profile
    </title>
    <?php include('admin_linkon.inc.php'); ?>
</head>


<body class="mod-bg-1 mod-nav-link ">
    <script src="js/datagrid/datatables/datatables.bundle.js"></script>
    <!-- DOC: script to save and load page settings -->
    <script>
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /** 
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';
        /** 
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);

        } else if (themeSettings.themeURL && document.getElementById('mytheme')) {
            document.getElementById('mytheme').href = themeSettings.themeURL;
        }
        /** 
         * Save to localstorage 
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|footer|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /** 
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar ">
                <div class="page-logo ">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                        <img src="img/cart.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                        <span class="page-logo-text mr-1 text-info">E-COMMERCE</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>

                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <?php include('admin_menu_l.inc.php'); ?>
                <!-- END PRIMARY NAVIGATION -->
                <!-- NAV FOOTER -->

            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <?php include('admin_menu_r.inc.php'); ?>

                <main id="js-page-content" role="main" class="page-content">
                    <div class="" id="default-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="far fa-th-list text-center m-md-3" style="font-size: 25px;"> แก้ไขประเภทสินค้า</i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="js-login" novalidate="" method="POST" action="admin_edit_type_db.inc.php" enctype="multipart/form-data">
                                        <div class="form-row">

                                            <div class="col-md-8 p-1">
                                                <label class="visually-hidden" for="t_name">ชื่อประเภทสินค้า</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="far fa-th-list"></i></div>
                                                    <input type="text" class="form-control" id="t_name" name="t_name" value="<?php echo $row['t_name']; ?>" required>
                                                    <div class="invalid-feedback">กรุณากรอกชื่อประเภทสินค้าให้เรียบร้อย</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="admin_type.inc.php">
                                                <button type="button" class="btn btn-secondary">กลับหน้าหลัก</button>
                                            </a>
                                            <input type="hidden" name="t_id" value="<?php echo $row['t_id']; ?>">
                                            <button type="submit" name="submit" id="js-add-btn" class="btn btn-primary">แก้ไขประเภทสินค้า</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </main>

                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->

                <?php include('admin_footer.inc.php'); ?>

                <?php include('admin_setting.inc.php'); ?>



                <script src="js/vendors.bundle.js"></script>
                <script src="js/app.bundle.js"></script>

                <script>
                    $("#js-add-btn").click(function(event) {

                        // Fetch form to apply custom Bootstrap validation
                        var form = $("#js-login")

                        if (form[0].checkValidity() === false) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.addClass('was-validated');
                        // Perform ajax submit here...
                    });
                </script>

</body>


</html>