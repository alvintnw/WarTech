<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-barang.php";

$title = "Laporan";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$stockBrg = getData("SELECT * FROM tbl_barang");

?>

<div class="content-wrapper beach-page">

    <style>
        .beach-page {
            background:
                radial-gradient(circle at top left, rgba(0, 188, 212, .18), transparent 35%),
                linear-gradient(135deg, #e0f7fa 0%, #fdf6e3 100%) !important;
            min-height: 100vh;
        }

        .beach-header {
            padding: 25px 5px 10px;
        }

        .beach-title-box {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .beach-icon {
            width: 62px;
            height: 62px;
            border-radius: 20px;
            background: linear-gradient(135deg, #00bcd4, #00a884);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 12px 28px rgba(0, 168, 132, .25);
        }

        .beach-title-box h1 {
            margin: 0;
            font-weight: 800;
            color: #0077b6;
        }

        .beach-title-box p {
            margin: 4px 0 0;
            color: #6c757d;
        }

        .beach-breadcrumb {
            background: rgba(255,255,255,.75);
            padding: 10px 16px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,.05);
        }

        .beach-card {
            border: none !important;
            border-radius: 24px !important;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,.08) !important;
            background: rgba(255,255,255,.92) !important;
        }

        .beach-card .card-header {
            background: linear-gradient(90deg, #00a884, #00bcd4) !important;
            color: #fff !important;
            padding: 20px 24px !important;
            border-bottom: none !important;
        }

        .beach-card .card-title {
            font-weight: 700;
            font-size: 18px;
        }

        .btn-beach-print {
            background: #ffffff !important;
            color: #00a884 !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 700;
            padding: 8px 15px;
            box-shadow: 0 8px 18px rgba(0,0,0,.12);
        }

        .btn-beach-print:hover {
            background: #e8fff8 !important;
            color: #00796b !important;
        }

        .beach-table {
            border-collapse: separate !important;
            border-spacing: 0 10px !important;
        }

        .beach-table thead th {
            background: #f1fbfc !important;
            color: #0077b6 !important;
            border: none !important;
            font-weight: 800;
        }

        .beach-table tbody tr {
            background: #ffffff;
            box-shadow: 0 8px 18px rgba(0,0,0,.04);
        }

        .beach-table tbody td {
            border-top: none !important;
            vertical-align: middle;
            padding: 16px 14px;
        }

        .beach-table tbody tr td:first-child {
            border-radius: 14px 0 0 14px;
        }

        .beach-table tbody tr td:last-child {
            border-radius: 0 14px 14px 0;
        }

        .badge-stock {
            background: #e8fff8;
            color: #00a884;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 800;
        }

        .badge-minimal {
            background: #fff7df;
            color: #c58b00;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 800;
        }

        .status-cukup {
            background: #e8fff8;
            color: #00a884;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 800;
        }

        .status-kurang {
            background: #ffe8e8;
            color: #dc3545;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 800;
        }
    </style>

    <div class="content-header beach-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <div class="beach-title-box">
                        <div class="beach-icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <div>
                            <h1>Stock Barang</h1>
                            <p>Monitoring stok barang lebih santai dengan nuansa pantai</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right beach-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $main_url ?>dashboard.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Stock</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card beach-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-boxes mr-2"></i> Stock
                    </h3>

                    <a href="<?= $main_url ?>report/r-stock.php"
                        class="btn btn-sm btn-beach-print float-right"
                        target="_blank">
                        <i class="fas fa-print mr-1"></i> Cetak
                    </a>
                </div>

                <div class="card-body table-responsive p-4">
                    <table class="table table-hover text-nowrap beach-table" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Jumlah Stock</th>
                                <th>Stock Minimal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($stockBrg as $stock) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $stock['id_barang'] ?></strong></td>
                                    <td><?= $stock['nama_barang'] ?></td>
                                    <td><?= $stock['satuan'] ?></td>
                                    <td class="text-center">
                                        <span class="badge-stock"><?= $stock['stock'] ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-minimal"><?= $stock['stock_minimal'] ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($stock['stock'] < $stock['stock_minimal']) {
                                            echo '<span class="status-kurang">Stock Kurang</span>';
                                        } else {
                                            echo '<span class="status-cukup">Stock Cukup</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </section>

<?php

require "../template/footer.php";

?>