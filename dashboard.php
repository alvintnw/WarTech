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

  .content-wrapper {
    background: linear-gradient(135deg, #e0f7fa 0%, #e8f5e9 50%, #fff9e6 100%);
    font-family: 'Nunito', sans-serif;
    min-height: 100vh;
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
    text-decoration: none;
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
  .card-barang   { background: linear-gradient(135deg, #D4AC0D, #F4D03F); color: #333; }
  .card-barang:hover { color: #333; }
  .card-barang .stat-footer { border-top-color: rgba(0,0,0,0.15); }

  /* ===== INFO CARDS (Stock & Omzet) ===== */
  .beach-card {
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 150, 199, 0.10);
    border: none;
    overflow: hidden;
    margin-bottom: 24px;
  }
  .beach-card .beach-card-header {
    background: linear-gradient(90deg, #0096C7, #48CAE4);
    color: #fff;
    padding: 14px 20px;
    font-weight: 700;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .beach-card .beach-card-header a {
    color: rgba(255,255,255,0.85);
    font-size: 1rem;
  }
  .beach-card .beach-card-header a:hover { color: #fff; }

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
  .breadcrumb { background: transparent; padding: 0; }
  .breadcrumb-item a { color: #00B4D8; }
  .breadcrumb-item.active { color: #0077B6; }
  .breadcrumb-item + .breadcrumb-item::before { color: #90E0EF; }

  /* ===== EMPTY STATE ===== */
  .empty-stock {
    padding: 24px;
    text-align: center;
    color: #b0c4cb;
    font-size: 0.9rem;
  }

  /* ============================================================
     DARK MODE OVERRIDES
     Semua override dark mode pakai !important supaya bisa
     mengalahkan style default di atas
  ============================================================ */
  body.dark-mode .content-wrapper {
    background: linear-gradient(135deg, #0d1b2a 0%, #1b2838 50%, #1a1a2e 100%) !important;
  }

  body.dark-mode .beach-page-title {
    color: #48CAE4 !important;
  }

  body.dark-mode .breadcrumb-item a {
    color: #48CAE4 !important;
  }

  body.dark-mode .breadcrumb-item.active {
    color: #90E0EF !important;
  }

  body.dark-mode .breadcrumb-item + .breadcrumb-item::before {
    color: #4a6278 !important;
  }

  /* Banner tetap sama di dark mode (sudah gelap) */
  body.dark-mode .beach-banner {
    background: linear-gradient(135deg, #023e58 0%, #0077B6 60%, #0096C7 100%) !important;
    box-shadow: 0 8px 32px rgba(0, 119, 182, 0.4) !important;
  }

  /* Stat cards — warnanya sedikit digelapkan */
  body.dark-mode .card-users {
    background: linear-gradient(135deg, #b85c00, #cc6f00) !important;
  }
  body.dark-mode .card-supplier {
    background: linear-gradient(135deg, #005f7a, #0077B6) !important;
  }
  body.dark-mode .card-customer {
    background: linear-gradient(135deg, #a01e29, #c0392b) !important;
  }
  body.dark-mode .card-barang {
    background: linear-gradient(135deg, #8a6d00, #b8860b) !important;
    color: #f5f5f5 !important;
  }
  body.dark-mode .card-barang:hover {
    color: #f5f5f5 !important;
  }

  /* Info cards */
  body.dark-mode .beach-card {
    background: #1e2d3d !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4) !important;
  }

  body.dark-mode .beach-card table td {
    color: #cce7f0 !important;
    border-bottom-color: #2a3f52 !important;
  }

  body.dark-mode .beach-card table tr:hover td {
    background: #253545 !important;
  }

  body.dark-mode .omzet-value {
    color: #48CAE4 !important;
  }

  body.dark-mode .omzet-value span {
    color: #90E0EF !important;
  }

  body.dark-mode .empty-stock {
    color: #4a6278 !important;
  }
    border-radius:20px;
    padding:30px;
    color:white;
    margin-bottom:30px;
}

.banner h2{
    margin:0;
    font-size:30px;
}

.banner p{
    margin-top:10px;
}

/* Mengubah nama dari .row menjadi .card-row agar tidak merusak Grid Bootstrap di bawah */
.card-row{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

.card{
    flex:1;
    min-width:220px;
    padding:25px;
    border-radius:20px;
    color:white;
    box-shadow:0 6px 20px rgba(0,0,0,0.15);
}

.card h3{
    margin:0;
    font-size:18px;
}

.card .number{
    font-size:42px;
    font-weight:800;
    margin-top:15px;
}

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
                    $allStock = getData("SELECT * FROM tbl_barang");

                    if(count($allStock) > 0){

                        foreach($allStock as $row){
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