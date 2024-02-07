<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        LOGIN ECOM
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">

    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">

    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="css/page-login-alt.css">
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
    <div class="blankpage-form-field">
        <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <img src="img/cart.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                <span class="page-logo-text mr-1">Login Ecommerce</span>
            </a>
            <i class="fal fa-credit-card btn btn-success btn-icon rounded-circle" data-toggle="modal" data-target=".example-modal-top-transparent"></i>
           
        </div>

        <!-- Modal Top Transparent -->
        <div class="modal fade example-modal-top-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top modal-transparent">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="icon-stack fa-6x mr-4 mb-0">
                            <i class="base-4 icon-stack-3x color-danger-500"></i>
                            <i class="base-4 icon-stack-1x color-danger-400"></i>
                            <a href="../index.php">
                                <i class="fal fa-home-lg-alt icon-stack-1x text-white"></i>
                            </a>
                        </div>

                        <div class="icon-stack fa-6x mr-4 mb-0">
                            <i class="base-19 icon-stack-3x color-primary-400"></i>
                            <i class="base-7 icon-stack-2x color-primary-300"></i>
                            <i class="base-7 icon-stack-1x fs-xxl color-primary-200"></i>
                            <i class="base-7 icon-stack-1x color-primary-500"></i>
                            <a href="register.php">
                                <i class="fal fa-users icon-stack-1x text-white opacity-85"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        

        <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
            <form id="js-login" action="./check/checklogin.php" method="POST">
                <div class="form-group">
                    <label class="form-label" for="m_username">Username</label>
                    <input type="text" id="m_username" name="m_username" class="form-control" placeholder="กรุณากรอกชื่อบัญชี" required>
                    <div class="invalid-feedback">กรุณากรอกชื่อบัญชีให้เรียบร้อย</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="m_password">Password</label>
                    <input type="password" id="m_password" name="m_password" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" required>
                    <div class="invalid-feedback">กรุณากรอกรหัสผ่านให้เรียบร้อย</div>
                </div>
                <div class="form-group text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rem" name="rem">
                        <label class="custom-control-label" for="rememberme"> จดจำการเข้าสู่ระบบ </label>
                    </div>
                </div>

                <div class="row no-gutters">
                    <div class="col-lg-6 pr-lg-1 my-2">
                        <button type="reset" class="btn btn-danger btn-block">ยกเลิก</button>
                    </div>

                    <div class="col-lg-6 pr-lg-1 my-2">
                        <button type="submit" name="submit" id="js-login-btn" class="btn btn-info btn-block">เข้าสู่ระบบ</button>
                    </div>
                </div>

                <span class="float-right">สมัครสมาชิก <a href="register.php">คลิกที่นี่</a></span>
            </form>
        </div>
    </div>




    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
        2022 © Ecommerce By TeeOR
    </div>

    <video poster="img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
        <source src="media/video/cc.webm" type="video/webm">
        <source src="media/video/cc.mp4" type="video/mp4">
    </video>
    <!-- BEGIN Color profile -->
    <!-- this area is hidden and will not be seen on screens or screen readers -->
    <!-- we use this only for CSS color refernce for JS stuff -->
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

