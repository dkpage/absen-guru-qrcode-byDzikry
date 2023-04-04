<?php
require 'config/config.default.php';

if(empty($id_user)){
	header('location: ../login');
}



$data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_user'");

$pengguna = mysqli_fetch_array($data_user);
    $iduser = $pengguna['id'];
    $roleuser = $pengguna['role'];
    $jabatanuser = $pengguna['jabatan'];
    $guruuser = $pengguna['guru'];
    $namauser = $pengguna['nama'];
    $emailuser = $pengguna['email'];
    $unameuser = $pengguna['uname'];
    $pwduser = $pengguna['pwd'];
    $nipuser = $pengguna['nip'];
    $mapeluser = $pengguna['mapel'];
    $qruser= $pengguna['qrcode'];
    if(!empty($pengguna['foto'])){
        $fotouser= $pengguna['foto'];
    }else{
        $fotouser= 'blank.jpg';
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Auto Logout jika 15 menit tidak aktif -->
    <meta http-equiv="refresh" content="900;url=auto-logout.php" />
    <title><?= $title; ?> - <?= $n_aplikasi; ?> - <?= $sekolah; ?> </title>

    <!-- Pavicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="dist/img/<?= $logo ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <!-- Font Awesome kit -->
    <link rel="stylesheet" href="plugins\icons\font-awesome\css\font-awesome.css">
    <link rel="stylesheet" href="plugins\icons\fontawesome\css\all.css">

    <!-- Flaticon kit free -->
    <link rel="stylesheet" href="plugins\icons\uicons-regular-rounded\css\uicons-regular-rounded.css">
    <link rel="stylesheet" href="plugins\icons\uicons-solid-rounded\css\uicons-solid-rounded.css">

    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="plugins/bootstrap-table/dist/bootstrap-table.min.css">

    <!--- css tambahan -->
    <link rel="stylesheet" href="style.css">

    <!-- Latest compiled and minified JavaScript -->
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- JQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- DOM to IMAGE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>

    <!-- Font Montserrat & Noto Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />


    <style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Poppins', sans-serif;
    }

    div,
    p,
    span,
    a {
        font-family: 'Lato', sans-serif;
    }

    .gambarlogo {
        width: 80px;
        height: auto;
        transition-property: width;
        transition-duration: 0.3s;
        transition-timing-function: linear;
        transition-delay: 0;
    }

    .gambarlogokecil {
        width: 35px;
        height: auto;
        transition-property: width;
        transition-duration: 0.3s;
        transition-timing-function: linear;
        transition-delay: 0;
    }

    .fotouser {
        height: 20px;
        width: 20px;
        background-size: cover;
    }

    @media screen and (max-width: 720px) {
        .gambarlogokecil {
            width: 80px;
            height: auto;
        }

        .sidebarcopy {
            /* margin-top: 200px; */
            position: fixed;
            bottom: 20px;
        }
    }

    .mmi {
        font-size: 30px;
    }

    .scan-button {
        height: 50px;
        width: 50px;
        font-size: 20px;
        text-align: center;
        vertical-align: middle !important;
        margin-top: 5px;
        margin-bottom: 0px;
        padding: 10px;
        border-radius: 50%;
        background-color: #005eff;

    }

    .scan-button:hover {
        background-color: #fff;
        color: #005eff;
        border-color: #005eff;
        border-style: solid;
    }

    .sidebarcopy {
        display: none;
    }
    </style>
    <script>
    $(document).ready(function() {
        $(".preloader").fadeOut('slow');
    })
    </script>
    <style>
    body {
        min-height: 530px;
        padding-bottom: 50px;
    }

    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
    }

    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    @media screen and (max-width:530px) {
        .main-header {
            display: none;
        }

        body {
            padding-bottom: 200px;
        }

    }
    </style>




</head>

<body class="hold-transition sidebar-mini layout-fixed ">
    <div class=" wrapper bg-white">

        <!-- Preloader -->
        <!-- <div class="preloader ">
            <img class="" src="dist/img/load.gif" alt="<?=$sekolah?>" height="100" width="auto">
        </div> -->
        <div class="preloader justify-item-center text-center">
            <div class="loading">
                <img class="" src="dist/img/loading4.gif" width="80%">
            </div>
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-primary align-middle sticky-top ">
            <!-- Left navbar links -->


            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" onclick="LogoKecil()" id="togle">
                        <i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <div class="ml-auto dropdown align-middle">
                <!-- <div class=" fotouser" style="background-image:url('dist/img/foto-user/<?php echo $fotouser;?>">
                </div> -->
                <a href="#" class="bg-primary pl-4 pr-4 pt-2 pb-2  " id="dropdownUser2" data-toggle="dropdown"
                    aria-expanded="false">
                    <!-- <i class="fa-solid fa-user p-1"></i> -->
                    <i class="fa-solid fa-user mr-2"></i>

                    <strong><?php echo $namauser;?></strong>
                    <span class="badge badge-warning ml-2">
                        <?php echo $roleuser;?>
                    </span>

                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li>

                    </li>
                    <li><a class="dropdown-item" href="page.profile.php">Profil</a></li>
                    <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                </ul>
            </div>

        </nav>
        <!-- /.navbar -->