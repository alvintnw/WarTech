<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <title><?= $title ?></title>

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <!-- IonIcons -->
    <link rel="stylesheet"
        href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet"
        href="<?= $main_url ?>asset/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon"
        href="<?= $main_url ?>asset/image/cart.png"
        type="image/x-icon">

    <!-- jQuery -->
    <script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="<?= $main_url ?>asset/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- CUSTOM MODERN UI -->
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: #f4f8fb;
        }

        .content-wrapper {
            background: #f4f8fb !important;
        }

        /* NAVBAR */
        .main-header {
            background: linear-gradient(90deg, #00bcd4, #00a884) !important;
            border-bottom: none !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .main-header .nav-link,
        .main-header .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 600;
        }

        /* SIDEBAR TOGGLE */
        body.sidebar-collapse .main-sidebar {
            margin-left: -250px !important;
        }

        body.sidebar-collapse .content-wrapper,
        body.sidebar-collapse .main-footer,
        body.sidebar-collapse .main-header {
            margin-left: 0 !important;
        }

        body.sidebar-hide .main-sidebar {
            transform: translateX(-250px) !important;
        }

        body.sidebar-hide .content-wrapper,
        body.sidebar-hide .main-header,
        body.sidebar-hide .main-footer {
            margin-left: 0 !important;
        }

        .main-sidebar,
        .content-wrapper,
        .main-footer,
        .main-header {
            transition: all 0.3s ease-in-out !important;
        }

        /* SIDEBAR MODERN */
        .main-sidebar {
            background: linear-gradient(180deg, #073b4c 0%, #062d3a 100%) !important;
            box-shadow: 4px 0 18px rgba(0, 0, 0, 0.18);
        }

        .brand-link {
            background: rgba(255, 255, 255, 0.08) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            padding: 18px 14px !important;
        }

        .brand-text {
            font-weight: 700 !important;
            letter-spacing: 0.5px;
            color: #ffffff !important;
        }

        .brand-image {
            background: #ffffff;
            padding: 3px;
            border-radius: 50%;
        }

        .sidebar {
            padding: 12px 10px;
        }

        .nav-sidebar .nav-header {
            color: #8fdde7 !important;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-top: 14px;
            padding-left: 12px;
        }

        .nav-sidebar .nav-link {
            color: #d9f7fb !important;
            border-radius: 12px !important;
            margin-bottom: 6px;
            padding: 11px 14px;
            transition: all 0.2s ease-in-out;
        }

        .nav-sidebar .nav-link:hover {
            background: rgba(0, 180, 204, 0.22) !important;
            color: #ffffff !important;
            transform: translateX(4px);
        }

        .nav-sidebar .nav-link.active {
            background: #00b4cc !important;
            color: #ffffff !important;
            box-shadow: 0 8px 18px rgba(0, 180, 204, 0.35);
        }

        .nav-sidebar .nav-icon {
            color: #8fdde7 !important;
            margin-right: 8px;
        }

        .nav-sidebar .nav-link:hover .nav-icon,
        .nav-sidebar .nav-link.active .nav-icon {
            color: #ffffff !important;
        }

        .nav-treeview {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            padding: 6px;
            margin: 4px 0 8px 0;
        }

        .nav-treeview .nav-link {
            padding-left: 24px !important;
            font-size: 14px;
            border-radius: 10px !important;
        }

        .nav-treeview .far {
            font-size: 11px;
        }

        .main-sidebar::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .main-sidebar::-webkit-scrollbar-thumb,
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 10px;
        }

        /* PAGE TITLE MODERN */
        .page-title-box {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-icon {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            background: #e8fff8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00a884;
            font-size: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .page-title-box h1 {
            font-weight: 700;
            margin: 0;
            color: #26344d;
        }

        .page-title-box p {
            margin: 3px 0 0;
            color: #7b8794;
        }

        /* CARD MODERN */
        .custom-card {
            border: none !important;
            border-radius: 18px !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07) !important;
            background: #ffffff !important;
        }

        .card {
            border-radius: 18px !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07) !important;
        }

        .custom-card .card-header {
            background: transparent !important;
            border-bottom: none !important;
            font-weight: 700;
            color: #26344d;
            padding: 18px 22px 5px !important;
        }

        .card-body {
            padding: 18px 22px 22px !important;
        }

        /* FORM MODERN */
        .form-control,
        .custom-select,
        select {
            border-radius: 10px !important;
            border: 1px solid #dce3ea !important;
            min-height: 42px;
        }

        .form-control:focus,
        .custom-select:focus,
        select:focus {
            border-color: #00a884 !important;
            box-shadow: 0 0 0 0.15rem rgba(0, 168, 132, 0.15) !important;
        }

        label {
            color: #26344d;
            font-weight: 700;
        }

        /* BUTTON MODERN */
        .btn-info,
        .btn-primary,
        .btn-success {
            background: linear-gradient(90deg, #00a884, #00bcd4) !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 700;
            box-shadow: 0 7px 18px rgba(0, 168, 132, 0.25);
        }

        .btn-info:hover,
        .btn-primary:hover,
        .btn-success:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        /* TABLE */
        .table {
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .table thead th {
            background: #f8fafc;
            color: #26344d;
            border-bottom: 1px solid #e5e9f0;
        }

        /* FOOTER */
        .main-footer {
            background: #ffffff !important;
            border-top: 1px solid #e9eef3 !important;
            color: #7b8794;
        }
    </style>

</head>