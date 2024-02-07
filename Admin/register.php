<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Register
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit:400" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
        </style>
</head>

<body>

    <script>
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],

            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';

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

        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|footer|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }

        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <div class="page-wrapper auth">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                    <div class="d-flex align-items-center container p-0">
                        <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                            <a href="../index.php" class="page-logo-link press-scale-down d-flex align-items-center">
                                <img src="img/logo1.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">กลับหน้าหลัก</span>
                            </a>
                        </div>
                        
                    </div>
                </div>
                <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-5 px-sm-0">
                        <div class="row">
                           
                            <div class="col-xl-6 ml-auto mr-auto">
                                <div class="card p-4 rounded-plus bg-faded">
                                <p class="text-center"><b>ฟอร์มสมัครสมาชิก<b></p>
                                   <form id="js-login" novalidate="" method="POST" action="">
                                        <div class="form-row">
                                            
                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="fname">เลือกสิทธิการใช้งาน</label>
                                                <select name="m_level" id="fname" class="form-control" required>
                                                    <option value="">เลือกสิทธิการใช้งาน</option>
                                                    <option value="MEMBER">MEMBER</option>
                                                </select>
                                                <div class="invalid-feedback">กรุณากรอกสิทธิการใช้งานให้เรียบร้อย</div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="m_fname">คำนำหน้าชื่อ</label>
                                                <select name="m_fname" id="m_fname" class="form-control" required>
                                                    <option value="">คำนำหน้าชื่อ</option>
                                                    <option value="นาย">นาย</option>
                                                    <option value="นาง">นาง</option>
                                                    <option value="นางสาว">นางสาว</option>
                                                </select>
                                                <div class="invalid-feedback">กรุณากรอกคำนำหน้าชื่อให้เรียบร้อย</div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="m_name">ชื่อ</label>
                                                <input type="text" name="m_name" id="m_name" class="form-control input02" placeholder="กรุณากรอกชื่อ" required>
                                                <div class="invalid-feedback">กรุณากรอกชื่อให้เรียบร้อย</div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="m_lname">นามสกุล</label>
                                                <input type="text" name="m_lname" id="m_lname" class="form-control" placeholder="กรุณากรอกนามสกุล" required>
                                                <div class="invalid-feedback">กรุณากรอกนามสกุลให้เรียบร้อย</div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="m_email">อีเมลล์</label>
                                                <input type="email" name="m_email" id="m_email" class="form-control" placeholder="example@email.com" required>
                                                <div class="invalid-feedback">กรุณากรอก email ให้เรียบร้อย</div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="m_phone">เบอร์โทรศัพท์</label>
                                                <input type="text" name="m_phone" id="m_phone" class="form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์" required>
                                                <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์ให้เรียบร้อย</div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="m_username">Username</label>
                                                <input type="text" name="m_username" id="m_username" class="form-control" placeholder="กรุณากรอกชื่อที่ใช้ล็อคอิน" required>
                                                <div class="invalid-feedback">กรุณากรอกชื่อที่ใช้ล็อคอินให้เรียบร้อย</div>
                                            </div>

                                            <div class="form-group col-sm-12 col-md-6">
                                                <label  for="m_password">Password</label>
                                                <input type="password" name="m_password" id="m_password" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" required>
                                                <div class="invalid-feedback">กรุณากรอกรหัสผ่านให้เรียบร้อย</div>
                                            </div>

                                        </div>
                                     
                                           
                                            <div class="text-right ">
                                                <button id="js-login-btn" type="submit" name="submit" class="btn  btn-primary btn-block"><b>บันทึกข้อมูล</b></button>
                                            </div>
                                       
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="position-absolute pos-bottom pos-left pos-right p-1 text-center text-white">
                        2021 © Ecommerce by&nbsp;<a class="border-bottom border-2 border-primary text-decoration-none" href="https://www.facebook.com/profile.php?id=100015738907302" style="color: #fff";>facebook</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    
    <p id="js-color-profile" class="d-none">
        <span class="color-primary-50"></span>
        <span class="color-primary-100"></span>
        <span class="color-primary-200"></span>
        <span class="color-primary-300"></span>
        <span class="color-primary-400"></span>
        <span class="color-primary-500"></span>
        <span class="color-primary-600"></span>
        <span class="color-primary-700"></span>
        <span class="color-primary-800"></span>
        <span class="color-primary-900"></span>
        <span class="color-info-50"></span>
        <span class="color-info-100"></span>
        <span class="color-info-200"></span>
        <span class="color-info-300"></span>
        <span class="color-info-400"></span>
        <span class="color-info-500"></span>
        <span class="color-info-600"></span>
        <span class="color-info-700"></span>
        <span class="color-info-800"></span>
        <span class="color-info-900"></span>
        <span class="color-danger-50"></span>
        <span class="color-danger-100"></span>
        <span class="color-danger-200"></span>
        <span class="color-danger-300"></span>
        <span class="color-danger-400"></span>
        <span class="color-danger-500"></span>
        <span class="color-danger-600"></span>
        <span class="color-danger-700"></span>
        <span class="color-danger-800"></span>
        <span class="color-danger-900"></span>
        <span class="color-warning-50"></span>
        <span class="color-warning-100"></span>
        <span class="color-warning-200"></span>
        <span class="color-warning-300"></span>
        <span class="color-warning-400"></span>
        <span class="color-warning-500"></span>
        <span class="color-warning-600"></span>
        <span class="color-warning-700"></span>
        <span class="color-warning-800"></span>
        <span class="color-warning-900"></span>
        <span class="color-success-50"></span>
        <span class="color-success-100"></span>
        <span class="color-success-200"></span>
        <span class="color-success-300"></span>
        <span class="color-success-400"></span>
        <span class="color-success-500"></span>
        <span class="color-success-600"></span>
        <span class="color-success-700"></span>
        <span class="color-success-800"></span>
        <span class="color-success-900"></span>
        <span class="color-fusion-50"></span>
        <span class="color-fusion-100"></span>
        <span class="color-fusion-200"></span>
        <span class="color-fusion-300"></span>
        <span class="color-fusion-400"></span>
        <span class="color-fusion-500"></span>
        <span class="color-fusion-600"></span>
        <span class="color-fusion-700"></span>
        <span class="color-fusion-800"></span>
        <span class="color-fusion-900"></span>
    </p>
    
    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>
        $("#js-login-btn").click(function(event) {

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

    include_once('./connect/conndb.php');
    $m_username = mysqli_real_escape_string($conn, $_POST["m_username"]);
    $m_password = mysqli_real_escape_string($conn, sha1( $_POST["m_password"]));
    $m_fname = mysqli_real_escape_string($conn, $_POST["m_fname"]);
    $m_name = mysqli_real_escape_string($conn, $_POST["m_name"]);
    $m_lname = mysqli_real_escape_string($conn, $_POST["m_lname"]);
    $m_email = mysqli_real_escape_string($conn, $_POST["m_email"]);
    $m_phone = mysqli_real_escape_string($conn, $_POST["m_phone"]);
    // $m_address = mysqli_real_escape_string($conn, $_POST["m_address"]);
    $m_level = mysqli_real_escape_string($conn, $_POST["m_level"]);

    
    //เช็คชื่อที่ใช้ล็อคอินซ้ำ
    $check = "SELECT m_username FROM tbl_member WHERE m_username = '$m_username'";
    $result1 = mysqli_query($conn, $check) or die(mysqli_error($conn));
    $num = mysqli_num_rows($result1);

    if ($num > 0) {
        echo "<script>";
        echo "alert('ชื่อที่ใช้ล็อคอินซ้ำ กรุณากรอกใหม่อีกครั้ง!!!!');";
        echo "window.history.back();";
        echo "</script>";
    } else {
        $sql = "INSERT INTO tbl_member
        (
            m_username,
            m_password,
            m_fname,
            m_name,
            m_lname,
            m_email,
            m_phone,
            m_address,
            m_level
        )
        VALUES
        (
           '$m_username',
           '$m_password',
           '$m_fname',
           '$m_name',
           '$m_lname',
           '$m_email',
           '$m_phone',
           '$m_address',
           '$m_level'
        )";

        $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
    }

    mysqli_close($conn);

    if ($result) {
        echo '<script tpye="text/javascript">
        Swal.fire({icon: "success",title: "สมัครสมาชิกเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
        </script>';
        echo '<meta http-equiv="refresh" content="2;url=login.php">';
        
    } else {
        echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "กิดข้อผิดพลาด กรุณาสมัครสมาชิกใหม่อีกครั้ง",showConfirmButton: false,timer: 3000})
    </script>';
        echo '<meta http-equiv="refresh" content="2;url=register.php">';
       
    }
}


?>