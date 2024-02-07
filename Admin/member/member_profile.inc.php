<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_profile
    </title>
    <?php  include('admin_linkon.inc.php');?>
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
            <aside class="page-sidebar bg-dark">
                <div class="page-logo bg-dark">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                        <img src="img/cart.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                        <span class="page-logo-text mr-1">E-COMMERCE</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>

                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <nav id="js-primary-nav" class="primary-nav" role="navigation">

                    <div class="info-card">
                        <img src="img/demo/avatars/avatar-m.png" class="cursor-pointer profile-image rounded-circle" alt="Dr. Codex Lantern"> <!--ตำแหน่งเปลี่ยนรูปโปรไฟล์-->
                        <div class="info-card-text">
                            <a href="#" class="d-flex align-items-center text-white">
                                <span class="text-truncate text-truncate-sm d-inline-block">
                                    ชื่อผู้เข้าระบบ
                                </span>
                            </a>
                            <span class="d-inline-block text-truncate text-truncate-sm">ระดับผู้ใช้งาน</span>
                        </div>
                        <img src="img/card-backgrounds/cover-12-lg.png" class="cover" alt="cover">

                    </div>
                    <ul id="js-nav-menu" class="nav-menu">
                        <li class="active open">
                            <a href="admin_page.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-ballot-check"></i>
                                <span class="nav-link-text">ระบบการจัดการ</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_member.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-users"></i>
                                <span class="nav-link-text">ข้อมูลสมาชิก</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_type.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-th-list"></i>
                                <span class="nav-link-text">ประเภทสินค้า</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_prd.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-shopping-cart"></i>
                                <span class="nav-link-text">สินค้า</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_report.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-file-signature"></i>
                                <span class="nav-link-text">รายงานยอดการขายสินค้า</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_bank.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-landmark"></i>
                                <span class="nav-link-text">บัญชีธนาคาร</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_login.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-inbox-in"></i>
                                <span class="nav-link-text">รายการออเดอร์สินค้า</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_profile.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-id-card"></i>
                                <span class="nav-link-text">โปรไฟล์</span>
                            </a>
                        </li>
                        <li class="active open">
                            <a href="admin_profile.inc.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-users-class"></i>
                                <span class="nav-link-text">รายงานยอดผู้เข้าชมเว็บไซต์</span>
                            </a>
                        </li>

                        <li class="active open">
                            <a href="../check/logout.php" title="Application Intel" data-filter-tags="application intel">
                            <i class="far fa-sign-out-alt"></i>
                                <span class="nav-link-text">ออกจากระบบ</span>
                            </a>
                        </li>

                    </ul>
                    <div class="filter-message js-filter-message bg-success-600"></div>
                </nav>
                <!-- END PRIMARY NAVIGATION -->
                <!-- NAV FOOTER -->

            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->
                    
                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                            <i class="ni ni-menu "></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                    <i class="ni ni-minify-nav m-md-6"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                   
                    <a href="admin_edit_member.inc.php">
                    <button class="btn btn-success " data-toggle="modal" data-target=".example-modal-default-transparent">แก้ไขข้อมูล</button>
                    </a>
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>

                    <div class="ml-auto d-flex">
                   

                    
                        <!-- app user menu -->
                        <div>
                             <a href="#" data-toggle="dropdown"  class="header-icon d-flex align-items-center justify-content-center ml-2">
                                <img src="img/demo/avatars/avatar-m.png" class="cursor-pointer profile-image rounded-circle" alt="Dr. Codex Lantern"> <!--ตำแหน่งเปลี่ยนรูปโปรไฟล์-->
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                   
                                        <span class="mr-2">
                                             <img src="img/demo/avatars/avatar-m.png" class="cursor-pointer rounded-circle profile-image" alt="Dr. Codex Lantern"> <!--ตำแหน่งเปลี่ยนรูปโปรไฟล์-->
                                        </span>
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg">Dr. Codex Lantern</div>
                                            <!-- <span class="text-truncate text-truncate-md opacity-80">drlantern@gotbootstrap.com</span> -->
                                        </div>
                                    </div>
                                </div>
                               

                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item fw-500 pt-3 pb-3" href="../check/logout.php">
                                    <span data-i18n="drpdwn.page-logout">Logout</span>
                                    <span class="float-right fw-n">&commat;codexlantern</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>

                <main id="js-page-content" role="main" class="page-content">

 

                <div class="card mb-g rounded-top">
                                    <div class="row no-gutters row-grid">
                                        <div class="col-12">
                                            <div class="text-center">
                                        <i class="far fa-user-edit text-center m-md-3" style="font-size: 30px;">ประวัติส่วนตัว</i>
                                        </div>
                                          
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                                <img src="img/demo/avatars/avatar-admin-lg.png" class="rounded-circle shadow-2 img-thumbnail" alt="">
                                                <h5 class="mb-0 fw-700 text-center mt-3">
                                                    Dr. Codex Lantern
                                                    
                                                </h5>
                                                <div class="form-group col-md-6">
                                            <label for="m_username">ชื่อผู้ใช้งาน</label>
                                            <input type="text" class="form-control" id="m_username" value="KruKai" disabled>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="m_level">สิทธิการใช้งาน</label>
                                            <input type="text" class="form-control" id="m_level" value="ADMIN" disabled>
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

                                        <div class="form-group col-md-6">
                                        <label for="m_address">ที่อยู่</label>
                                        <textarea name="m_address" id="m_address" class="form-control" cols="30" rows="4" disabled>Nkcomservice หนองคาย 43000</textarea>
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
                                                    <input type="text" class="form-control" id="m_level" value="ADMIN" disabled>
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
                                                                                                                                    
                 

                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2021 © E-COMMERCE by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>KAIFARO</a></span>
                    </div>

                </footer>

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
                <!-- END Color profile -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
    <!-- BEGIN Quick Menu -->
    <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
    <nav class="shortcut-menu d-none d-sm-block">
        <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
        <label for="menu_open" class="menu-open-button ">
            <span class="app-shortcut-icon d-block"></span>
        </label>
        <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
            <i class="fal fa-arrow-up"></i>
        </a>
        <a href="page_login.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
            <i class="fal fa-sign-out"></i>
        </a>

    </nav>



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

        $('.custom-file-input')
    </script>
</body>
<!-- END Body -->

</html>