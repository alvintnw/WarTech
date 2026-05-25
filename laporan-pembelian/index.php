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

$pembelian = getData("SELECT * FROM tbl_beli_head");

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

        .badge-total {
            background: #e8fff8;
            color: #00a884;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 800;
        }

        .btn-detail-beach {
            background: linear-gradient(90deg, #00a884, #00bcd4) !important;
            border: none !important;
            border-radius: 12px !important;
            color: #fff !important;
            font-weight: 700;
            padding: 7px 14px;
        }

        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(90deg, #00a884, #00bcd4);
            color: #fff;
            border-bottom: none;
        }
    </style>

    <div class="content-header beach-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <div class="beach-title-box">
                        <div class="beach-icon">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                        <div>
                            <h1>Laporan Pembelian</h1>
                            <p>Data pembelian tampil lebih santai seperti suasana pantai</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right beach-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $main_url ?>dashboard.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Pembelian</li>
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
                        <i class="fas fa-water mr-2"></i> Data Pembelian
                    </h3>

                    <button type="button" class="btn btn-sm btn-beach-print float-right"
                        data-toggle="modal" data-target="#mdlPeriodeBeli">
                        <i class="fas fa-print mr-1"></i> Cetak
                    </button>
                </div>

                <div class="card-body table-responsive p-4">
                    <table class="table table-hover text-nowrap beach-table" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pembelian</th>
                                <th>Tgl Pembelian</th>
                                <th>Suplier</th>
                                <th>Total Pembelian</th>
                                <th style="width: 15%;" class="text-center">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pembelian as $beli) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= $beli['no_beli'] ?></strong></td>
                                    <td><?= in_date($beli['tgl_beli']) ?></td>
                                    <td><?= $beli['suplier'] ?></td>
                                    <td>
                                        <span class="badge-total">
                                            Rp <?= number_format($beli['total'], 0, ",", ".") ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="detail-pembelian.php?id=<?= $beli['no_beli'] ?>&tgl=<?= in_date($beli['tgl_beli']) ?>"
                                            class="btn btn-sm btn-detail-beach"
                                            title="rincian barang">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="mdlPeriodeBeli">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Periode Pembelian</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal awal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal akhir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl2">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-detail-beach" onclick="printDoc()">
                        <i class="fas fa-print mr-1"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tgl1 = document.getElementById('tgl1');
        let tgl2 = document.getElementById('tgl2');

        function printDoc() {
            if (tgl1.value != "" && tgl2.value != "") {
                window.open("../report/r-beli.php?tgl1=" + tgl1.value + "&tgl2=" +
                    tgl2.value, "", "width=900, height=600, left=100");
            }
        }
    </script>

<?php

require "../template/footer.php";

?>