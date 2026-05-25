<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: auth/login.php");
    exit();
}

require "config/config.php";
require "config/functions.php";

$title = "Dashboard";
require "template/header.php";

require "template/navbar.php";
require "template/sidebar.php";


// DATA DASHBOARD

// USER
$users = getData("SELECT * FROM tbl_user");
$userNum = count($users);

// SUPPLIER
$suppliers = getData("SELECT * FROM tbl_supplier");
$supplierNum = count($suppliers);

// CUSTOMER
// sementara dibuat manual karena tabel belum ada
$customerNum = 0;

// BARANG
$barang = getData("SELECT * FROM tbl_barang");
$brgNum = count($barang);

?>

<body>

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap');

body{
    background: linear-gradient(135deg, #e0f7fa 0%, #e8f5e9 50%, #fff9e6 100%);
    font-family: 'Nunito', sans-serif;
    margin:0;
    padding:0;
}

.container{
    width:95%;
    margin:auto;
    padding-top:20px;
}

.title{
    font-size:32px;
    font-weight:800;
    color:#0077B6;
    margin-bottom:20px;
}

.banner{
    background: linear-gradient(135deg, #0077B6 0%, #00B4D8 60%, #48CAE4 100%);
    border-radius: 20px;
    padding: 28px 32px;
    color: #fff;
    position: relative;
    overflow: hidden;
    margin-bottom: 24px;
    box-shadow: 0 8px 32px rgba(0, 180, 216, 0.3);
  }
  .beach-banner::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
  }
  .beach-banner::after {
    content: '';
    position: absolute;
    bottom: -60px; right: 80px;
    width: 280px; height: 280px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
  }
  .beach-banner h2 {
    font-size: 1.8rem;
    font-weight: 800;
    margin: 0 0 6px;
  }
  .beach-banner p {
    margin: 0;
    opacity: 0.85;
    font-size: 0.95rem;
  }
  .beach-banner .wave-icon {
    position: absolute;
    right: 32px; top: 50%;
    transform: translateY(-50%);
    font-size: 5rem;
    opacity: 0.18;
  }

  /* ===== STAT BOXES ===== */
  .beach-stat-card {
    border-radius: 18px;
    padding: 22px 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    transition: transform 0.2s, box-shadow 0.2s;
    display: block;
    text-decoration: none !important;
    margin-bottom: 20px;
  }
  .beach-stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.18);
    color: #fff;
  }
  .beach-stat-card .card-bg-icon {
    position: absolute;
    right: -10px; bottom: -10px;
    font-size: 5rem;
    opacity: 0.15;
  }
  .beach-stat-card .stat-label {
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.85;
    margin-bottom: 4px;
  }
  .beach-stat-card .stat-number {
    font-size: 2.6rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 12px;
  }
  .beach-stat-card .stat-footer {
    font-size: 0.8rem;
    opacity: 0.8;
    border-top: 1px solid rgba(255,255,255,0.25);
    padding-top: 10px;
    margin-top: 4px;
  }

  /* Box Colors */
  .card-users    { background: linear-gradient(135deg, #FF8C00, #FFA940); }
  .card-supplier { background: linear-gradient(135deg, #0096C7, #00B4D8); }
  .card-customer { background: linear-gradient(135deg, #E63946, #FF6B6B); }
  .card-barang   { background: linear-gradient(135deg, #D4AC0D, #F4D03F); color: #333 !important; }
  .card-barang:hover { color: #333 !important; }
  .card-barang .stat-footer { border-top-color: rgba(0,0,0,0.15); }

/* Mengubah nama dari .row menjadi .card-row agar tidak merusak Grid Bootstrap di bawah */
.card-row{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

  .beach-card table { margin: 0; }
  .beach-card table td {
    padding: 12px 20px;
    border-bottom: 1px solid #f0f9fc;
    font-size: 0.88rem;
  }
  .beach-card table tr:last-child td { border-bottom: none; }
  .beach-card table tr:hover td { background: #f0f9fc; }

  /* Omzet card */
  .omzet-card .beach-card-header {
    background: linear-gradient(90deg, #27AE60, #2ECC71);
  }
  .omzet-value {
    padding: 28px 24px;
    font-size: 2.2rem;
    font-weight: 800;
    color: #0096C7;
  }
  .omzet-value span { font-size: 1rem; font-weight: 600; color: #48CAE4; }

  /* ===== PAGE TITLE ===== */
  .beach-page-title {
    font-weight: 800;
    font-size: 1.5rem;
    color: #0077B6;
    margin-bottom: 4px;
  }
  .breadcrumb { background: transparent !important; padding: 0 !important; }
  .breadcrumb-item a { color: #00B4D8 !important; }
  .breadcrumb-item.active { color: #0077B6 !important; }
  .breadcrumb-item + .breadcrumb-item::before { color: #90E0EF; }

.users{
    background: linear-gradient(135deg, #FF8C00, #FFA940);
}

.supplier{
    background: linear-gradient(135deg, #0096C7, #00B4D8);
}

.customer{
    background: linear-gradient(135deg, #E63946, #FF6B6B);
}

.barang{
    background: linear-gradient(135deg, #D4AC0D, #F4D03F);
    color:#333;
}

/* Mengubah nama class agar tidak bertabrakan dengan AdminLTE */
.dashboard-info-box{
    background:white;
    border-radius:20px;
    padding:25px;
    margin-top:20px;
    box-shadow:0 4px 20px rgba(0,0,0,0.1);
    display: block !important;
}

.dashboard-info-title{
    font-size:22px;
    font-weight:700;
    margin-bottom:20px;
    color:#0077B6;
    display: block !important;
}

.stock-item{
    padding:10px 0;
    border-bottom:1px solid #eee;
    display: block !important;
}

.omzet{
    font-size:40px;
    font-weight:800;
    color:#0096C7;
    margin-top:10px;
    display: block !important;
}
</style>

<div class="content-wrapper" style="background: transparent !important; padding-bottom: 40px;">

    <div class="container">

        <div class="title">
            Dashboard
        </div>

        <div class="banner">
            <h2>
                Selamat Datang,
                <?= htmlspecialchars(userLogin()['username']) ?>
            </h2>

            <p>
                Semoga harimu menyenangkan seperti angin sepoi di tepi pantai 🌴
            </p>
        </div>

        <div class="card-row">

            <div class="card users">
                <h3>Total User</h3>
                <div class="number">
                    <?= $userNum ?>
                </div>
            </div>

            <div class="card supplier">
                <h3>Total Supplier</h3>
                <div class="number">
                    <?= $supplierNum ?>
                </div>
            </div>

            <div class="card customer">
                <h3>Total Customer</h3>
                <div class="number">
                    <?= $customerNum ?>
                </div>
            </div>

            <div class="card barang">
                <h3>Total Barang</h3>
                <div class="number">
                    <?= $brgNum ?>
                </div>
            </div>

        </div>

        <div class="row">
            
            <div class="col-md-6">
                <div class="dashboard-info-box">

                    <div class="dashboard-info-title">
                        Info Stock Barang
                    </div>

                    <?php
                    // LOGIKA BARU: Mengambil seluruh barang tanpa filter WHERE
                    $allStock = getData("SELECT * FROM tbl_barang");

                    if(count($allStock) > 0){

                        foreach($allStock as $row){
                            // Melakukan pengecekan kondisi stok satu per satu secara dinamis
                            if($row['stock'] < $row['stock_minimal']){
                                echo '
                                <div class="stock-item">
                                    '.$row['nama_barang'].' - <span style="color: #E63946; font-weight: bold;">Stock Kurang ⚠️</span>
                                </div>
                                ';
                            } else {
                                echo '
                                <div class="stock-item">
                                    '.$row['nama_barang'].' - <span style="color: #2a9d8f; font-weight: bold;">Stock Cukup ✅</span>
                                </div>
                                ';
                            }
                        }

                    } else {
                        echo '
                        <div class="stock-item">
                            Belum ada data barang 📦
                        </div>
                        ';
                    }
                    ?>

                </div>
            </div>

            <div class="col-md-6">
                <div class="dashboard-info-box">

                    <div class="dashboard-info-title">
                        Omzet Penjualan
                    </div>

                    <div class="omzet">
                        Rp <?= omzet() ?>
                    </div>

                </div>
            </div>

        </div> 

    </div>

</div>

<?php require "template/footer.php"; ?>
