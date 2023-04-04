<?php
$title = 'Data PTK';

require 'sidebar.admin.php';

if($aksesptk !== 'Ya'){
    ?>
<script>
location.replace("dashboard.php");
</script>
<?php
    }


include "plugins/phpqrcode/qrlib.php"; 

$user = 'SELECT * FROM user ORDER BY nama';
$d_user = mysqli_query($koneksi, $user);



?>


<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 ">
                <div class="">
                    <div class="card-header">
                        <!-- <h3 class=" ">Data Pendidik dan Tenaga Kependidikan</h3> -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary"
                                style="width:auto; font-size:14px;font-weight:bold;" data-toggle="modal"
                                data-target="#tambahptk">
                                <i class="fa fa-user-plus mr-2"></i> Tambah PTK
                            </button>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-reponsive" style="">
                        <table id="tabelptk" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5px">No</th>
                                    <th>Nama PTK</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Jabatan</th>
                                    <th style="width: 200px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no     = 1;
                                    while ($ptk = mysqli_fetch_assoc($d_user))
                                    { $id=$ptk['id'];?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $no?></td>
                                    <td class="align-middle"><b><?php echo $ptk['nama']?></b>
                                        <br><small><?php echo $ptk['email']?></small>
                                    </td>
                                    <td class="align-middle">
                                        <?php 
                                        $d_mapel = "SELECT * FROM mapel WHERE id_guru=$id";
                                        $dtmapel = mysqli_query($koneksi, $d_mapel);
                                        while ($pmapel = mysqli_fetch_array($dtmapel)){
                                            $lmapel = $pmapel['mapel'];
                                            $datamapel = explode(", ",$lmapel);
                                            for ( $i = 0; $i < count( $datamapel ); $i++ ) {
                                                echo $datamapel[$i] . "<br />";
                                                }
                                        }
                                        
                                        ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php echo $ptk['jabatan']?>
                                    </td>

                                    <td class="text-center align-middle">
                                        <span type="button" class="badge badge-primary p-2" data-toggle="modal"
                                            data-target="#editptk-<?php echo $id?>">
                                            <i class="fa fa-user-pen"></i> Edit
                                        </span>
                                        <!-- Form edit data PTK -->
                                        <div class="modal fade text-left" id="editptk-<?php echo $id?>"
                                            role="modal-dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data
                                                                <b><?php echo $ptk['nama']?></b>
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" name="idptk" id=""
                                                                value="<?php echo $id?>" hidden>
                                                            <label>Nama</label>
                                                            <input type="text" name="namab" class="form-control mb-2"
                                                                placeholder="Masukkan nama PTK"
                                                                value="<?php echo $ptk['nama'];?>">
                                                            <label>NIP/NUPTK</label>
                                                            <input type="text" name="nipb" class="form-control mb-2"
                                                                value="<?php echo $ptk['nip'];?>"
                                                                placeholder="Tambahkan NIP/NUPTK">
                                                            <label>Jabatan Tendik</label>
                                                            <select class="form-control select2bs4 mb-2 "
                                                                data-placeholder="Pilih Jabatan Tendik"
                                                                name="jabatanb[]" multiple="multiple"
                                                                value="<?php echo $ptk['jabatan'];?>"
                                                                style="width: 100%;">
                                                                <option value="-">-</option>
                                                                <?php
                                                                $juser = explode(" / ",$ptk['jabatan']);
                                                                $jmlju = count($juser);
                                                                 for ($i=0; $i < $jmlju ; $i++){
                                                                ?>

                                                                <option value="<?php echo $juser[$i]; ?>"
                                                                    selected="selected">
                                                                    <?php echo $juser[$i]; }?></option>
                                                                <?php 
                                                                    $sql_jab = 'SELECT * FROM jabatan ';
                                                                    $query_jab = mysqli_query($koneksi, $sql_jab);
                                                                    while ($row_jab = mysqli_fetch_array($query_jab)){
                                                                    ?>
                                                                <option value="<?php echo $row_jab['tipe_jabatan']?>">
                                                                    <?php echo $row_jab['tipe_jabatan']?></option>
                                                                <?php }?>

                                                            </select>
                                                            <label>Email</label>
                                                            <input type="email" name="emailb" class="form-control  mb-2"
                                                                placeholder="<?php echo $ptk['email'];?>"
                                                                value="<?php echo $ptk['email'];?>" required>
                                                            <label>Username</label>
                                                            <input type="text" name="unameb" class="form-control  mb-2"
                                                                placeholder="<?php echo $ptk['uname'];?>"
                                                                value="<?php echo $ptk['uname'];?>" required>
                                                            <label>Password</label>

                                                            <input class="form-control mt-0" type="text"
                                                                placeholder="Kata Sandi" name="pwdb" id="pwd">


                                                            <input type="text" name="pwdlama" class="form-control  mb-2"
                                                                value="<?php echo $ptk['pwd'];?>"
                                                                placeholder="Masukkan Password Baru" required hidden>
                                                            <label>Foto</label>
                                                            <input type="text" name="fotolama" id=""
                                                                value="<?php echo $ptk['foto'];?>" hidden>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="UpFoto<?php echo $id?>" name="fotob">
                                                                <label class="custom-file-label"
                                                                    for="UpFoto<?php echo $id?>"><?php 
                                                                if(!empty($ptk['foto'])){
                                                                    echo $ptk['foto'];
                                                                }else{
                                                                    echo "Pilih Foto";
                                                                }
                                                                ?>
                                                                </label>

                                                            </div>
                                                            <script type="application/javascript">
                                                            $('#UpFoto<?php echo $id?>').on('change', function() {
                                                                // Ambil nama file 
                                                                let fileName = $(this).val().split('\\').pop();
                                                                // Ubah "Choose a file" label sesuai dengan nama file yag akan diupload
                                                                $(this).next('.custom-file-label').addClass(
                                                                    "selected").html(fileName);
                                                            });
                                                            </script>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit" value="simpan" name="simpanedit"
                                                                class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>

                                                </div>
                                                <!-- /.modal-content -->

                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <span type="button" class="badge badge-danger p-2" data-toggle="modal"
                                            data-target="#hapusptk-<?php echo $id?>">
                                            <i class="fa fa-trash"></i> Hapus
                                        </span>
                                        <div class="modal fade" tabindex="-1" id="hapusptk-<?php echo $id?>">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content p-3">
                                                    <div class="modal-body">
                                                        <p><b><?php echo $ptk['nama'] ?></b> akan dihapus dari database?
                                                        </p>
                                                    </div>
                                                    <div class="text-center mb-2">
                                                        <button type="button" class="mr-2 btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <a href="?hapususer=<?php echo $ptk['id']?>" type="button"
                                                            class="ml-2 btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                </tr><?php ;$no++;}?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="tambahptk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah PTK Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" method="post" action="" enctype="multipart/form-data">
                    <label>Nama PTK</label>
                    <input type="text" name="nama" class="form-control mb-2" placeholder="Masukkan nama PTK" value=""
                        required>
                    <label>NIP/NUPTK</label>
                    <input type="text" name="nip" class="form-control mb-2" value="" placeholder="Tambahkan NIP/NUPTK">
                    <label>Jabatan Tendik</label>

                    <select class="form-control select2bs4 mb-2 " data-placeholder="Pilih Jabatan Tendik"
                        name="jabatan[]" style="width: 100%;" multiple="multiple">
                        <option>
                            <?php 
                            $sql_jab = 'SELECT * FROM jabatan ';
                            $query_jab = mysqli_query($koneksi, $sql_jab);
                            while ($row_jab = mysqli_fetch_array($query_jab))
                                    {echo '<option value="'.$row_jab['tipe_jabatan'].'"> '.$row_jab['tipe_jabatan'].'</option>'; }?>
                        </option>
                    </select>

                    <hr>

                    <label>Email</label>
                    <input type="email" name="email" class="form-control  mb-2" value="" placeholder="Masukkan Email"
                        required>
                    <label>Username</label>
                    <input type="text" name="uname" class="form-control  mb-2" value="" placeholder="Masukkan Username"
                        required>
                    <label>Password</label>
                    <input type="text" name="pwd" class="form-control  mb-2" value="" placeholder="Masukkan Password"
                        required>

                    <label>Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="UpFoto" name="foto">
                        <label class="custom-file-label" for="UpFoto">Pilih Foto
                        </label>
                        <br>
                    </div>
                    <!-- <div class="text-center m-3 p-2">
                        <img src="dist/img/blank.jpg" alt="" height="150px" width="auto">
                    </div> -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i
                                class="fa fa-save mr-2"></i>Simpan</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?php

require 'footer.admin.php';
require 'script.php';

// [ Fungsi Simpan Data PTK ]

if (isset($_POST['simpan'])){

    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $pwd = md5($_POST['pwd']);
    // $pwdnotmd5 = $_POST['pwd'];
    $nama = $_POST['nama'];
    // $nip = $_POST['nip'];
    if(!empty($_POST['nip'])){
        $nip = $_POST['nip'];
    }else{
        $nip = '-';
    }
    if(!empty($_POST['jabatan'])){
        $jabatan = implode(" / ",$_POST['jabatan']);
    }else{
        $jabatan = '-';
    }

    
    // if (!empty($_POST['mapel'])){
    //   $mapel = implode(", ",$_POST['mapel']);
    //   $guru = 'Guru Mapel';
    // }else {
    //   $mapel ='';
    //   $guru = '';
    // }
    if(!empty($_FILES['foto']['name'])){
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];
        $tipe_foto = $_FILES['foto']['type'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        
        
    
        $foto = $nama_foto;
    
        $x = explode(".", $foto);
        $nama_fbaru = round(microtime(true)) .' - '.$nama.'.' . end($x);
    
        $foto_path = "dist/img/foto-user/".$nama_fbaru;
        $simpanfoto = move_uploaded_file($tmp_foto, $foto_path);

        if($tipe_foto=="image/jpeg" || $tipe_foto=="image/jpg" || $tipe_foto=="image/gif" || $tipe_foto=="image/png"){
            
                // [ Untuk menyimpan foto ]
                move_uploaded_file($tmp_foto, $foto_path);
                

                // [ Untuk membuat dan menyimpan QR Code ]
                
                $qr_dir="dist/img/qrcode/";
                if (!file_exists($qr_dir))
                mkdir($qr_dir, 0755);
                $qrval = rand();
                $qr_file=$qrval.".png";   
                $qr_path = $qr_dir.$qr_file;
                QRcode::png($qrval, $qr_path , "H", 6, 4);

                // [ Menyimpan ke database ]
                $tambahuser = "INSERT INTO user (jabatan, email, uname, pwd, nama, nip, mapel, foto, qrcode)
                VALUES ('$jabatan', '$email','$uname','$pwd','$nama','$nip','$nama_fbaru','$qrval')";



                    if ($koneksi->query($tambahuser) === TRUE) {
                        
                            echo "<script> $('#berhasil').modal('show');
                            const timeout = setTimeout(reload, 1000);

                            function reload() {
                                location.replace('page.data.ptk.php');
                            }</script>";
                        }else{
                            echo "<script> $('#gagal').modal('show');</script>";
                        }

            }else{
                echo "<script>window.alert('Tipe gambar haru .jpg / .jpeg / .png / .gif ')</script>";
            }
            
         }else{
             // [ Untuk membuat dan menyimpan QR Code ]
            
            $qr_dir="dist/img/qrcode/";
            if (!file_exists($qr_dir))
            mkdir($qr_dir, 0755);
            $qrval = rand();
            $qr_file=$qrval.'.png';   
            $qr_path = $qr_dir.$qr_file;
            QRcode::png($qrval, $qr_path , "H", 6, 4);

            $tambahuser = "INSERT INTO user (jabatan, email, uname, pwd, nama, nip, mapel, qrcode)
            VALUES ('$jabatan', '$email','$uname','$pwd','$nama','$nip', '$mapel','$qrval')";

            if ($koneksi->query($tambahuser) === TRUE) {
                echo "<script> $('#berhasil').modal('show');
                const timeout = setTimeout(reload, 1000);

                function reload() {
                    location.replace('page.data.ptk.php');
                }</script>";
            }else{
                echo "<script> $('#gagal').modal('show');</script>";
            }
         }
}
 
// [ Fungsi Hapus Data ]

if(isset($_GET['hapususer'])){
    $id = $_GET['hapususer'];

    $datauser = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
    $user = mysqli_fetch_array($datauser);
    $foto = $user['foto'];
    $qrcode = $user['qrcode'];
    if(!empty($foto)){
        $hapusfoto = unlink("dist/img/foto-user/$foto");
    }
    $hapusqr = unlink("dist/img/qrcode/$qrcode.png");

    if($hapusfoto == TRUE OR $hapusqr == TRUE){
    // menghapus data dari database
    $hapusptk = mysqli_query($koneksi,"DELETE FROM user WHERE id='$id'");
    if($hapusptk == TRUE ){
        $gantiguru = mysqli_query($koneksi,"UPDATE mapel  SET id_guru='' WHERE id_guru='$id'");
        echo "<script> $('#berhasil').modal('show');
        const timeout = setTimeout(reload, 1000);
    
        function reload() {
            location.replace('page.data.ptk.php');
        }</script>";
         }
    }
}


// [ Fungsi Edit Data ]

if (isset($_POST['simpanedit'])){
    $idptk = $_POST['idptk'];
    $nama = $_POST['namab'];
    $nip = $_POST['nipb'];
    $email = $_POST['emailb'];
    $uname = $_POST['unameb'];
    $fotolama = $_POST['fotolama'];
    $jabbaru = implode(" / ",$_POST['jabatanb']);

if(!empty($_POST['pwdb'])){
    $pwd = md5($_POST['pwdb']);
}else{
    $pwd = $_POST['pwdlama'];
}
// $foto =  $_POST['foto'];

    if(!empty($_FILES['fotob']['name'])){
            $nama_foto = $_FILES['fotob']['name'];
            $ukuran_foto = $_FILES['fotob']['size'];
            $tipe_foto = $_FILES['fotob']['type'];
            $tmp_foto = $_FILES['fotob']['tmp_name'];
            // echo $nama_foto.$foto2;

            $foto = $nama_foto;

            $x = explode(".", $foto);
            $nama_fbaru = round(microtime(true)) .'-'.$nama.'.' . end($x);

            $foto_path = "dist/img/foto-user/".$nama_fbaru;
            // $simpanfoto = move_uploaded_file($tmp_foto, $foto_path);

            if($tipe_foto=="image/jpeg" || $tipe_foto=="image/jpg" || $tipe_foto=="image/gif" || $tipe_foto=="image/png"){
            
                // [ Untuk menyimpan foto ]
                $uploadfoto = move_uploaded_file($tmp_foto, $foto_path);
                if($uploadfoto == TRUE){
                    if(!empty($fotolama)){
                        unlink("dist/img/foto-user/$fotolama");
                    
                    }
                    // [ Menyimpan ke database ]
                    $updatedata = mysqli_query($koneksi,"UPDATE user SET nama='$nama', nip='$nip', jabatan='$jabbaru', email='$email', uname='$uname', pwd='$pwd', foto='$nama_fbaru' WHERE id='$idptk'");

                    if ($updatedata == TRUE) {
                            echo "<script> $('#berhasil').modal('show');
                            const timeout = setTimeout(reload, 1000);

                            function reload() {
                                location.replace('page.data.ptk.php');
                            }</script>";
                        }else{
                            echo "<script> $('#gagal').modal('show');</script>";
                        }
                }
            }else{
                echo "<script>window.alert('Tipe gambar harus .jpg / .jpeg / .png / .gif ')</script>";
                
            }
    }elseif(empty($_FILES['fotob']['name'])){      
    // [ Menyimpan ke database ]
    $updatedata = mysqli_query($koneksi,"UPDATE user  SET nama='$nama', nip='$nip', jabatan='$jabbaru', email='$email', uname='$uname', pwd='$pwd' WHERE id='$idptk'");

    if ($updatedata == TRUE) {
        echo "<script> $('#berhasil').modal('show');
        const timeout = setTimeout(reload, 1000);

        function reload() {
            location.replace('page.data.ptk.php');
        }</script>";
        } else {
            echo "<script> $('#gagal').modal('show');</script>";
        }
    }

}




?>
<script>
$("#edit").on("click", ".openmodal", function() {
    var did = $(this).data("id");
    $(".modal-body #id").val(did);
    $('#editptk').modal('show')
})
$("#btn").on("click", function() {
    alert('Tombolnya di klik');
})
</script>

<script>
$(function() {
    $("#tabelptk").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["csv", "excel", "colvis"]
    }).buttons().container().appendTo('#tabelptk_wrapper .col-md-6:eq(0)');
});
</script>
<script type="application/javascript">
$('#UpFoto').on('change', function() {
    // Ambil nama file 
    let fileName = $(this).val().split('\\').pop();
    // Ubah "Choose a file" label sesuai dengan nama file yag akan diupload
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>

</html>