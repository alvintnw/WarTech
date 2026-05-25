<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-barang.php";

$title = "Barang";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';

if ($msg == 'deleted') {
    $id = $_GET['id'];
    $gbr = $_GET['gbr'];
    delete($id, $gbr);
    $alert = "<script>
                    $(document).ready(function(){
                        $(document).Toasts('create',{
                            title : 'Sukses',
                            body  : 'Data barang berhasil dihapus dari database..',
                            class : 'bg-success',
                            icon  : 'fas fa-check-circle', 
                        })
                    });
            </script>";
}

if ($msg == 'updated') {
    $alert = "<script>
                    $(document).ready(function(){
                        $(document).Toasts('create',{
                            title : 'Sukses',
                            body  : 'Data barang berhasil diperbarui..',
                            class : 'bg-success',
                            icon  : 'fas fa-check-circle', 
                            position : 'bottomRight',
                            autohide : true,
                            delay : 5000,
                        })
                    });
            </script>";
}

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
            background: rgba(255, 255, 255, .75);
            padding: 10px 16px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
        }

        .beach-card {
            border: none !important;
            border-radius: 24px !important;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .08) !important;
            background: rgba(255, 255, 255, .92) !important;
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

        .btn-add-beach {
            background: #ffffff !important;
            color: #00a884 !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 700;
            padding: 8px 15px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
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
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
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

        .img-barang-beach {
            width: 82px;
            height: 82px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 8px 18px rgba(0,0,0,.12);
            background: #fff;
        }

        .badge-price {
            background: #e8fff8;
            color: #00a884;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 800;
        }

        .btn-barcode-beach,
        .btn-edit-beach,
        .btn-delete-beach {
            border: none !important;
            border-radius: 10px !important;
            padding: 7px 11px;
        }

        .btn-barcode-beach {
            background: #6c757d !important;
            color: white !important;
        }

        .btn-edit-beach {
            background: #ffc107 !important;
            color: #1f2d3d !important;
        }

        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(90deg, #00a884, #00bcd4);
            color: white;
            border-bottom: none;
        }

        .modal-header .close {
            color: white;
            opacity: 1;
        }

        .form-control {
            border-radius: 12px !important;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <div class="beach-title-box">
                        <div class="beach-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div>
                            <h1>Barang</h1>
                            <p>Kelola data barang dengan tampilan pantai yang lebih santai</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right beach-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $main_url ?>dashboard.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Add Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card beach-card">

                <?php
                if ($alert !== '') {
                    echo $alert;
                }
                ?>

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-water mr-2"></i> Data Barang
                    </h3>

                    <a href="<?= $main_url ?>barang/form-barang.php" class="btn btn-sm btn-add-beach float-right">
                        <i class="fas fa-plus fa-sm"></i> Add Barang
                    </a>
                </div>

                <div class="card-body table-responsive p-4">
                    <table class="table table-hover text-nowrap beach-table" id="tblData">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th style="width: 15%;" class="text-center">Operasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $barang = getData("SELECT * FROM tbl_barang");

                            foreach ($barang as $brg) { ?>
                                <tr>
                                    <td>
                                        <img src="../asset/image/<?= $brg['gambar'] ?>"
                                            alt="gambar barang"
                                            class="img-barang-beach">
                                    </td>

                                    <td><strong><?= $brg['id_barang'] ?></strong></td>

                                    <td><?= $brg['nama_barang'] ?></td>

                                    <td>
                                        <span class="badge-price">
                                            Rp <?= number_format($brg['harga_beli'], 0, ',', '.') ?>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge-price">
                                            Rp <?= number_format($brg['harga_jual'], 0, ',', '.') ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-sm btn-barcode-beach"
                                            id="btnCetakBarcode"
                                            data-barcode="<?= $brg['barcode'] ?>"
                                            data-nama="<?= $brg['nama_barang'] ?>"
                                            title="cetak barcode">
                                            <i class="fas fa-barcode"></i>
                                        </button>

                                        <a href="form-barang.php?id=<?= $brg['id_barang'] ?>&msg=editing"
                                            class="btn btn-sm btn-edit-beach"
                                            title="edit barang">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <a href="?id=<?= $brg['id_barang'] ?>&gbr=<?= $brg['gambar'] ?>&msg=deleted"
                                            class="btn btn-sm btn-danger btn-delete-beach"
                                            title="hapus barang"
                                            onclick="return confirm('Anda yakin akan menghapus barang ini ?')">
                                            <i class="fas fa-trash"></i>
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

    <div class="modal fade" id="mdlCetakBarcode">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Cetak Barcode</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nmBrg" class="col-sm-3 col-form-label">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nmBrg" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="barcode" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jmlCetak" class="col-sm-3 col-form-label">Jumlah Cetak</label>
                        <div class="col-sm-9">
                            <input type="number"
                                min="1"
                                max="10"
                                value="1"
                                title="maximal 10"
                                id="jmlCetak"
                                class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>

                    <button type="button" class="btn btn-primary" id="preview">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on("click", "#btnCetakBarcode", function() {
                $('#mdlCetakBarcode').modal('show');

                let barcode = $(this).data('barcode');
                let nama = $(this).data('nama');

                $('#nmBrg').val(nama);
                $('#barcode').val(barcode);
            });

            $(document).on("click", "#preview", function() {
                let barcode = $('#barcode').val();
                let jmlCetak = $('#jmlCetak').val();

                if (jmlCetak > 0 && jmlCetak <= 10) {
                    window.open("../report/r-barcode.php?barcode=" + barcode + "&jmlCetak=" + jmlCetak);
                }
            });
        });
    </script>

<?php

require "../template/footer.php";

?>