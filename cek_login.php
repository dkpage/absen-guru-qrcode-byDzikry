<?php


require 'admin/config/config.default.php';



session_start(); 
 

if(isset($_POST['uname'])){
	// menangkap data yang dikirim dari form
	$uname = $_POST['uname'];
	$pwd = md5($_POST['pwd']);
	
	// menyeleksi data user dengan username dan password yang sesuai
	$datauser = mysqli_query($koneksi,"SELECT * FROM user where  pwd='$pwd' and uname='$uname' or email='$uname' ");

	$cekuser = mysqli_num_rows($datauser);
	
	if($cekuser > 0) {
		$data = mysqli_fetch_assoc($datauser);
		//menyimpan session user, nama, status dan id login
		$_SESSION['uname'] = $uname;
		$_SESSION['nama'] = $data['nama'];
		
		$_SESSION['status'] = "sudah_login";
		$_SESSION['id_login'] = $data['id'];


		header('location:admin/');
	} else {
		header("location:login.php?pesan=gagalmasuk");
	}
}elseif(isset($_GET['qr'])){
	$qr = $_GET['qr'];

	$datauser = mysqli_query($koneksi,"SELECT * FROM user where qrcode='$qr'");

	$cekuser = mysqli_num_rows($datauser);
	
	if($cekuser > 0) {
		$data = mysqli_fetch_assoc($datauser);
		//menyimpan session user, nama, status dan id login
		// $_SESSION['uname'] = $uname;
		// $_SESSION['nama'] = $data['nama'];
		
		$_SESSION['status'] = "sudah_login";
		$_SESSION['id_login'] = $data['id'];


		header('location:admin/');

	}else{
		header("location:login.php?pesan=gagalmasuk");

	}
}

?>