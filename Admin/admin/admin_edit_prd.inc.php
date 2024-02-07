<?php

include_once('admin_head.inc.php');
$ID = $_GET['p_id'];
if (!isset($_GET['p_id'])) {
    header('Location:admin_prd.inc.php');
}
$sql = "SELECT * 
FROM tbl_prd as p 
INNER JOIN tbl_prd_type as t ON p.ref_t_id=t.t_id
WHERE p.p_id=$ID";
$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
extract($row);

$ref_t_id = $row['ref_t_id'];

//query prd type 
$query = "SELECT * FROM tbl_prd_type 
WHERE t_id!=$ref_t_id" or die("Error:" . mysqli_error($conn));
$result2 = mysqli_query($conn, $query);

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_edit_prd
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

                    <div class="card mb-g rounded-top">
                        <div class="row no-gutters row-grid">
                            <div class="col-12">
                                <form action="admin_edit_prd_db.inc.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="text-center m-md-2">

                                    </div>
                                    <div class="" id="default-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h5 class="modal-title text-center"><i class="fal fa-cart-plus text-center m-md-3" style="font-size: 25px;"> แก้ไขสินค้า</i></h5>

                                                    <a href="admin_prd.inc.php">
                                                        <span aria-hidden="true"><i class="fal fa-times" style="font-size: 25px;"></i></span>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="js-login" novalidate="" method="post" action="admin_add_prd_db.inc.php" enctype="multipart/form-data">
                                                        <div class="form-row">

                                                            <div class="col-md-3 p-1">
                                                                <label class="visually-hidden" for="p_img">รูปสินค้า</label>
                                                                ภาพเดิม <br>
                                                                <img src="../img_product/<?php echo $row['p_img']; ?>" width="150px" height="150px">
                                                                <br><br>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                                                    <input type="file" class="form-control" id="p_img" name="p_img" onchange="readURL(this)" accept="image/*">
                                                                </div>
                                                                <figure class="figure d-none">
                                                                    <img id="imgUpload" class="figure-img img-fluid rounded text-center" alt="">
                                                                </figure>
                                                            </div>


                                                            <div class="col-md-3 p-1">
                                                                <label class="visually-hidden" for="p_img1">รูปสินค้า2</label>
                                                                ภาพเดิม <br>
                                                                <img src="../img_product/<?php echo $row['p_img1']; ?>" width="150px" height="150px">
                                                                <br><br>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                                                    <input type="file" class="form-control" id="p_img1" name="p_img1" onchange="readURL1(this)" accept="image/*">
                                                                </div>
                                                                <figure class="figure d-none">
                                                                    <img id="imgUpload1" class="figure-img img-fluid rounded text-center" alt="">

                                                                </figure>
                                                            </div>

                                                            <div class="col-md-3 p-1">
                                                                <label class="visually-hidden" for="p_img2">รูปสินค้า3</label>
                                                                ภาพเดิม <br>
                                                                <img src="../img_product/<?php echo $row['p_img2']; ?>" width="150px" height="150px">
                                                                <br><br>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                                                    <input type="file" class="form-control" id="p_img2" name="p_img2" onchange="readURL2(this)" accept="image/*">
                                                                </div>
                                                                <figure class="figure d-none">
                                                                    <img id="imgUpload2" class="figure-img img-fluid rounded text-center" alt="">

                                                                </figure>
                                                            </div>

                                                            <div class="col-md-3 p-1">
                                                                <label class="visually-hidden" for="p_img3">รูปสินค้า4</label>
                                                                ภาพเดิม <br>
                                                                <img src="../img_product/<?php echo $row['p_img3']; ?>" width="150px" height="150px">
                                                                <br><br>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                                                    <input type="file" class="form-control" id="p_img3" name="p_img3" onchange="readURL3(this)" accept="image/*">
                                                                </div>
                                                                <figure class="figure d-none">
                                                                    <img id="imgUpload3" class="figure-img img-fluid rounded text-center" alt="">

                                                                </figure>
                                                            </div>
                                                            <div class="col-md-6 p-1">
                                                                <label class="visually-hidden" for="p_name">ชื่อสินค้า</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                                                    <input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo $row['p_name']; ?>" required>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 p-1">
                                                                <label for="ref_t_id">ประเภทสินค้า </label>
                                                                <select name="ref_t_id" id="ref_t_id" class="form-control" required>
                                                                    <option value="<?php echo $row['ref_t_id']; ?>">- <?php echo $row['t_name']; ?> -</option>
                                                                    <?php foreach ($result2 as $results) { ?>
                                                                        <option value="<?php echo $results["t_id"]; ?>">
                                                                            - <?php echo $results["t_name"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>


                                                            <div class="col-md-6 p-1">
                                                                <label class="visually-hidden" for="p_price">ราคา</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-money-bill-wave"></i></div>
                                                                    <input type="number" class="form-control" id="p_price" name="p_price" value="<?php echo $row['p_price']; ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 p-1">
                                                                <label class="visually-hidden" for="p_qty">จำนวนสินค้า</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-calendar-check"></i></div>
                                                                    <input type="number" class="form-control" id="p_qty" name="p_qty" value="<?php echo $row['p_qty']; ?>" required>
                                                                </div>
                                                            </div>
                                           
                                                            <div class="col-md-12 p-1">
                                                                <label class="visually-hidden" for="p_intro">รายละเอียดสินค้าแบบสั้นๆ</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text"><i class="fal fa-list"></i></div>
                                                                    <input type="text" class="form-control" id="p_intro" name="p_intro" value="<?php echo $row['p_intro']; ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-12 p-1">
                                                                <label class="visually-hidden" for="p_detail">รายละเอียดสินค้า</label>
                                                                <div class="input-group">

                                                                    <textarea class="col-12 form-control" name="p_detail"  cols="30" rows="5" required><?php echo $row['p_detail']; ?></textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="p_img5" value="<?php echo $row['p_img']; ?>">
                                                            <input type="hidden" name="p_img6" value="<?php echo $row['p_img1']; ?>">
                                                            <input type="hidden" name="p_img7" value="<?php echo $row['p_img2']; ?>">
                                                            <input type="hidden" name="p_img8" value="<?php echo $row['p_img3']; ?>">
                                                            <input type="hidden" name="p_id" value="<?php echo $row['p_id']; ?>">
                                                            <input type="hidden" name="p_m_name" value="<?php echo $m_username; ?>">
                                                            <input type="hidden" name="p_m_edit_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                            <input type="hidden" name="ref_m_id" value="<?php echo $m_id; ?>">
                                                            
                                                            <button type="submit" id="js-add-btn" name="" class="btn btn-primary">แก้ไขข้อมูล</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <?php include('admin_update_prd.inc.php'); ?>


                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <?php include('admin_footer.inc.php'); ?>

                <?php include('admin_setting.inc.php'); ?>

                <script src="../ckeditor/ckeditor.js"></script>
                <script src="js/vendors.bundle.js"></script>
                <script src="js/app.bundle.js"></script>
                <script>
                    CKEDITOR.replace('detail');
                </script>
                <script>
                    function readURL(input) {
                        if (input.files[0]) {
                            var reader = new FileReader()
                            $('.figure').addClass('d-block')
                            reader.onload = function(e) {
                                $('#imgUpload').attr('src', e.target.result).height(200)
                            }
                            reader.readAsDataURL(input.files[0])
                        }
                    }

                    function readURL1(input) {
                        if (input.files[0]) {
                            var reader = new FileReader()
                            $('.figure').addClass('d-block')
                            reader.onload = function(e) {
                                $('#imgUpload1').attr('src', e.target.result).height(200)
                            }
                            reader.readAsDataURL(input.files[0])
                        }
                    }

                    function readURL2(input) {
                        if (input.files[0]) {
                            var reader = new FileReader()
                            $('.figure').addClass('d-block')
                            reader.onload = function(e) {
                                $('#imgUpload2').attr('src', e.target.result).height(200)
                            }
                            reader.readAsDataURL(input.files[0])
                        }
                    }

                    function readURL3(input) {
                        if (input.files[0]) {
                            var reader = new FileReader()
                            $('.figure').addClass('d-block')
                            reader.onload = function(e) {
                                $('#imgUpload3').attr('src', e.target.result).height(200)
                            }
                            reader.readAsDataURL(input.files[0])
                        }
                    }

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
<!-- END Body -->

</html>