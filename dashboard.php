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

// sementara dimatikan dulu agar tidak error
require "template/navbar.php";
require "template/sidebar.php";



// ======================
// DATA DASHBOARD
// ======================

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
    width:90%;
    margin:auto;
    padding-top:40px;
}

.title{
    font-size:32px;
    font-weight:800;
    color:#0077B6;
    margin-bottom:20px;
}

.banner{
    background: linear-gradient(135deg, #0077B6 0%, #00B4D8 60%, #48CAE4 100%);
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

.row{
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

.info-box{
    background:white;
    border-radius:20px;
    padding:25px;
    margin-top:30px;
    box-shadow:0 4px 20px rgba(0,0,0,0.1);
}

.info-title{
    font-size:22px;
    font-weight:700;
    margin-bottom:20px;
    color:#0077B6;
}

.stock-item{
    padding:10px 0;
    border-bottom:1px solid #eee;
}

.omzet{
    font-size:40px;
    font-weight:800;
    color:#0096C7;
}
</style>

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

    <div class="row">

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

    <div class="info-box">

        <div class="info-title">
            Info Stock Barang
        </div>

        <?php

        $stockMin = getData("SELECT * FROM tbl_barang WHERE stock < stock_minimal");

        if(count($stockMin) > 0){

            foreach($stockMin as $min){

                echo '
                <div class="stock-item">
                    '.$min['nama_barang'].' - Stock Kurang
                </div>
                ';
            }

        } else {

            echo '
            <div class="stock-item">
                Semua stok aman ✅
            </div>
            ';
        }

        ?>

    </div>

    <div class="info-box">

        <div class="info-title">
            Omzet Penjualan
        </div>

        <div class="omzet">
            Rp <?= omzet() ?>
        </div>

    </div>

</div>

</body>
</html>