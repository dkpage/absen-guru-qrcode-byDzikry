<?php
require 'admin/config/config.default.php';


(isset($_GET['pesan'])) ? $pesan = $_GET['pesan'] : $pesan = '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Absensi Guru SMP Plus Albidayah">
    <meta name="author" content="">

    <meta name="docsearch:language" content="en">
    <meta name="docsearch:version" content="4.5">

    <title><?= $title ?> | <?= $n_aplikasi?> <?= $sekolah?></title>

    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="dist/color.css"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="admin/dist/img/<?= $logo ?>">
    <!-- Bootstrap core CSS -->
    <style class="anchorjs"></style>
    <link href="admin/plugins/bootstrap-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Favicons -->

    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Select2 -->
    <link rel="stylesheet" href="admin/plugins/select2/css/select2.css">
    <link rel="stylesheet" href="admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Fontawesome 6.1.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- JQuery -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>
    <!-- JsQR Plugin  -->
    <script src="jsqr/jsQR.js"></script>
    <!-- JQuery -->
    <script src="admin/plugins/jquery/jquery.min.js"></script>

    <style>
    .ikonresult {
        font-size: 30pt;
        margin-bottom: 20px;
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
        font-family: 'Lato', sans-serif;
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
<div class="preloader justify-item-center text-center">
    <div class="loading">
        <img class="" src="admin/dist/img/loading4.gif" width="80%">
    </div>
</div>