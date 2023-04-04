<?php
$title = 'Profil';

require 'sidebar.admin.php';
$datamapel = mysqli_query($koneksi, "SELECT mapel FROM mapel WHERE id_guru='$iduser'");
// $arrmapel = mysqli_fetch_array($datamapel);


//if($aksesprofil !== 'Ya'){
    ?>
<script>
//location.replace("../index");
</script>
<?php
//    }


?>
<style>
.foto-user {
    height: 200px;
    width: 150px;
    background-position: top;
    background-size: cover;
}

h3 {
    font-weight: 700;
}

p {
    margin-bottom: 5px;
}
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">

                <!-- Profile Image -->
                <div class="card">
                    <div class="card-body box-profile text-center d-grid gap-0">
                        <div class="d-flex justify-content-center">
                            <div class=" foto-user rounded"
                                style="background-image: url('dist/img/foto-user/<?=$fotouser?>')">
                            </div>
                        </div>

                        <hr>
                        <h3 class="profile-username text-center mt-3"><?=$namauser?></h3>
                        <p class="text-muted text-center"><?=$nipuser?></p>
                        <p class="text-muted text-center">
                            <?php
                            if(!empty($datamapel)){
                                while($arrmapel = mysqli_fetch_array($datamapel)){
                                    echo $arrmapel['mapel'].'<br>';
                                }
                            }
                            ?>
                        </p>

                        <br>
                        <div class="row">
                            <div class="col-4 d-grid ">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#ubahdata"><i class="fa-solid fa-user-pen"></i></button>
                            </div>
                            <div class="col-4 d-grid ">
                                <button class="btn btn-primary" type="button" class="btn btn-primary"
                                    data-toggle="modal" data-target="#lihatidcard"><i
                                        class="fa-solid fa-id-card-clip"></i></button>
                            </div>
                            <div class="col-4 d-grid ">
                                <button class="btn btn-primary" type="button" class="btn btn-primary"
                                    data-toggle="modal" data-target="#lihatqr"><i
                                        class="fa-solid fa-qrcode"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->

            <div class="col-md-8 ">

                <div class="col-12">
                    <div class="container" id="tabelRekapan">
                        <div class="card-header ">

                            <h3 class="card-title" id="title">Rincian Kehadiran
                                <?php
                                    if(isset($_GET['lihat'])){
                                        if(!empty($_GET['tanggal'])){
                                            echo ':: Tanggal '.$_GET['tanggal'].' ';
                                        }else{
                                            echo '';
                                        }
                                        if(!empty($_GET['bulan'])){
                                            echo ':: Bulan '.$_GET['bulan'].' ';
                                        }else{
                                            echo '';
                                        }
                                        if(!empty($_GET['tahun'])){
                                            echo ':: Tahun '.$_GET['tahun'].'';
                                        }else{
                                            echo '';
                                        }
                                    }
                                    ?>

                            </h3>


                            <span type="button" class="badge badge-primary ml-2" type="button" class="btn btn-primary"
                                data-toggle="modal" data-target="#filterdata"><i
                                    class="fa-solid fa-filter mr-2"></i>Filter Data</span>


                        </div>

                        <!-- /.card-header -->
                        <div class=" table-responsive p-2" style="">
                            <table id="tabelrekap" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Tanggal & Waktu</th>
                                        <th>Nama PTK</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Jam ke</th>
                                        <th>Durasi</th>
                                        <th>Lokasi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                        if(isset($_GET['lihat'])){
                            $tahun = $_GET['tahun'];
                            $bulan = $_GET['bulan'];
                            if(empty($_GET['tanggal'])){
                                $tanggal = '';
                                $pilihan2 = '';
                            }else{
                                $tanggal = $_GET['tanggal'];
                                $pilihan2 = "AND tgl='$tanggal'";
                            }
                            ?>

                                        <?php
                            $rekap = "SELECT * FROM rekap WHERE nama='$namauser' and thn=$tahun and bln=$bulan $pilihan2" ;
                            $d_rekap = mysqli_query($koneksi, $rekap);
                            $no     = 1;
                            while ($r_rekap = mysqli_fetch_array($d_rekap))
                            {?>
                                        <td class="text-center"><?php echo $no;?></td>
                                        <td><?php echo $r_rekap['timestamp'];?></td>
                                        <td><?php echo $r_rekap['nama'];?></td>
                                        <td><?php echo $r_rekap['mapel'];?></td>
                                        <td><?php echo $r_rekap['kelas'];?></td>
                                        <td><?php echo $r_rekap['jam_ke'];?></td>
                                        <td><?php echo $r_rekap['durasi'];?> JP</td>
                                        <td class="notPrint"><?php echo $r_rekap['lokasi'];?></td>
                                    </tr><?php ;$no++;}}else{?>
                                    <?php $rekap = "SELECT * FROM rekap WHERE nama='$namauser'";
                            $d_rekap = mysqli_query($koneksi, $rekap);
                            $no     = 1;
                            while ($r_rekap = mysqli_fetch_array($d_rekap))
                            {?>
                                    <td class="text-center"><?php echo $no;?></td>
                                    <td><?php echo $r_rekap['timestamp'];?></td>
                                    <td><?php echo $r_rekap['nama'];?></td>
                                    <td><?php echo $r_rekap['mapel'];?></td>
                                    <td><?php echo $r_rekap['kelas'];?></td>
                                    <td><?php echo $r_rekap['jam_ke'];?></td>
                                    <td><?php echo $r_rekap['durasi'];?> JP</td>
                                    <td class="notPrint"><?php echo $r_rekap['lokasi'];?></td>
                                    </tr><?php ;$no++;}}?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>

<div class="modal fade" id="filterdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="get" enctype="mulipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Filter Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class=" m-1">

                        <select name="tahun" class="form-control" required="required" id="thn">
                            <option selected="selected" value="">Tahun</option>
                            <?php
                        $now=date('Y');
                        echo '';
                        for ($a=2012;$a<=$now;$a++)
                        {
                            echo "<option value='$a'>$a</option>";
                        }
                        echo "";
                        
                        ?>
                        </select>
                    </div>
                    <div class="m-1">
                        <select class="form-control" name="bulan" required="required">
                            <option selected="selected" value="" id="bln">Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>

                        </select>
                    </div>

                    <!-- #### PILIHAN TANGGAL ### -->
                    <!-- <div class=" m-1">
                        <select class="form-control" name="tanggal">
                            <option selected="selected" vale="" id="tgl">Tanggal</option>
                            <?php
                            // for($a=1; $a<=31; $a+=1){
                                // echo"<option value='$a'> $a </option>";
                            // }
                            ?>
                        </select>
                    </div> -->

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" name="lihat">Lihat</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="ubahdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label>Nama <small><i>(Hanya dapat diubah oleh admin)</i></small></label>
                    <input type="text" name="nama" class="form-control mb-2" placeholder="Masukkan nama PTK"
                        value="<?php echo $namauser;?>" disabled>
                    <label>NIP/NUPTK <small><i>(Hanya dapat diubah oleh admin)</i> </small></label>
                    <input type="text" name="nip" class="form-control mb-2" value="<?php echo $nipuser;?>"
                        placeholder="Tambahkan NIP/NUPTK" disabled>
                    <label>Email</label>
                    <input type="email" name="email" class="form-control  mb-2" placeholder="<?php echo $emailuser;?>"
                        value="<?php echo $emailuser;?>" required>
                    <label>Username</label>
                    <input type="text" name="uname" class="form-control  mb-2" placeholder="<?php echo $unameuser;?>"
                        value="<?php echo $unameuser;?>" required>
                    <label>Password</label>
                    <div class="input-group">
                        <input class="form-control mt-0" type="password" placeholder="Kata Sandi" name="pwdbaru"
                            id="pwd">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-eye" id="lihat"></i><i
                                    class="fa-solid fa-eye-slash" id="tutup" hidden></i></span>
                        </div>
                    </div>
                    <input type="text" name="pwd" class="form-control  mb-2" value="<?php echo $pwduser;?>"
                        placeholder="Masukkan Password Baru" required hidden>
                    <label>Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="UpFoto" name="foto">
                        <label class="custom-file-label" for="UpFoto">Pilih Foto
                        </label>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" value="simpan" name="simpandata" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
if (isset($_POST['simpandata'])){

$email = $_POST['email'];
$uname = $_POST['uname'];

if(!empty($_POST['pwdbaru'])){
    $pwd = md5($_POST['pwdbaru']);
    $logout = 'Setelah keluar, anda harus memasukkan kata sandi baru.';
}else{
    $pwd = $_POST['pwd'];
    $logout = '';
}
// $foto =  $_POST['foto'];

    if(!empty($_FILES['foto']['name'])){
            $nama_foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            $tipe_foto = $_FILES['foto']['type'];
            $tmp_foto = $_FILES['foto']['tmp_name'];
            // echo $nama_foto.$foto2;

            $foto = $nama_foto;

            $x = explode(".", $foto);
            $nama_fbaru = round(microtime(true)) .' - '.$namauser.'.' . end($x);

            $foto_path = "dist/img/foto-user/".$nama_fbaru;
            // $simpanfoto = move_uploaded_file($tmp_foto, $foto_path);

            if($tipe_foto=="image/jpeg" || $tipe_foto=="image/jpg" || $tipe_foto=="image/gif" || $tipe_foto=="image/png"){
            
                // [ Untuk menyimpan foto ]
                $uploadfoto = move_uploaded_file($tmp_foto, $foto_path);
                if($uploadfoto == TRUE){
                    if($fotouser !== 'blank.jpg'){
                        unlink("dist/img/foto-user/$fotouser");
                    
                    }
                    // [ Menyimpan ke database ]
                    $updatedata = mysqli_query($koneksi,"UPDATE user SET email='$email', uname='$uname', pwd='$pwd', foto='$nama_fbaru' WHERE id='$iduser'");

                    if ($updatedata == TRUE) {
                        echo '<script>window.alert("Data anda berhasil diubah. '.$logout.'");location.replace("page.profile.php");</script>';
                        } else {
                            echo "<script>window.alert('Pengubahan data gagal. Cek kesalahan.')</script>";
                            
                        }
                }
            }else{
                echo "<script>window.alert('Tipe gambar haru .jpg / .jpeg / .png / .gif ')</script>";
                
            }
    }elseif(empty($_FILES['foto']['name'])){      
    // [ Menyimpan ke database ]
    $updatedata = mysqli_query($koneksi,"UPDATE user  SET email='$email', uname='$uname', pwd='$pwd' WHERE id='$iduser'");

    if ($updatedata == TRUE) {
        echo '<script>window.alert("Data anda berhasil diubah. '.$logout.'");location.replace("page.profile.php");</script>';
        } else {
            echo "<script>window.alert('Pengubahan data gagal. Cek kesalahan.')</script>";
        }
    }

}
?>


<div class="modal fade" id="lihatqr">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">

            <div class="modal-header">
                <h4 class="modal-title">QR Code Anda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="badge badge-light">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <img src="dist/img/qrcode/<?php echo $qruser;?>.png" alt="" height="200" width="200">


            </div>
            <div class="m-2 p-3 d-flex justify-content-center">
                <a href="dist/img/qrcode/<?php echo $qruser;?>.png" class="btn btn-primary"
                    download="QRCODE-<?php echo $namauser;?>"><i class="fa fa-download mr-2"></i> Unduh QR
                    Code </a>
                <script>
                const download = (path, filename) => {
                    // Create a new link
                    const anchor = document.createElement('a');
                    anchor.href = path;
                    anchor.download = filename;

                    // Append to the DOM
                    document.body.appendChild(anchor);

                    // Trigger `click` event
                    anchor.click();

                    // Remove element from DOM
                    document.body.removeChild(anchor);
                };
                </script>
            </div>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<style>
.kartu {
    height: 100mm;
    width: 65mm;
    background: url('dist/img/bgid.jpg');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    display: inline-table;
    text-align: center;
    margin: 1px;
    border-style: solid;
    border-width: 1px;
}

.foto {
    height: 23mm;
    width: 23mm;
    border-radius: 50%;
    margin: 21.5mm 0mm 0mm 20.7mm;
    background-size: cover;
    background-position: top;
    background-repeat: no-repeat;

}


.qrcode {
    height: 25mm;
    width: 25mm;
    border-radius: 10px;
    margin: 3mm 20mm 0mm 20mm;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.nama {
    color: #000000;
    margin: 5mm 5mm 0mm 5mm;
    word-wrap: break-word;
    text-align: center;

}

.nama h2 {
    font-family: 'Noto sans', sans-serif;
    font-weight: 700;
    font-size: 12pt;
    color: #083C5A;
    word-wrap: break-word;
    line-height: 1rem;
    margin: auto;

}

.nama span {
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    font-size: 8pt;
    color: #083C5A;
}
</style>
<div class="modal fade" id="lihatidcard">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">

            <div class="modal-header">
                <h4 class="modal-title">ID Card Anda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="badge badge-light">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="d-flex justify-content-center">
                    <div class="kartu " id="kartu">
                        <div class="foto" style="background-image: url('dist/img/foto-user/<?php echo $fotouser ;?>');">
                        </div>
                        <div class="nama">
                            <h2>
                                <?php echo $namauser ?>
                            </h2>
                            <span>
                                NIP/NUPK. <?php echo $nipuser ?>
                            </span>
                        </div>
                        <div class="qrcode bg-dark"
                            style="background-image: url('dist/img/qrcode/<?php echo $qruser ;?>.png');">
                        </div>


                    </div>
                </div>
                <div class="m-2 p-3 d-flex justify-content-center">
                    <button class="btn btn-primary" onclick="downloadIDCard()"><i class="fa fa-download mr-2"></i>Unduh
                        ID Card</button>
                </div>

            </div>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(function() {
    $("#tabelrekap").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "print"]
    }).buttons().container().appendTo('#tabelrekap_wrapper .col-md-6:eq(0)');

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
<?php
require 'footer.admin.php';
require 'script.php';
?>

<script>
function downloadIDCard() {

    var node = document.getElementById('kartu');

    domtoimage.toPng(node)
        .then(function(dataUrl) {
            var img = new Image();
            img.src = dataUrl;
            downloadURI(dataUrl, "ID-Card <?php echo $namauser;?>.png")
        })
        .catch(function(error) {
            console.error('oops, something went wrong', error);
        });

}



function downloadURI(uri, name) {
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    delete link;
}
</script>
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

</html>