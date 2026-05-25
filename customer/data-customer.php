<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-customer.php";

$title = "Data Customer";
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
    $alert = '<div class="alert alert-success alert-dismissible beach-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Customer berhasil dihapus..
              </div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible beach-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check-circle"></i> Alert!</h5>
                Customer berhasil diperbarui..
              </div>';
}

if ($msg == 'aborted') {
    $alert = '<div class="alert alert-danger alert-dismissible beach-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                Customer gagal dihapus..
              </div>';
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

        .btn-add-beach {
            background: #ffffff !important;
            color: #00a884 !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 700;
            padding: 8px 15px;
            box-shadow: 0 8px 18px rgba(0,0,0,.12);
        }

        .btn-add-beach:hover {
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

        .btn-edit-beach {
            background: #ffc107 !important;
            border: none !important;
            border-radius: 10px !important;
            color: #1f2d3d !important;
            padding: 7px 11px;
        }

        .btn-delete-beach {
            border-radius: 10px !important;
            padding: 7px 11px;
        }

        .beach-alert {
            margin: 20px 20px 0;
            border-radius: 16px;
            border: none;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2 align-items-center">

                <div class="col-sm-6">
                    <div class="beach-title-box">

                        <div class="beach-icon">
                            <i class="fas fa-users"></i>
                        </div>

                        <div>
                            <h1>Customer</h1>
                            <p>Kelola data customer dengan tampilan pantai yang lebih santai</p>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right beach-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $main_url ?>dashboard.php">Home</a>
                        </li>

                        <li class="breadcrumb-item active">Data Customer</li>
                    </ol>
                </div>

            </div>

        </div>
    </div>

    <section>
        <div class="container-fluid">

            <div class="card beach-card">

                <?php
                if ($alert != '') {
                    echo $alert;
                }
                ?>

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-water mr-2"></i> Data Customer
                    </h3>

                    <a href="<?= $main_url ?>customer/add-customer.php"
                        class="btn btn-sm btn-add-beach float-right">

                        <i class="fas fa-plus fa-sm"></i> Add Customer

                    </a>

                </div>

                <div class="card-body table-responsive p-4">

                    <table class="table table-hover text-nowrap beach-table" id="tblData">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telpon</th>
                                <th>Alamat</th>
                                <th>Deskripsi</th>
                                <th style="width: 10%;">Operasi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $no = 1;

                            $customers = getData("SELECT * FROM tbl_customer");

                            foreach ($customers as $customer):
                            ?>

                                <tr>

                                    <td><?= $no++ ?></td>

                                    <td>
                                        <strong><?= $customer['nama'] ?></strong>
                                    </td>

                                    <td><?= $customer['telpon'] ?></td>

                                    <td><?= $customer['alamat'] ?></td>

                                    <td><?= $customer['deskripsi'] ?></td>

                                    <td>

                                        <a href="edit-customer.php?id=<?= $customer['id_customer'] ?>"
                                            class="btn btn-sm btn-edit-beach"
                                            title="edit customer">

                                            <i class="fas fa-pen"></i>

                                        </a>

                                        <a href="del-customer.php?id=<?= $customer['id_customer'] ?>"
                                            class="btn btn-sm btn-danger btn-delete-beach"
                                            title="hapus customer"
                                            onclick="return confirm('Anda Yakin ingin menghapus customer ini ?')">

                                            <i class="fas fa-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </section>

<?php
require "../template/footer.php";
?>