<?php
$title = 'Sign In';
include 'header.php';

if(!empty($id_user)){
	header('location: admin/');
}else{
	


?>
<style>
body {
    min-height: 500px;
}

.lbl {
    font-weight: 400;
}

input[type=text],
input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 10pt;
}

.tb {

    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.tb:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 5px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }

    .cancelbtn {
        width: 100%;
    }
}

.form-group label {
    font-size: 10pt;
    font-weight: 300;
    margin: 5px;
}

span p {
    font-weight: 300;
}

.notif {
    padding: 10px;
}

.notif h5 {
    font-size: 10pt;
}

.notif p {
    font-size: 8pt;
    font-weight: 300;
}
</style>

<body class=" bg-white " style="min-height: 496.781px;">
    <div class="login-page container p-2 login-box bg-white fixed-top">

        <div class="">

            <form action="" method="post" class="p-2">
                <div class="mb-3 text-center">
                    <img src="admin/dist/img/<?=$logo?>" alt="" height="80px" width="auto" class="mb-4">
                    <h1 class="judul3">
                        <span class="badge badge-primary">Silahkan Masuk</span>
                        <br>
                        <small><?=$n_aplikasi?></small>
                        <br>
                        <small><?=$sekolah?></small>
                    </h1>
                </div>
                <div class="form-group fl">
                    <a href="index" class="float-right"><i class="fa fa-chevron-left"></i> Kembali</a><br>
                    <label class="lbl" for="uname">Username</label>
                    <input class="form-control mt-0" type="text" placeholder="Username/Email" name="uname" required>

                    <label class="lbl" for="pwd">Password</label>
                    <div class="input-group">
                        <input class="form-control mt-0" type="password" placeholder="Kata Sandi" name="pwd" id="pwd"
                            required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-eye" id="lihat"></i><i
                                    class="fa-solid fa-eye-slash" id="tutup" hidden></i></span>
                        </div>
                    </div>

                    <div class="mt-4 gap-2 d-grid">

                        <button type="submit" class="btn btn-primary" name="masuk">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i>
                            Masuk</button>

                        <a href="loginqr" class="btn btn-secondary">
                            <i class="fa-solid fa-qrcode mr-2"></i>Login QR</a>
                    </div>
                </div>

                <?php  if ($pesan == 'gagalmasuk'){
                            echo '
                        <div class="notif bg-danger mt-2">
                            <h5><i class="icon fas fa-ban"></i> Akses ditolak!</h5>
                            <p>Username atau Password tidak sesuai!</p>

                        </div>
                            ';
                        }?>
        </div>

        <span>
            <p class="text-disabled text-center copyright">© <?php echo $thnid.' - '.$sekolah?></p>
        </span>
        </form>

    </div>
    <div class="modal fade " id="berhasil-login">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-success rounded-0">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4 d-flex justify-content-center" style="font-size:30pt;">
                            <span class="align-middle">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                        </div>
                        <div class="col-md-8 d-flex justify-content-center align-middle " style="font-size:10pt;">
                            Berhasil Masuk. anda akan di arahkan ke panel User dalam 1 detik
                        </div>
                    </div>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="gagal-login" style="background:none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-danger rounded-0">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4 d-flex justify-content-center align-middle" style="font-size:30pt;">
                            <span class="align-middle">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </span>
                        </div>
                        <div class="col-md-8 d-flex justify-content-center align-middle " style="font-size:10pt;">
                            Username atau Password tidak sesuai silahkan coba kembali atau hubungi administrator
                        </div>
                    </div>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    var btnLihat = document.getElementById('lihat');
    var btnTutup = document.getElementById('tutup');
    var fpwd = document.getElementById('pwd');

    btnLihat.onclick = function() {
        fpwd.setAttribute('type', 'text');
        btnLihat.hidden = true;
        btnTutup.hidden = false;
    }
    btnTutup.onclick = function() {
        fpwd.setAttribute('type', 'password');
        btnLihat.hidden = false;
        btnTutup.hidden = true;
    }
    </script>


</body>
<?php }
include 'footer.php';



if(isset($_POST['masuk'])){

    // session_start(); 
 
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


	?>
<script>
$("#berhasil-login").modal("show");
const timeout = setTimeout(masuk, 1000);

function masuk() {
    location.replace('admin/');
}
</script>
<?php
	} else {
	?>
<script>
$("#gagal-login").modal("show");
const timeout = setTimeout(tutup, 2000);

function tutup() {
    $("#gagal-login").modal("hide");
}
</script>
<?php
	}
}elseif(isset($_GET['qr'])){
	$qr = $_GET['qr'];

	$datauser = mysqli_query($koneksi,"SELECT * FROM user where qrcode='$qr'");

	$cekuser = mysqli_num_rows($datauser);
	
	if($cekuser > 0) {
		$data = mysqli_fetch_assoc($datauser);
		//menyimpan session user, nama, status dan id login
		$_SESSION['uname'] = $uname;
		$_SESSION['nama'] = $data['nama'];
		
		$_SESSION['status'] = "sudah_login";
		$_SESSION['id_login'] = $data['id'];


		header('location:admin/');

	}else{
		header("location:login.php?pesan=gagalmasuk");

	}
}



?>