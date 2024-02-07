<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Profile
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
    <style>
        .img-2 {
            width: 150px;
            height: 150px;
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
                        <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">

                        </span>
                        <a href="./logout.php" class="btn-link text-white ml-auto ml-sm-0 btn btn-success">
                            ออกจากระบบ
                        </a>
                    </div>
                </div>
                <dv class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">

                    <div class="container">

                        <!-- profile summary -->
                        <div class="card mb-g rounded-top">
                            <div class="row no-gutters row-grid">
                                <div class="col-12">
                                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                        <img src="./profile/<?php echo $_SESSION['m_img']; ?>" class="rounded-circle shadow-2 img-thumbnail img-2" alt="">
                                        <h2 class="mb-0 fw-700 text-center mt-3">
                                            ประวัติส่วนตัว
                                        </h2>

                                        <div class="mt-3 text-center demo">
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#3b5998">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#38A1F3">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#db3236">
                                                <i class="fab fa-google-plus"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#0077B5">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#000000">
                                                <i class="fab fa-reddit-alien"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#00AFF0">
                                                <i class="fab fa-skype"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#0063DC">
                                                <i class="fab fa-flickr"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="fs-xxl" style="color:#00ff00">
                                                <i class="fab fa-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="m_username">ชื่อผู้ใช้งาน</label>
                                            <input type="text" class="form-control" id="m_username" value="KruKai" disabled>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="m_level">สิทธิการใช้งาน</label>
                                            <input type="text" class="form-control" id="m_level" value="MEMBER" disabled>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="m_name">ชื่อ</label>
                                            <input type="text" class="form-control" id="m_name" value="ณรงค์" disabled>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="m_lname">นามสกุล</label>
                                            <input type="text" class="form-control" id="m_lname" value="สำราญจิตร์" disabled>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="m_email">อีเมลล์</label>
                                            <input type="text" class="form-control" id="m_email" value="kaifaro@hotmail.com" disabled>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="m_phone">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" id="m_phone" value="0833337777" disabled>
                                        </div>

                                    </div>

                                    <div class="form-group ">
                                        <label for="m_address">ที่อยู่</label>
                                        <textarea name="m_address" id="m_address" class="form-control" cols="30" rows="4" disabled>Nkcomservice หนองคาย 43000</textarea>
                                    </div>

                                    <div class="row no-gutters">
                                        <div class="col-md-4 mr-auto text-right">
                                            <a href="../index.php">
                                                <button class="btn btn-block btn-primary btn-lg mt-3">กลับหน้าหลัก</button>
                                            </a>
                                        </div>
                                        <div class="col-md-4 ml-auto text-right frame-wrap">
                                            <button type="button" class="btn btn-block btn-secondary btn-lg mt-3" data-toggle="modal" data-target=".example-modal-default-transparent">แก้ไขโปรไฟล์</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Default Transparent -->
                    <div class="modal fade example-modal-default-transparent" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-transparent" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title text-white">
                                        แก้ไขโปรไฟล์

                                    </h2>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-row">

                                                <div class="form-group col-12">
                                                    <label for="m_img">เปลี่ยนรูปโปรไฟล์</label>
                                                    <!-- <input type="file" class="form-control" id="m_img" onchange="readURL(this)"> -->

                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    </div>

                                                    <figure class="figure d-none">
                                                        <img id="imgUpload" class="figure-img img-fluid rounded" alt="">

                                                    </figure>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="m_username">ชื่อผู้ใช้งาน</label>
                                                    <input type="text" class="form-control" id="m_username">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="m_level">สิทธิการใช้งาน</label>
                                                    <input type="text" class="form-control" id="m_level" value="MEMBER" disabled>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="m_name">ชื่อ</label>
                                                    <input type="text" class="form-control" id="m_name">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="m_lname">นามสกุล</label>
                                                    <input type="text" class="form-control" id="m_lname">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="m_email">อีเมลล์</label>
                                                    <input type="text" class="form-control" id="m_email">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="m_phone">เบอร์โทรศัพท์</label>
                                                    <input type="text" class="form-control" id="m_phone">
                                                </div>

                                            </div>

                                            <div class="form-group ">
                                                <label for="m_address">ที่อยู่</label>
                                                <textarea name="m_address" id="m_address" class="form-control" cols="30" rows="4"></textarea>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="position-absolute pos-bottom pos-left pos-right p-1 text-center text-white">
                        2021 © Ecommerce by&nbsp;<a href='https://www.facebook.com/kaifaro.kai/' class='text-white opacity-40 fw-500' title='gotbootstrap.com' target='_blank'>KruKai</a>
                    </div>
            </div>
        </div>
    </div>
    </div>
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
    <!-- <script>
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
    </script> -->

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

      

        // $('.custom-file-input').on('change', function(){
        //             var fileName = (this).val().split('\\').pop()
        //             $(this).siblings('.custom-file-label').html(fileName)
        //             if(this.files[0]){
        //                 var reader = new FileReader()
        //                 $('.figure').addClass('d-block')
        //                 reader.onload = function (e){
        //                     $('#imgUpload').attr('src', e.target.result)
        //                 }
        //                 reader.readAsDataURL(this.files[0])
        //             }
        //         })


        
    </script>


</body>
<!-- END Body -->

</html>