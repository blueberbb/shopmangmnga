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

if ($_GET['do'] == 'pass') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "รหัสไม่ตรงกันกรุณาแก้ไขใหม่อีกครั้ง",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=">';
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Edit_Pass
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

                                <form action="" id="js-login" method="post" class="form-horizontal">
                                    <div class="text-center m-md-2">
                                        <i class="fal fa-key " style="font-size: 30px;"> แก้ไขรหัสผ่าน</i>
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                        <div class="row">
                                            <div class="col-md-12 p-1">
                                                <label class="visually-hidden" for="m_username">Username</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-user-check"></i></div>
                                                    <input type="text" class="form-control" id="m_username" name="" value="<?php echo $row['m_username']; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-12 p-1">
                                                <label class="visually-hidden" for="m_password1">New Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-key"></i></div>
                                                    <input type="password" class="form-control" id="m_password1" name="m_password1" required>
                                                    <div class="invalid-feedback">กรุณากรอกรหัสผ่านใหม่ให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 p-1">
                                                <label class="visually-hidden" for="m_password2">Confirm Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-key"></i></div>
                                                    <input type="password" class="form-control" id="m_password2" name="m_password2" required >
                                                    <div class="invalid-feedback">กรุณากรอกยืนยันรหัสผ่านใหม่ให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-2 row p-3">
                                            <input type="hidden" name="m_id" value="<?php echo $row['m_id']; ?>">
                                            <button type="submit" id="js-add-btn" name="submit" class="btn btn-primary btn-block ">แก้ไขรหัสผ่าน</button>
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


    $m_id  = $_POST["m_id"];
    $m_password1 = sha1($_POST["m_password1"]);
    $m_password2 = sha1($_POST["m_password2"]);

    if ($m_password1  != $m_password2) {
        echo "<script type='text/javascript'>";
	echo "alert('รหัสผ่านไม่ตรงกันกรุณากรอกใหม่อีกครั้ง');";
	echo "window.location = 'member_edit_pass.inc.php'; ";
	echo "</script>";
   
     
    } else {
        $sql = "UPDATE tbl_member SET 
          
          m_password='$m_password1'
	       WHERE m_id=$m_id
            ";

        $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
        mysqli_close($conn);
    }
    if ($result) {
        echo '<script tpye="text/javascript">
        Swal.fire({icon: "success",title: "แก้ไขรหัสผ่านใหม่เรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
        </script>';
        echo '<meta http-equiv="refresh" content="2;url=member_page.inc.php">';
    } else {
        echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "แก้ไขรหัสผ่านไม่สำเร็จ",showConfirmButton: false,timer: 3000})
    </script>';
        echo '<meta http-equiv="refresh" content="2;url=">';
    }
}

?>