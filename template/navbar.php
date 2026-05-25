<body class="hold-transition sidebar-mini layout-fixed">

<style>

    /* SIDEBAR TUTUP PAKSA */
    body.paksa-sidebar-tutup .main-sidebar {
        left: -250px !important;
        margin-left: -250px !important;
        transform: translateX(-250px) !important;
    }

    /* CONTENT FULL */
    body.paksa-sidebar-tutup .content-wrapper,
    body.paksa-sidebar-tutup .main-header,
    body.paksa-sidebar-tutup .main-footer {
        margin-left: 0 !important;
    }

    /* ANIMASI */
    .main-sidebar,
    .content-wrapper,
    .main-header,
    .main-footer {
        transition: all 0.3s ease-in-out !important;
    }

</style>

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark"
        style="background-color: #00B4CC;">

        <!-- LEFT NAVBAR -->
        <ul class="navbar-nav">

            <!-- TOMBOL SIDEBAR -->
            <li class="nav-item">

                <a class="nav-link"
                    href="javascript:void(0);"
                    onclick="toggleSidebar()">

                    <i class="fas fa-bars"></i>

                </a>

            </li>

            <!-- DARK MODE -->
            <li class="nav-item ml-3">

                <div class="form-group mb-0">

                    <div class="custom-control custom-switch custom-switch-on-success nav-link">

                        <input type="checkbox"
                            class="custom-control-input"
                            id="cekDark">

                        <label class="custom-control-label"
                            for="cekDark">

                            Dark Mode

                        </label>

                    </div>

                </div>

            </li>

        </ul>



        <!-- RIGHT NAVBAR -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">

                <a href="javascript:void(0);"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown">

                    <?= userLogin()['username'] ?>

                    <i class="fas fa-user-cog ml-2"></i>

                </a>

                <div class="dropdown-menu dropdown-menu-right">

                    <!-- CHANGE PASSWORD -->
                    <a href="<?= $main_url ?>auth/change-password.php"
                        class="dropdown-item text-right">

                        Change Password

                        <i class="fas fa-key ml-2"></i>

                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- LOGOUT -->
                    <a href="<?= $main_url ?>auth/logout.php"
                        class="dropdown-item text-right">

                        Log Out

                        <i class="fas fa-sign-out-alt ml-2"></i>

                    </a>

                </div>

            </li>

        </ul>

    </nav>
    <!-- /.navbar -->



<script>

    // TOGGLE SIDEBAR
    function toggleSidebar() {

        document.body.classList.toggle('paksa-sidebar-tutup');

    }

</script>