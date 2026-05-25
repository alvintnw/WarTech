<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/functions.php";
require "../module/mode-jual.php";

$title = "Transaksi";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

// jika barang dihapus
if ($msg == 'deleted') {
    $barcode = $_GET['barcode'];
    $idjual = $_GET['idjual'];
    $qty = $_GET['qty'];
    $tgl = $_GET['tgl'];
    delete($barcode, $idjual, $qty);
    echo "<script>
            alert('barang telah dihapus..');
            document.location = '?tgl=$tgl';
        </script>";
}

// jika ada barcode yang dikirim
$kode = @$_GET['barcode'] ? @$_GET['barcode'] : '';
if ($kode) {
    $tgl = $_GET['tgl'];
    $dataBrg = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE barcode = '$kode'");
    $selectBrg = mysqli_fetch_assoc($dataBrg);

    if (!mysqli_num_rows($dataBrg)) {
        echo "<script>
            alert('barang dengan barcode tersebut tidak ada..');
            document.location = '?tgl=$tgl';
        </script>";
    }
}

// jika tombol tambah barang ditekan
if (isset($_POST['addbrg'])) {
    $tgl = $_POST['tglNota'];
    if (insert($_POST)) {
        echo "<script>
            document.location = '?tgl=$tgl';
        </script>";
    }
}

// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $nota = $_POST['nojual'];
    if (simpan($_POST)) {
        echo "<script>
                alert('data penjualan berhasil disimpan');
                window.onload = function(){
                    let win = window.open('../report/r-struk.php?nota=$nota',
                    'Struk Belanja','width=260,height=400,left=10,top=10',
                    '_blank');
                        if(win){
                        win.focus();
                        window.location = 'index.php';
                    }
                }
        </script>";
    }
}

$nojual = generateNo();

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

        .total-beach {
            background: linear-gradient(135deg, #00a884, #00bcd4) !important;
            color: #fff;
            border: none !important;
            border-radius: 24px !important;
            box-shadow: 0 15px 35px rgba(0, 188, 212, .25) !important;
        }

        .total-beach h6,
        .total-beach h1 {
            color: #fff !important;
        }

        .form-control {
            border-radius: 12px !important;
            min-height: 42px;
        }

        .input-group-text {
            border-radius: 0 12px 12px 0 !important;
            background: #e8fff8 !important;
            color: #00a884 !important;
            border-color: #dce3ea !important;
        }

        .btn-beach {
            background: linear-gradient(90deg, #00a884, #00bcd4) !important;
            border: none !important;
            border-radius: 14px !important;
            color: #fff !important;
            font-weight: 700;
            padding: 10px;
            box-shadow: 0 8px 18px rgba(0, 168, 132, .22);
        }

        .btn-beach:hover {
            color: #fff !important;
            opacity: .9;
            transform: translateY(-1px);
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
            background: #fff;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .04);
        }

        .beach-table tbody td {
            border-top: none !important;
            vertical-align: middle;
            padding: 14px;
        }

        .beach-table tbody tr td:first-child {
            border-radius: 14px 0 0 14px;
        }

        .beach-table tbody tr td:last-child {
            border-radius: 0 14px 14px 0;
        }

        .btn-delete-beach {
            border-radius: 12px !important;
            padding: 7px 12px;
        }

        .payment-label {
            font-weight: 700;
            color: #0077b6;
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
                            <h1>Penjualan Barang</h1>
                            <p>Tambah transaksi penjualan dengan tampilan pantai yang lebih santai</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right beach-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $main_url ?>dashboard.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <form action="" method="post">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card beach-card p-3">
                            <div class="form-group row mb-2">
                                <label for="noNota" class="col-sm-2 col-form-label">No Nota</label>
                                <div class="col-sm-4">
                                    <input type="text"
                                        name="nojual"
                                        class="form-control"
                                        id="noNota"
                                        value="<?= $nojual ?>">
                                </div>

                                <label for="tglNota" class="col-sm-2 col-form-label">Tgl Nota</label>
                                <div class="col-sm-4">
                                    <input type="date"
                                        name="tglNota"
                                        class="form-control"
                                        id="tglNota"
                                        value="<?= @$_GET['tgl'] ? $_GET['tgl'] : date('Y-m-d') ?>"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="barcode" class="col-sm-2 col-form-label">Barcode</label>
                                <div class="col-sm-10 input-group">
                                    <input type="text"
                                        name="barcode"
                                        id="barcode"
                                        value="<?= @$_GET['barcode'] ? $_GET['barcode'] : '' ?>"
                                        class="form-control"
                                        placeholder="masukkan barcode barang">

                                    <div class="input-group-append">
                                        <span class="input-group-text" id="icon-barcode">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card total-beach pt-3 px-3 pb-2">
                            <h6 class="font-weight-bold text-right">Total Penjualan</h6>
                            <h1 class="font-weight-bold text-right" style="font-size:40pt;">
                                <input type="hidden" name="total" id="total" value="<?= totalJual($nojual) ?>">
                                <?= number_format(totalJual($nojual), 0, ',', '.') ?>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card beach-card pt-3 pb-3 px-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="hidden"
                                    value="<?= @$_GET['barcode'] ? $selectBrg['barcode'] : '' ?>"
                                    name="barcode">

                                <label for="namaBrg">Nama Barang</label>
                                <input type="text"
                                    name="namaBrg"
                                    class="form-control form-control-sm"
                                    id="namaBrg"
                                    value="<?= @$_GET['barcode'] ? $selectBrg['nama_barang'] : '' ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number"
                                    name="stok"
                                    class="form-control form-control-sm"
                                    id="stok"
                                    value="<?= @$_GET['barcode'] ? $selectBrg['stock'] : '' ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text"
                                    name="satuan"
                                    class="form-control form-control-sm"
                                    id="satuan"
                                    value="<?= @$_GET['barcode'] ? $selectBrg['satuan'] : '' ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number"
                                    name="harga"
                                    class="form-control form-control-sm"
                                    id="harga"
                                    value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : '' ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number"
                                    name="qty"
                                    class="form-control form-control-sm"
                                    id="qty"
                                    value="<?= @$_GET['barcode'] ? 1 : '' ?>">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="jmlHarga">Jumlah Harga</label>
                                <input type="number"
                                    name="jmlHarga"
                                    class="form-control form-control-sm"
                                    id="jmlHarga"
                                    value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : '' ?>"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-beach btn-block" name="addbrg">
                        <i class="fas fa-cart-plus fa-sm"></i> Tambah Barang
                    </button>
                </div>

                <div class="card beach-card table-responsive px-3 pt-3">
                    <table class="table table-sm table-hover text-nowrap beach-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Jumlah Harga</th>
                                <th class="text-right" width="10%">Operasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $brgDetail = getData("SELECT * FROM tbl_jual_detail WHERE no_jual = '$nojual'");
                            foreach ($brgDetail as $detail) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $detail['barcode'] ?></td>
                                    <td><?= $detail['nama_brg'] ?></td>
                                    <td class="text-right"><?= number_format($detail['harga_jual'], 0, ',', '.') ?></td>
                                    <td class="text-right"><?= $detail['qty'] ?></td>
                                    <td class="text-right"><?= number_format($detail['jml_harga'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <a href="?barcode=<?= $detail['barcode'] ?>&idjual=<?= $detail['no_jual'] ?>&qty=<?= $detail['qty'] ?>&tgl=<?= $detail['tgl_jual'] ?>&msg=deleted"
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

                <div class="row mt-3">
                    <div class="col-lg-4 p-2">
                        <div class="card beach-card p-3">
                            <div class="form-group row mb-2">
                                <label for="customer" class="col-sm-3 col-form-label col-form-label-sm">
                                    Customer
                                </label>

                                <div class="col-sm-9">
                                    <select name="customer"
                                        id="customer"
                                        class="form-control form-control-sm">
                                        <?php
                                        $customers = getData("SELECT * FROM tbl_customer");

                                        foreach ($customers as $customer) { ?>
                                            <option value="<?= $customer['nama'] ?>">
                                                <?= $customer['nama'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="ketr" class="col-sm-3 col-form-label">
                                    Keterangan
                                </label>

                                <div class="col-sm-9">
                                    <textarea name="ketr"
                                        id="ketr"
                                        rows="4"
                                        class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 py-2 px-2">
                        <div class="card beach-card p-3">
                            <div class="form-group row mb-2">
                                <label for="bayar" class="col-sm-3 col-form-label payment-label">
                                    Bayar
                                </label>

                                <div class="col-sm-9">
                                    <input type="number"
                                        name="bayar"
                                        class="form-control form-control-sm text-right"
                                        id="bayar">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="kembalian" class="col-sm-3 col-form-label payment-label">
                                    Kembalian
                                </label>

                                <div class="col-sm-9">
                                    <input type="number"
                                        name="kembalian"
                                        class="form-control form-control-sm text-right"
                                        id="kembalian"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 p-2">
                        <div class="card beach-card p-3">
                            <button type="submit"
                                name="simpan"
                                id="simpan"
                                class="btn btn-beach btn-block">

                                <i class="fa fa-save"></i> Simpan Penjualan
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>

    <script>
        let barcode = document.getElementById('barcode');
        let tgl = document.getElementById('tglNota');
        let qty = document.getElementById('qty');
        let harga = document.getElementById('harga');
        let jmlHarga = document.getElementById('jmlHarga');
        let bayar = document.getElementById('bayar');
        let kembalian = document.getElementById('kembalian');
        let total = document.getElementById('total');

        barcode.addEventListener('change', function() {
            if (barcode.value != "") {
                document.location.href = '?barcode=' + barcode.value + '&tgl=' + tgl.value;
            }
        });

        qty.addEventListener('input', function() {
            jmlHarga.value = qty.value * harga.value;
        });

        bayar.addEventListener('input', function() {
            kembalian.value = bayar.value - total.value;
        });
    </script>

<?php

require "../template/footer.php";

?>