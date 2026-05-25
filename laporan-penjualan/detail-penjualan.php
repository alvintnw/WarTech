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

$id  = $_GET['id'];
$tgl = $_GET['tgl'];

$penjualan = getData("SELECT * FROM tbl_jual_detail WHERE no_jual = '$id'");

?>

<div class="content-wrapper beach-page">

    <style>
        .beach-page {
            background:
                radial-gradient(circle at top left, rgba(0, 188, 212, .18), transparent 35%),
                linear-gradient(135deg, #e0f7fa 0%, #fdf6e3 100%) !important;
            min-height: 100vh;
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

        .badge-beach-id {
            background: #ffc107;
            color: #1f2d3d;
            padding: 8px 14px;
            border-radius: 12px;
            font-weight: 700;
            margin-right: 6px;
        }

        .badge-beach-date {
            background: linear-gradient(90deg, #00a884, #00bcd4);
            color: white;
            padding: 8px 14px;
            border-radius: 12px;
            font-weight: 700;
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

        .price-badge {
            background: #e8fff8;
            color: #00a884;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 700;
        }

        .qty-badge {
            background: #e3f2fd;
            color: #0077b6;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 700;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2 align-items-center">

                <div class="col-sm-6">
                    <div class="beach-title-box">
                        <div class="beach-icon">
                            <i class="fas fa-cash-register"></i>
                        </div>

                        <div>
                            <h1>Detail Penjualan</h1>
                            <p>Rincian barang penjualan dengan tampilan pantai yang lebih santai</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right beach-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $main_url ?>dashboard.php">Home</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="<?= $main_url ?>laporan-penjualan">Penjualan</a>
                        </li>

                        <li class="breadcrumb-item active">Detail</li>
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
                        <i class="fas fa-water mr-2"></i> Rincian Barang
                    </h3>

                    <div class="float-right">
                        <span class="badge-beach-id">
                            <?= $id ?>
                        </span>

                        <span class="badge-beach-date">
                            <?= $tgl ?>
                        </span>
                    </div>
                </div>

                <div class="card-body table-responsive p-4">
                    <table class="table table-hover text-nowrap beach-table">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th class="text-center">Harga Jual</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Jumlah Harga</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            $no = 1;

                                foreach ($penjualan as $jual) { 
                        ?>
                                <tr>
                                    <td><?= $no++ ?></td>

                                    <td>
                                        <strong><?= $jual['barcode'] ?></strong>
                                    </td>

                                    <td><?= $jual['nama_brg'] ?></td>

                                    <td class="text-center">
                                        <span class="price-badge">
                                            Rp <?= number_format($jual['harga_jual'], 0, ",", ".") ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="qty-badge">
                                            <?= $jual['qty'] ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="price-badge">
                                            Rp <?= number_format($jual['jml_harga'], 0, ",", ".") ?>
                                        </span>
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