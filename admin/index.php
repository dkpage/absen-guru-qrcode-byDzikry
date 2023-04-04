<?php
require ('config/config.default.php');


//memulai session yang disimpan pada browser
session_start();

//cek apakah sesuai status sudah login? kalau belum akan kembali ke form login
if($_SESSION['status']!="sudah_login"){
//melakukan pengalihan

header("location:../login");
} else {
    header("location: dashboard.php");
}



?>