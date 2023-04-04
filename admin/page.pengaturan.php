<?php
$title = 'Pengaturan';

require 'sidebar.admin.php';

if($aksespengaturan !== 'Ya'){
    ?>
<script>
location.replace("dashboard.php");
</script>
<?php
    }

?>

<section class="container p-3 ">
    <div class="row">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="">
                <div class="card-header p-0">

                    <ul class="nav nav-pills ml-auto p-0">
                        <li class="nav-item"><a class="nav-link active rounded-0" href="#aplikasi" id="aplikasi">
                                Aplikasi</a>
                        </li>
                        <li class="nav-item"><a class="nav-link  rounded-0" href="#sekolah" id="sekolah">
                                Sekolah</a>
                        </li>

                        <li class="nav-item"><a class="nav-link  rounded-0" href="#kelas" id="kelas">
                                Kelas</a>
                        </li>
                        <li class="nav-item"><a class="nav-link  rounded-0" href="#lokasi" id="lokasi">
                                Lokasi</a>
                        </li>
                        <li class="nav-item"><a class="nav-link rounded-0" href="#jabatan" id="jabatan">
                                Jabatan</a>
                        </li>
                        <li class="nav-item"><a class="nav-link rounded-0" href="#role" id="role">
                                Role Admin</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- [ Tab Pane Data Aplikasi ] -->
                        <div class="tab-pane active" id="aplikasi">
                            <div class="col-md-5 mt-3">
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Aplikasi</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="namaapp"
                                                placeholder="Nama Aplikasi" value="<?= $n_aplikasi?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Versi Aplikasi</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="vapp" placeholder="Versi"
                                                value="<?= $versiapp?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Developer</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="devapp"
                                                placeholder="Developer" value="<?= $devapp?>">
                                        </div>
                                    </div>
                                    <div class="d-grid mt-5">
                                        <button class="btn btn-primary " name="simpanapp">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>




                            </div>
                        </div>

                        <!-- [ Tab Pane Data Sekolah ] -->
                        <div class="tab-pane" id="sekolah">
                            <form class="form-group" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4  p-3 m-2">
                                        <label>Nama Sekolah</label>
                                        <input type="text" name="nama-sekolah" class="form-control  mb-2"
                                            value="<?=$sekolah?>">

                                        <label>Alamat Sekolah</label>
                                        <input type="text" name="alamat-sekolah" class="form-control  mb-2"
                                            value="<?=$alamat?>">
                                        <label>Desa/Kelurahan</label>
                                        <input type="text" name="desa" class="form-control  mb-2"
                                            value="<?=$desa_kel?>">
                                        <label>Kecamatan</label>
                                        <input type="text" name="kec" class="form-control  mb-2" value="<?=$kec?>">
                                        <label>Kabupaten/Kota</label>
                                        <input type="text" name="kab" class="form-control  mb-2" value="<?=$kab?>">
                                        <label>Provinsi</label>
                                        <input type="text" name="prov" class="form-control  mb-2" value="<?=$prov?>">

                                    </div>

                                    <div class="col-md-4 p-3 m-2">
                                        <label>Logo Sekolah</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="UpFoto">
                                            <label class="custom-file-label" name="logo" for="UpLogo">Upload
                                                Logo</label>
                                        </div>

                                        <div class="mt-4 card card-dark">
                                            <div class="card-header">
                                                Logo Saat ini :
                                            </div>
                                            <div class="card-body d-flex justify-content-center">
                                                <img src="dist/img/<?=$logo?>" alt="" height="150px" width="auto">
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-primary" name="simpansekolah">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- [ Tab Pane Data Kelas ] -->
                        <div class="tab-pane " id="kelas">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table ">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Kelas Saat ini :</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $datakelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                                            while($dkelas = mysqli_fetch_array($datakelas)){
                                            ?>
                                            <tr>
                                                <td><?php echo $dkelas['namakelas']; ?>
                                                </td>
                                                <td><span class="badge badge-danger ml-3"><a class="text-white"
                                                            href="?id=<?php echo $dkelas['id_kelas'];?>"><i
                                                                class="fa-solid fa-trash-can mr-2"></i>Hapus</a></span>
                                                </td>
                                            </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">

                                    <h5>Tambah Kelas Baru</h5>
                                    <hr>

                                    <form action="" method="post">
                                        <label>Nama Kelas</label>
                                        <input type="text" name="namakelas" class="form-control  mb-2" value="">
                                        <div class="d-grid">
                                            <button type="submit" name="simpankelas" class="btn btn-primary mt-3">
                                                <i class="fa fa-save"></i> Simpan Kelas Baru
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- [ Tab Pane Data Lokasi ] -->
                        <div class="tab-pane" id="lokasi">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="card-body p-0">
                                        <table class="table">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th>Lokasi</th>
                                                    <th>Lokasi untuk</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                    $datalok = mysqli_query($koneksi, "SELECT * FROM lokasi ");
                                                    while($dlok = mysqli_fetch_array($datalok)){
                                                        $idlokasi = $dlok['id_lok'];
                                                        $lokasi = $dlok['lokasi'];
                                                        $rlokasi = $dlok['r_kelas'];
                                                    ?><tr>
                                                    <td><?php echo $lokasi ;?></td>
                                                    <td><?php echo $rlokasi;?></td>
                                                    <td><a href="?idlokasi=<?php echo $idlokasi;?>">
                                                            <span class="badge badge-danger">
                                                                <i class="fa fa-trash mr-2">
                                                                </i>Hapus
                                                            </span>
                                                        </a></td>
                                                </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="  d-flex justify-content-start">
                                                <button id="tambahLokasi" class="btn btn-primary rounded-0 mr-2 ml-2"
                                                    onclick="tambahLokasi()">
                                                    <i class="fa fa-plus mr-2"></i>Tambah Lokasi
                                                </button>

                                                <button id="lihatQR" class="btn btn-primary rounded-0 mr-2 ml-2"
                                                    onclick="lihatQR()">
                                                    <i class="fa fa-qrcode mr-2"></i>Lihat Lokasi
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="container p-2" id="tambah" hidden>
                                            <form action="" method="post">
                                                <h4>Tambah Lokasi</h4>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="">Nama Lokasi</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Masukkan nama lokasi" name="lokasi">

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Lokasi ini dikelas? <i>(Optional)</i></label>
                                                    <select class="form-control select2bs4 "
                                                        data-placeholder="Pilih Kelas" name="pilihkelas"
                                                        required="required">
                                                        <option value=""></option>
                                                        <?php $kelas = 'SELECT * FROM kelas';
                                                    $qkelas = mysqli_query($koneksi, $kelas);
                                                    while ($lkelas = mysqli_fetch_array($qkelas)) {
                                                        echo '<option value="'.$lkelas['namakelas'].'">'.$lkelas['namakelas'].'</option>';}?>
                                                    </select>

                                                </div>
                                                <button type="submit" name="simpan" value="simpan"
                                                    class=" btn btn-primary">
                                                    <i class="fa fa-save mr-2"></i> Simpan Lokasi</button>
                                            </form>
                                        </div>
                                        <?php
                                        if(isset($_POST['simpan'])){
                                                $lokasi = $_POST['lokasi'];

                                                
                                                $qr_dir="dist/img/qrcode/";
                                                if (!file_exists($qr_dir))
                                                mkdir($qr_dir, 0755);
                                                $qrval =rand();
                                                $qr_file=$qrval.".png";   
                                                $qr_path = $qr_dir.$qr_file;
                                                QRcode::png($qrval, $qr_path , "H", 6, 4);
                                                
                                                $tambahlokasi = mysqli_query($koneksi, "INSERT INTO lokasi (lokasi, qrcodelokasi) VALUES ('$lokasi','$qrval')");

                                                if($tambahlokasi == TRUE){
                                                    echo "<script>window.alert('Lokasi Baru telah ditambahkan');location.replace('page.lokasi.php');</script>";
                                                    
                                                }else{
                                                    echo "<script>window.alert('Lokasi tidak dapat ditambahkan');</script>";
                                                }
                                        }
                                        ?>
                                        <div class="container form-group" id="lihat" hidden>
                                            <form action="" method="post">
                                                <h4>Lihat Lokasi</h4>
                                                <hr>
                                                <label for="">Pilih Lokasi</label>
                                                <select id="" class="form-control mb-2" name="lokasi" placeholder="i">
                                                    <option value="">Pilih Lokasi</option>
                                                    <?php 
                                                    $lokasi = 'SELECT * FROM lokasi';
                                                    $qlokasi = mysqli_query($koneksi, $lokasi);
                                                    while ($llokasi = mysqli_fetch_array($qlokasi)) {
                                                        echo '<option value="'.$llokasi['id_lok'].'">'.$llokasi['lokasi'].'</option>';}?>
                                                </select>
                                                <button type="lihat" name="lihat" value="lihat" class="btn btn-primary">
                                                    <i class="fa fa-eye mr-2"></i> Lihat QR Code</button>
                                            </form>
                                        </div>

                                    </div>
                                    <?php
                                        if(isset($_POST['lihat'])){
                                            $idl = $_POST['lokasi'];

                                            $datalok = mysqli_query($koneksi, "SELECT * FROM lokasi WHERE id_lok='$idl'");
                                            while($dlok = mysqli_fetch_array($datalok)){
                                                $lokasi = $dlok['lokasi'];
                                                $qrlokasi = $dlok['qrcodelokasi'];

                                            ?>
                                    <div class="card-body p-3 bg-dark ">
                                        <div class="text-center mt-3">

                                            <h3><?php echo $lokasi; ?>
                                                <span class="badge badge-danger">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </span>
                                            </h3>
                                            <div class="p-4 m-2">
                                                <img src="dist/img/qrcode/<?php echo $qrlokasi;?>.png" alt="">
                                            </div>
                                            <div class="m-2 p-3">
                                                <a href="dist/img/qrcode/<?php echo $qrlokasi;}?>.png"
                                                    class="btn btn-primary" download="QRCODE-<?php echo $lokasi;?>"><i
                                                        class="fa fa-download mr-2"></i> Unduh QR
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
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <!-- [ Tab Pane Data Jabatan ] -->
                        <div class="tab-pane " id="jabatan">
                            <div class="row">
                                <div class="col-md-6">

                                    <table class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Jabatan Saat ini :</th>
                                                <th>Gaji</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                         
                                                
                                                // echo rupiah($gaji);
                                            $datajabatan = mysqli_query($koneksi, "SELECT * FROM jabatan");
                                            while($djabatan = mysqli_fetch_array($datajabatan)){
                                                $jab = $djabatan['tipe_jabatan'];
                                            ?>
                                            <tr>
                                                <td><?php echo $jab;  ?>
                                                </td>
                                                <td><?php echo rupiah($djabatan['gaji'])  ?></td>
                                                <?php 
                                                if($jab !== 'Kepala Sekolah' AND $jab !== 'Guru Mapel'){
                                                ?>
                                                <td><span class="badge badge-danger ml-3"><a class="text-white"
                                                            href="?hapusjabatan=<?php echo $djabatan['id'];?>#jabatan"><i
                                                                class="fa-solid fa-trash-can mr-2"></i>Hapus</a></span>
                                                </td>
                                                <?php
                                                
                                                }else{
                                                    ?><td></td>
                                                <?php
                                                } ?>

                                            </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                    <span class="">
                                        <i><small>
                                                *Note : Gaji disini adalah hitungan perbulan kecuali untuk Guru Mapel
                                                yang hitungannya per Jam Pelajaran
                                            </small>

                                        </i>

                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="container">

                                        <button class="btn btn-primary m-0 rounded-0" onclick="tambahjabatan()">
                                            <i class="fa fa-plus mr-2"></i>Tambah Jabatan</button>

                                        <button class="btn btn-primary m-0 rounded-0" onclick="editjabatan()">
                                            <i class="fa fa-edit mr-2"></i>Edit Jabatan</button>
                                    </div>
                                    <div class="container mt-3" id="tambahjabatan">

                                        <h5 class="">Tambah Jabatan Baru</h5>
                                        <hr>

                                        <form action="" method="post">
                                            <label>Tipe Jabatan</label>
                                            <input type="text" name="tipejabatanbaru" class="form-control  mb-2"
                                                value="">
                                            <label>Gaji<i><small> Contoh : 20000</small></i></label>
                                            <input type="number" name="gajijabatanbaru" class="form-control  mb-2"
                                                value="">
                                            <div class="d-grid">
                                                <button type="submit" name="simpanjabbaru" class="btn btn-primary mt-3">
                                                    <i class="fa fa-save"></i> Simpan Jabatan Baru
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="container mt-3" id="editjabatan" hidden>

                                        <h5 class="">Edit Jabatan</h5>
                                        <hr>

                                        <form action="" method="post">

                                            <div class="form-group mb-2">
                                                <label for="">Pilih Jabatan Saat ini</label>
                                                <select name="jabskrng" id="" class="select select2bs4"
                                                    data-placeholder="Pilih Jabatan">
                                                    <option value="">Pilih Jabatan</option>
                                                    <?php
                                                    $datajabatan = mysqli_query($koneksi, "SELECT * FROM jabatan");
                                                    while($djabatan = mysqli_fetch_array($datajabatan)){
                                                    ?>
                                                    <option value="<?php echo $djabatan['id'];?>">
                                                        <?php echo $djabatan['tipe_jabatan'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="">Tipe Jabatan Baru <span
                                                        class="badge badge-secondary">Kosongkan jika tidak
                                                        diubah</span></label>
                                                <input type="text" class="form-control" name="tjabatanbaru">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="">Gaji Baru <i><small>Contoh : 20000</small></i> <span
                                                        class="badge badge-secondary">Kosongkan
                                                        jika tidak
                                                        diubah</span></label>
                                                <input type="number" class="form-control" name="gajibaru">
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" name="simpaneditjab" class="btn btn-primary mt-3">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- [ Tab Pane Data Role ] -->
                        <div class="tab-pane " id="role">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table ">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Role Sat ini : <i><small>Klik Role untuk melihat ijin
                                                            akses</small></i></th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $datarole = mysqli_query($koneksi, "SELECT * FROM role");
                                            while($drole = mysqli_fetch_array($datarole)){
                                            ?>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td><?php echo $drole['type_role']; ?>
                                                </td>

                                            </tr>
                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <p>
                                                        Halaman Dashboard
                                                        <?php 
                                                        if($drole['dashboard'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -
                                                        Halaman Admin
                                                        <?php 
                                                        if($drole['admin'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman PTK
                                                        <?php 
                                                        if($drole['ptk'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman Jadwal
                                                        <?php 
                                                        if($drole['jadwal'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman Gaji
                                                        <?php 
                                                        if($drole['gaji'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman Rekap
                                                        <?php 
                                                        if($drole['rekap'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman ID Card
                                                        <?php 
                                                        if($drole['idcard'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman Lokasi
                                                        <?php 
                                                        if($drole['lokasi'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman Profil
                                                        <?php 
                                                        if($drole['profil'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?> -

                                                        Halaman Pengaturan
                                                        <?php 
                                                        if($drole['pengaturan'] == 'Ya'){
                                                            ?> <i class="fa-solid fa-square-check text-success"></i><?php }else{
                                                                ?><i
                                                            class="fa-solid fa-square-xmark text-danger"></i><?php }?>

                                                    </p>
                                                </td>
                                            </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">

                                    <div class="container">

                                        <button class="btn btn-primary m-0 rounded-0" onclick="tambahrole()">
                                            <i class="fa fa-plus mr-2"></i>Tambah Role Baru</button>

                                        <button class="btn btn-primary m-0 rounded-0" onclick="editrole()">
                                            <i class="fa fa-edit mr-2"></i>Edit Role</button>
                                    </div>
                                    <div class="container mt-3" id="tambahrole">

                                        <h5 class="">Tambah Role Baru</h5>
                                        <hr>

                                        <form action="" method="post">
                                            <label>Tipe Role</label>
                                            <input type="text" name="tiperolebaru" class="form-control  mb-2" value="">
                                            <label for="">Ijin Akses</label>
                                            <div class="row border border-1 p-2">
                                                <div class="col-md-6">

                                                    <label for="" class="col-8">Dashboard</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check1" name="adashboard">
                                                        <label for="check1">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. Admin</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check2" name="aadmin">
                                                        <label for="check2">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. PTK</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check3" name="aptk">
                                                        <label for="check3">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. Jadwal</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check4" name="ajadwal">
                                                        <label for="check4">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. Gaji</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check5" name="agaji">
                                                        <label for="check5">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="" class="col-8">Hal. Rekap</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check6" name="arekap">
                                                        <label for="check6">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. ID Card</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check7" name="aidcard">
                                                        <label for="check7">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. Lokasi</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check8" name="alokasi">
                                                        <label for="check8">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. Profil</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check9" name="aprofil">
                                                        <label for="check9">
                                                        </label>
                                                    </div>
                                                    <label for="" class="col-8">Hal. Pengaturan</label>
                                                    <div class="icheck-primary d-inline col-2">
                                                        <input type="checkbox" id="check10" name="apengaturan">
                                                        <label for="check10">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" name="simpanrolebaru"
                                                    class="btn btn-primary mt-3">
                                                    <i class="fa fa-save"></i> Simpan Role Baru
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="container mt-3" id="editrole" hidden>

                                        <h5 class="">Edit Role</h5>
                                        <hr>

                                        <form action="" method="post">

                                            <div class="form-group mb-2">
                                                <label for="">Pilih Role Saat ini</label>
                                                <select name="jabskrng" id="" class="select select2bs4">
                                                    <option value="">Pilih Role</option>
                                                    <?php
                                                        $datarole = mysqli_query($koneksi, "SELECT * FROM role");
                                                        while($drole = mysqli_fetch_array($datarole)){
                                                        ?>
                                                    <option value="<?php echo $drole['type_role'];?>">
                                                        <?php echo $drole['type_role'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="">Tipe Role Baru <span
                                                        class="badge badge-secondary">Kosongkan jika tidak
                                                        diubah</span></label>
                                                <input type="text" class="form-control" name="trolebaru">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="">Ijin Akses</label>
                                                <div class="row border border-1 p-2">
                                                    <div class="col-md-6">

                                                        <label for="" class="col-8">Dashboard</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check1" name="adashboard">
                                                            <label for="check1">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. Admin</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check2" name="aadmin">
                                                            <label for="check2">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. PTK</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check3" name="aptk">
                                                            <label for="check3">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. Jadwal</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check4" name="ajadwal">
                                                            <label for="check4">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. Gaji</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check5" name="agaji">
                                                            <label for="check5">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="col-8">Hal. Rekap</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check6" name="arekap">
                                                            <label for="check6">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. ID Card</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check7" name="aidcard">
                                                            <label for="check7">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. Lokasi</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check8" name="alokasi">
                                                            <label for="check8">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. Profil</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check9" name="aprofil">
                                                            <label for="check9">
                                                            </label>
                                                        </div>
                                                        <label for="" class="col-8">Hal. Pengaturan</label>
                                                        <div class="icheck-primary d-inline col-2">
                                                            <input type="checkbox" id="check10" name="apengaturan">
                                                            <label for="check10">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" name="simpaneditrole"
                                                    class="btn btn-primary mt-3">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

    </div>

</section>
<div class="modal fade" id="infopengaturan">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Untuk saat ini, Halaman pengaturan belum berfungsi untuk setting data aplikasi, hanya menampilkan
                    saja.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="tutupinfo" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script type="text/javascript">
// [ INSERT ACTIVE NAV-LINK AND TAB CONTENT ]

$("#aplikasi" + ".nav-link").on("click", function() {
    $(".nav-link" + ".active").removeClass("active");
    $(".tab-pane" + ".active").removeClass("active");
    $("#aplikasi" + ".nav-link").addClass("active");
    $("#aplikasi" + ".tab-pane").addClass("active");
    $("#menuPengaturan").addClass("active");
})
$("#sekolah" + ".nav-link").on("click", function() {
    $(".nav-link" + ".active").removeClass("active");
    $(".tab-pane" + ".active").removeClass("active");
    $("#sekolah" + ".nav-link").addClass("active");
    $("#sekolah" + ".tab-pane").addClass("active");
    $("#menuPengaturan").addClass("active");
})
$("#kelas" + ".nav-link").on("click", function() {
    $(".nav-link" + ".active").removeClass("active");
    $(".tab-pane" + ".active").removeClass("active");
    $("#kelas" + ".nav-link").addClass("active");
    $("#kelas" + ".tab-pane").addClass("active");
    $("#menuPengaturan").addClass("active");
})
$("#lokasi" + ".nav-link").on("click", function() {
    $(".nav-link" + ".active").removeClass("active");
    $(".tab-pane" + ".active").removeClass("active");
    $("#lokasi" + ".nav-link").addClass("active");
    $("#lokasi" + ".tab-pane").addClass("active");
    $("#menuPengaturan").addClass("active");
})
$("#jabatan" + ".nav-link").on("click", function() {
    $(".nav-link" + ".active").removeClass("active");
    $(".tab-pane" + ".active").removeClass("active");
    $("#jabatan" + ".nav-link").addClass("active");
    $("#jabatan" + ".tab-pane").addClass("active");
    $("#menuPengaturan").addClass("active");
})
$("#role" + ".nav-link").on("click", function() {
    $(".nav-link" + ".active").removeClass("active");
    $(".tab-pane" + ".active").removeClass("active");
    $("#role" + ".nav-link").addClass("active");
    $("#role" + ".tab-pane").addClass("active");
    $("#menuPengaturan").addClass("active");
})

// [ INSERT ACTIVE CLASS IN LOAD IF CONTAIN ID CONTENT ]

$("document").ready(function() {
    if (window.location.href.indexOf("#aplikasi") > -1) {
        $(".nav-link" + ".active").removeClass("active");
        $(".tab-pane" + ".active").removeClass("active");
        $("#aplikasi" + ".nav-link").addClass("active");
        $("#aplikasi" + ".tab-pane").addClass("active");
        $("#menuPengaturan").addClass("active");
    }
    if (window.location.href.indexOf("#sekolah") > -1) {
        $(".nav-link" + ".active").removeClass("active");
        $(".tab-pane" + ".active").removeClass("active");
        $("#sekolah" + ".nav-link").addClass("active");
        $("#sekolah" + ".tab-pane").addClass("active");
        $("#menuPengaturan").addClass("active");
    }
    if (window.location.href.indexOf("#kelas") > -1) {
        $(".nav-link" + ".active").removeClass("active");
        $(".tab-pane" + ".active").removeClass("active");
        $("#kelas" + ".nav-link").addClass("active");
        $("#kelas" + ".tab-pane").addClass("active");
        $("#menuPengaturan").addClass("active");
    }
    if (window.location.href.indexOf("#lokasi") > -1) {
        $(".nav-link" + ".active").removeClass("active");
        $(".tab-pane" + ".active").removeClass("active");
        $("#lokasi" + ".nav-link").addClass("active");
        $("#lokasi" + ".tab-pane").addClass("active");
    }
    if (window.location.href.indexOf("#jabatan") > -1) {
        $(".nav-link" + ".active").removeClass("active");
        $(".tab-pane" + ".active").removeClass("active");
        $("#jabatan" + ".nav-link").addClass("active");
        $("#jabatan" + ".tab-pane").addClass("active");
        $("#menuPengaturan").addClass("active");
    }
    if (window.location.href.indexOf("#role") > -1) {
        $(".nav-link" + ".active").removeClass("active");
        $(".tab-pane" + ".active").removeClass("active");
        $("#role" + ".nav-link").addClass("active");
        $("#role" + ".tab-pane").addClass("active");
        $("#menuPengaturan").addClass("active");
    }
})
</script>
<script>
function tambahjabatan() {
    document.getElementById('editjabatan').hidden = true;
    document.getElementById('tambahjabatan').hidden = false;
}

function editjabatan() {
    document.getElementById('editjabatan').hidden = false;
    document.getElementById('tambahjabatan').hidden = true;
}

function tambahrole() {
    document.getElementById('editrole').hidden = true;
    document.getElementById('tambahrole').hidden = false;
}

function editrole() {
    document.getElementById('editrole').hidden = false;
    document.getElementById('tambahrole').hidden = true;
}
</script>
<script>
var tambah = document.getElementById('tambah');
var lihat = document.getElementById('lihat');

function tambahLokasi() {
    tambah.hidden = false;
    lihat.hidden = true;

}

function lihatQR() {
    tambah.hidden = true;
    lihat.hidden = false;
}
</script>


<?php
require 'footer.admin.php';
require 'script.php';
?>
<!-- <script>
$(document).ready(function() {
    $("#infopengaturan").modal("show");
})
$("#tutupinfo").on("click", function() {
    $("#infopengaturan").modal("hide");
})
</script> -->
<?php 
//[ EDIT NAMA APLIKASI ] //
if(isset($_POST['simpanapp'])){
$namaapp = $_POST['namaapp'];
$vapp = $_POST['vapp'];
$developer = $_POST['devapp'];

$simpanapp = mysqli_query($koneksi, "UPDATE aplikasi SET nama_aplikasi='$namaapp', versi='$vapp', developer='$developer'");

    if($simpanapp == TRUE){
        echo "<script> $('#berhasil').modal('show');$('#xberhasil').on('click', function(){location.replace('page.pengaturan.php#aplikasi');})</script>";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}
?>

<?php 
if(isset($_POST['simpansekolah'])){
$namaapp = $_POST['namaapp'];
$vapp = $_POST['vapp'];
$developer = $_POST['devapp'];

$simpanapp = mysqli_query($koneksi, "UPDATE aplikasi SET nama_aplikasi='$namaapp', versi='$vapp', developer='$developer'");

    if($simpanapp == TRUE){
        echo "<script> $('#berhasil').modal('show');</script>$('#xberhasil').on('click', function(){location.replace('page.pengaturan.php#sekolah');})";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}
?>
<?php 
if(isset($_POST['simpanjabbaru'])){
$tjabatanbaru = $_POST['tipejabatanbaru'];
$gajijabatanbaru = $_POST['gajijabatanbaru'];


$simpanjabatan = mysqli_query($koneksi, "INSERT INTO jabatan (tipe_jabatan, gaji) VALUES ('$tjabatanbaru','$gajijabatanbaru')");

    if($simpanjabatan == TRUE){
        echo "<script> $('#berhasil').modal('show');$('#xberhasil').on('click', function(){location.replace('page.pengaturan.php#jabatan');})</script>";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}
?>
<?php 
if(isset($_POST['simpaneditjab'])){
    $idjab = $_POST['jabskrng'];
    if(!empty($_POST['tjabatanbaru'])){
        $tjabatanbaru = $_POST['tjabatanbaru'];
    }elseif(!empty($_POST['gajibaru'])){
        $gajijabatanbaru = $_POST['gajibaru'];
    }else{
        $tjabatanbaru = '';
        $gajijabatanbaru = '';
    }
    
    
$simpanjabatan = mysqli_query($koneksi, "UPDATE jabatan SET tipe_jabatan='$tjabatanbaru' AND gaji='$gajijabatanbaru'");

    if($simpanjabatan == TRUE){
        echo "<script> $('#berhasil').modal('show');$('#xberhasil').on('click', function(){location.replace('page.pengaturan.php#jabatan');})</script>";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}
?>
<?php 
if(isset($_GET['hapusjabatan'])){
    $idhj = $_GET['hapusjabatan'];
   
    $hapusj = mysqli_query($koneksi, "DELETE FROM jabatan WHERE id='$idhj'");
    if($hapusj == TRUE){
        echo "<script> $('#berhasil').modal('show'); $('#xberhasil').on('click', function(){location.replace('page.pengaturan.php#jabatan');})</script>";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}

?>


</html>