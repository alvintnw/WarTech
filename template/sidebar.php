<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= $main_url ?>dashboard.php" class="brand-link">

        <img src="<?= $main_url ?>asset/image/logo.png"
            alt="Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">

        <span class="brand-text font-weight-light">
            WarTech
        </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                role="menu">

                <!-- DASHBOARD -->
                <li class="nav-item">

                    <a href="<?= $main_url ?>dashboard.php"
                        class="nav-link">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>Dashboard</p>

                    </a>

                </li>



                <!-- MASTER -->
<li class="nav-item">

    <a href="javascript:void(0);"
       class="nav-link"
       onclick="toggleMasterMenu();">

        <i class="nav-icon fas fa-folder"></i>

        <p>
            Master
            <i class="right fas fa-angle-left"></i>
        </p>

    </a>

    <ul class="nav nav-treeview"
        id="masterMenu"
        style="display: none;">

        <li class="nav-item">
            <a href="<?= $main_url ?>supplier/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Supplier</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= $main_url ?>customer/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customer</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= $main_url ?>barang/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Barang</p>
            </a>
        </li>

    </ul>

</li>



                <!-- TRANSAKSI -->
                <li class="nav-header">
                    TRANSAKSI
                </li>

                <!-- Pembelian -->
                <li class="nav-item">

                    <a href="<?= $main_url ?>pembelian/index.php"
                        class="nav-link">

                        <i class="nav-icon fas fa-shopping-cart"></i>

                        <p>Pembelian</p>

                    </a>

                </li>

                <!-- Penjualan -->
                <li class="nav-item">

                    <a href="<?= $main_url ?>penjualan/index.php"
                        class="nav-link">

                        <i class="nav-icon fas fa-file-invoice"></i>

                        <p>Penjualan</p>

                    </a>

                </li>



                <!-- REPORT -->
                <li class="nav-header">
                    REPORT
                </li>

                <!-- Laporan Pembelian -->
                <li class="nav-item">

                    <a href="<?= $main_url ?>laporan-pembelian/index.php"
                        class="nav-link">

                        <i class="nav-icon fas fa-chart-pie"></i>

                        <p>Laporan Pembelian</p>

                    </a>

                </li>

                <!-- Laporan Penjualan -->
                <li class="nav-item">

                    <a href="<?= $main_url ?>laporan-penjualan/index.php"
                        class="nav-link">

                        <i class="nav-icon fas fa-chart-line"></i>

                        <p>Laporan Penjualan</p>

                    </a>

                </li>

                <!-- Stock -->
                <li class="nav-item">

                    <a href="<?= $main_url ?>stock/index.php"
                        class="nav-link">

                        <i class="nav-icon fas fa-warehouse"></i>

                        <p>Laporan Stock</p>

                    </a>

                </li>



                <!-- PENGATURAN -->
                <li class="nav-header">
                    PENGATURAN
                </li>

                <!-- User -->
                <li class="nav-item">

                    <a href="<?= $main_url ?>user/index.php"
                        class="nav-link">

                        <i class="nav-icon fas fa-users"></i>

                        <p>Users</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>