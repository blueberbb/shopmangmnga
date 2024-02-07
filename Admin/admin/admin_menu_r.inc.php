           <!-- BEGIN Page Header -->
           <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->

                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                            <i class="ni ni-menu"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                    <i class="ni ni-minify-nav"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                   
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>

                    <div class="ml-auto d-flex">



                        <!-- app user menu -->
                        <div>
                            <a href="#" data-toggle="dropdown" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                <img src="../profile/<?php echo $_SESSION['m_img']; ?>" style="width: 40px;height: 40px;" class="cursor-pointer profile-image rounded-circle" alt="Dr. Codex Lantern">

                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        <span class="mr-2">
                                            <img src="../profile/<?php echo $_SESSION['m_img']; ?>" style="width: 40px;height: 40px;" class=" cursor-pointer rounded-circle profile-image" alt="Dr. Codex Lantern">
                                            <!--ตำแหน่งเปลี่ยนรูปโปรไฟล์-->
                                        </span>
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg"></div>
                                            <!-- <span class="text-truncate text-truncate-md opacity-80">drlantern@gotbootstrap.com</span> -->
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                                        <span data-i18n="drpdwn.settings"><font color="#079ff7"><i class="fal fa-cog"></i> <b>ตั้งค่าระบบ</b></font></span>
                                    </a>

                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item fw-500 pt-3 pb-3" href="admin_logout.inc.php" >
                                    <span data-i18n="drpdwn.page-logout "><i class="far fa-sign-out-alt text-success"></i> <font color="#03fc3d"><b>ออกจากระบบ</b></font></span>
                                    <span class="float-right fw-n"><b><?php echo $_SESSION['m_username']; ?></b></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>