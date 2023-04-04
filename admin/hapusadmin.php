<?php
$title = 'Hapus Admin';
require 'config/config.database.php';


    $id = $_GET['id'];
    $sql_hapus = "UPDATE user SET role='' WHERE id='$id'";
    $data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
    $user = mysqli_fetch_array($data_user);
    $nama = $user['nama'];
    
    
    if ($koneksi->query($sql_hapus) === TRUE) {
        echo '<script>window.alert("Berhasil melepas akses admin untuk '.$nama.'");
      location.replace("page.data.admin.php");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    




?>