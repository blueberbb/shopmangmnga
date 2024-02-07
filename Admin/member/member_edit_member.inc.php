<?php
session_start();
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
 include_once('../connect/conndb.php');
 $m_id = $_SESSION['m_id'];
 $m_username = $_SESSION['m_username'];
 $m_img = $_SESSION['m_img'];
 $m_level = $_SESSION['m_level'];
 $m_name = $_SESSION['m_name'];
 $m_lname = $_SESSION['m_lname'];
 $m_email = $_SESSION['m_email'];
 $m_address = $_SESSION['m_address'];
 $m_phone = $_SESSION['m_phone'];


 
$sql = "SELECT * FROM tbl_member WHERE m_id=$m_id";
$result = mysqli_query($conn, $sql) or die ("Error in query: $ sql " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
extract($row);
$m_img = $row['m_img'];
$m_username = $row['m_username'];
// echo $m_username;

// echo '<pre>';
// print_r($_row);
// echo '</pre>';
 
if ($m_level != 'MEMBER') {
    Header("Location:../../index.php");
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Edit_Member
    </title>
    <?php include('member_linkon.inc.php'); ?>
    

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
                        <span class="page-logo-text mr-1">E-COMMERCE</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>

                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <?php include('member_menu_l.inc.php'); ?>

                <!-- END PRIMARY NAVIGATION -->
                <!-- NAV FOOTER -->

            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <?php include('member_menu_r.inc.php'); ?>
                <main id="js-page-content" role="main" class="page-content">

                    <div class="card mb-g rounded-top">
                        <div class="row no-gutters row-grid">
                            <div class="col-12 ">

                                <form action="" id="js-login" method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="text-center m-md-2">
                                        <i class="far fa-user-edit " style="font-size: 30px;">แก้ไขข้อมูล</i>
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                        <img src="../profile/<?php echo $row['m_img']; ?>" class="img-profile rounded-circle shadow-2 img-thumbnail">
                                        <h5 class="mb-0 fw-700 text-center mt-3 ">
                                            เปลี่ยนรูปโปรไฟล์
                                            <input type="file" class="form-control" name="m_img" id="m_img" onchange="readURL(this)" accept="image/*">
                                            <figure class="figure d-none">
                                                <img id="imgUpload" class="figure-img img-fluid rounded text-center" alt="">
                                            </figure>
                                        </h5>

                                        <div class="row">
                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="m_username">Username</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-user-check"></i></div>
                                                    <input type="text" class="form-control" id="m_username" name="m_username" value="<?php echo $row['m_username']; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 p-1">
                                                <label for="m_level">สิทธิ์การใช้งาน</label>
                                                <select name="m_level" id="m_level" class="form-control" disabled>
                                                    <option value="<?php echo $row['m_level']; ?>"><?php echo $row['m_level']; ?></option>
                                                    <option value="MEMBER">- MEMBER</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="m_name">ชื่อ</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-user"></i></div>
                                                    <input type="text" class="form-control" id="m_name" name="m_name" required value="<?php echo $row['m_name']; ?>">
                                                    <div class="invalid-feedback">กรุณากรอกชื่อให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="m_lname">นามสกุล</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-user"></i></div>
                                                    <input type="text" class="form-control" id="m_lname" name="m_lname" required value="<?php echo $row['m_lname']; ?>">
                                                    <div class="invalid-feedback">กรุณากรอกนามสกุลให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="m_email">อีเมลล์</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-envelope-open"></i></div>
                                                    <input type="email" class="form-control" id="m_email" name="m_email" required value="<?php echo $row['m_email']; ?>">
                                                    <div class="invalid-feedback">กรุณากรอกอีเมลล์ให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="m_phone">เบอร์โทรศัพท์</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-phone-office"></i></div>
                                                    <input type="text" class="form-control" id="m_phone" name="m_phone" required value="<?php echo $row['m_phone']; ?>">
                                                    <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์ให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                            <div class="form-group col-12 p-1">
                                                <label class="visually-hidden" for="m_address">ที่อยู่</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-home-lg-alt"></i></div>
                                                    <textarea class="col-12 form-control" name="m_address" id="m_address" cols="30" rows="3" required placeholder="ที่อยู่"><?php echo $row['m_address']; ?></textarea>
                                                    <div class="invalid-feedback">กรุณากรอกที่อยู่ให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-2 row p-3">
                                            <input type="hidden" name="m_img2" value="<?php echo $row['m_img']; ?>">
                                            <input type="hidden" name="m_id" value="<?php echo $row['m_id']; ?>">
                                            <button type="submit" id="js-add-btn" name="submit" class="btn btn-primary btn-block ">แก้ไขข้อมูล</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2021 © E-COMMERCE by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>KAIFARO</a></span>
                    </div>

                </footer>

                <?php include('member_setting.inc.php'); ?>


                <script src="js/vendors.bundle.js"></script>
                <script src="js/app.bundle.js"></script>
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

<?php

if (isset($_POST['submit'])) {

    echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    include('../connect/conndb.php');
     

    $m_name = mysqli_real_escape_string($conn, $_POST["m_name"]);
    $m_lname = mysqli_real_escape_string($conn, $_POST["m_lname"]);
    $m_email = mysqli_real_escape_string($conn, $_POST["m_email"]);
    $m_phone = mysqli_real_escape_string($conn, $_POST["m_phone"]);
    $m_address = mysqli_real_escape_string($conn, $_POST["m_address"]);
    $m_img2 = mysqli_real_escape_string($conn, $_POST["m_img2"]);
    $m_id  = mysqli_real_escape_string($conn, $_POST["m_id"]);



    $date1 = date("Ymd_His");
    $numrand = (mt_rand());
    $m_pic = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
    $upload = $_FILES['m_img']['name'];

    if ($upload != '') {
        $path = "../profile/";
        $type = strrchr($_FILES['m_img']['name'], ".");
        $newname = $numrand . $date1 . $type;
        $path_copy = $path . $newname;
        $path_link = "../profile/" . $newname;
        move_uploaded_file($_FILES['m_img']['tmp_name'], $path_copy);
    } else {
        $newname = $m_img2;
    }


    //เช็คชื่อที่ใช้ล็อคอินซ้ำ

    $sql = "UPDATE tbl_member SET 
          
            m_name='$m_name',
	        m_lname='$m_lname',
	        m_email='$m_email',
	        m_phone='$m_phone',
	        m_address='$m_address',
	        m_img='$newname'	      
	        WHERE m_id=$m_id
            ";

    $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
    mysqli_close($conn);

    if ($result) {
        echo '<script tpye="text/javascript">
        Swal.fire({icon: "success",title: "แก้ไขข้อมูลเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
        </script>';
        echo '<meta http-equiv="refresh" content="2;url=">';
    } else {
        echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "แก้ไขข้อมูลไม่สำเร็จ",showConfirmButton: false,timer: 3000})
    </script>';
        echo '<meta http-equiv="refresh" content="2;url=">';
    }
}

?>