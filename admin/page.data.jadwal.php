<?php
$title = 'Jadwal Pelajaran';
require 'sidebar.admin.php';

if($aksesjadwal !== 'Ya'){
    ?>
<script>
location.replace("dashboard.php");
</script>
<?php
    }

?>
<style id="css">
@media print {
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');

    * {
        -webkit-print-color-adjust: exact;
    }

    h3 {
        font-family: 'Noto sans', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
    }

    button {
        display: none;
    }

    table {
        font-family: 'Noto sans', sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    table td,
    table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }

    table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0084ff;
        color: white;
        text-align: center;
    }

    .text-center {
        text-align: center;
    }

    .notPrint,
    .dataTables_info,
    .dataTables_filter,
    .pagination {
        display: none;
    }
}
</style>


<section class="container">

    <div class="p-2 d-flex justify-content-end">
        <button class="btn btn-success m-1" onclick="printJadwal()">
            <i class="fas fa-print mr-2"></i> Cetak / Simpan PDF</button>
        <a href="page.edit.mapel.php" class="btn btn-primary m-1">
            <i class="fas fa-edit mr-2 "></i>Edit / Tambah Mapel</a>

        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#editjadwal"><i
                class="fas fa-plus mr-2"></i>
            Tambah Jadwal</button>
        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#resetjadwal"><i
                class="fas fa-rotate mr-2"></i>
            Reset Jadwal</button>

    </div>

    <form action="" method="POST" class="bg-dark p-2 row m-2">
        <div class="col-sm-2 ">
            <select class="form-control select2bs4 " data-placeholder="Pilih Kelas" name="kelas">
                <option id="fkelas" value=""></option>
                <?php
                $d_kelas = "SELECT * FROM kelas";
                $data_kelas = mysqli_query($koneksi,$d_kelas);
                while ($dkelas = mysqli_fetch_array($data_kelas)){
                    $idk = $dkelas['id_kelas'];
                    $lkelas = $dkelas['namakelas'];
                    ?><option value="<?php echo $idk;?>"><?php echo $lkelas;?></option>
                <?php }
                                ?>
            </select>
        </div>
        <div class="col-sm-2 ">

            <select class="form-control select2bs4 " data-placeholder="Pilih Hari" name="hari">
                <option value=""></option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
        </div>
        <div class="col-sm-2 ">
            <button type="submit" name="lihat" class="btn btn-primary "><i class=" fa fa-eye"></i> Lihat</button>
        </div>
    </form>
</section>
<section class="container">
    <?php

            if (isset($_POST['lihat'])){
            $hari = $_POST['hari'];
            $kelas = $_POST['kelas'];
            
            if(!empty($hari)){
                $aturan = "hari='$hari' AND kelas='$kelas'";
                $h = 'Hari '.$hari;
            }else{
                $aturan = "kelas='$kelas'";
            }
            
            $d_jadwal = "SELECT * FROM jadwal WHERE $aturan ORDER BY jam_ke ";
            $data_jadwal = mysqli_query($koneksi,$d_jadwal);

            ?>

    <div class="m-2 p-3" id="isiJadwal">
        <div id="title" hidden>Jadwal Pelajaran :: <?php echo $kelas;?>
            <?php if(!empty($hari)){echo ' :: Hari '.$hari.' ::'; }?> </div>
        <div class="card-body table-reponsive">
            <h3 class="card-title ml-0 mr-2 mt-2 mb-2">Jadwal Pelajaran <b><?php echo $kelas;?> </b>
                <?php if(!empty($hari)){echo 'Hari '.$hari;}?>
            </h3>
            <table class="table table-striped table-bordered" width="100%" id="tabelJadwal">
                <thead>
                    <tr class="align-middle p-2">
                        <th>Hari</th>
                        <th style="width:80px">Jam ke</th>
                        <th style="width:80px">Waktu</th>
                        <th>Mata Pelajaran</th>
                        <th>Durasi (JP)</th>
                        <th class="notPrint"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="p-2">
                        <?php
                        $no     = 1;
                        while ($jadwal = mysqli_fetch_array($data_jadwal))
                        {?>
                        <td><?php echo $jadwal['hari']?></td>

                        <td class="text-center"><?php echo $jadwal['jam_ke']?></td>
                        <td><?php echo $jadwal['mulai']?> - <?php echo $jadwal['selesai']?></td>
                        <?php 
                        $idmapel = $jadwal['id_mapel'];
                        $datamapel = "SELECT mapel FROM mapel WHERE id='$idmapel'";
                            $lmapel = mysqli_query($koneksi, $datamapel);
                            while($namamapel = mysqli_fetch_array($lmapel)){
                        ?>
                        <td><?php echo $namamapel['mapel'];} ?> </td>
                        <td><?php echo $jadwal['durasi']?> Jam</td>
                        <td class="notPrint">
                            <!-- <a href="page.data.jadwal.php?idhapus=<?php //echo $jadwal['id_jadwal']?>"
                                class="btn btn-danger btn-sm" type="hapus">
                                <i class="fi fi-sr-delete mr-1"></i> Hapus</a> -->
                            <span type="button" class="badge badge-danger p-2" data-toggle="modal"
                                data-target="#hapusj-<?php echo $jadwal['id_jadwal']?>">
                                <i class="fa fa-trash"></i> Hapus
                            </span>
                            <div class="modal fade" tabindex="-1" id="hapusj-<?php echo $jadwal['id_jadwal']?>">
                                <div class="modal-dialog modal-dialog-centered modal-sm ">
                                    <div class="modal-content p-3 text-center">
                                        <div class="modal-body">
                                            <p>Hapus Jadwal?
                                            </p>
                                        </div>
                                        <div class="text-center mb-2">
                                            <button type="button" class="mr-2 btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <a href="page.data.jadwal.php?idhapus=<?php echo $jadwal['id_jadwal']?>"
                                                type="button" class="ml-2 btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr><?php ;$no++; }?>
                </tbody>
            </table>
        </div><!-- tab-->

    </div>
    <!-- /.card -->
    <?php }else{ 
    $d_jadwal = "SELECT * FROM jadwal ORDER BY kelas  AND jam_ke ";
    $data_jadwal = mysqli_query($koneksi,$d_jadwal);
    
    ?>
    <div class="m-2 p-3" id="isiJadwal">
        <div id="title" hidden>Jadwal Pelajaran :: <?php echo $sekolah;?> </div>
        <div class="card-body table-reponsive">
            <h3 class="card-title ml-0 mr-2 mt-2 mb-2">Jadwal Pelajaran <b><?php echo $sekolah;?> </b>
            </h3>
            <table class="table table-striped" width="100%" id="tabelJadwal">
                <thead>
                    <tr class="align-middle p-2">
                        <th>Hari</th>
                        <th>Kelas</th>
                        <th style="width:80px">Jam ke</th>
                        <th style="width:80px">Waktu</th>
                        <th>Mata Pelajaran</th>
                        <th>Durasi</th>
                        <th class="notPrint"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="p-2">
                        <?php
                        $no     = 1;
                        while ($jadwal = mysqli_fetch_array($data_jadwal))
                        {?>
                        <td><?php echo $jadwal['hari']?></td>
                        <?php 
                            $idkelas = $jadwal['kelas'];
                            $datakelas = "SELECT namakelas FROM kelas WHERE id_kelas='$idkelas'";
                            $kelas = mysqli_query($koneksi, $datakelas);
                            while($namakelas = mysqli_fetch_array($kelas)){
                        ?>
                        <td><?php echo $namakelas['namakelas'];}?></td>
                        <td class="text-center"><?php echo $jadwal['jam_ke']?></td>
                        <td><?php echo $jadwal['mulai']?> - <?php echo $jadwal['selesai']?></td>
                        <?php 
                        $idmapel = $jadwal['id_mapel'];
                        $datamapel = "SELECT mapel FROM mapel WHERE id='$idmapel'";
                            $lmapel = mysqli_query($koneksi, $datamapel);
                            while($namamapel = mysqli_fetch_array($lmapel)){
                        ?>
                        <td><?php echo $namamapel['mapel'];} ?> </td>
                        <td><?php echo $jadwal['durasi']?> JP</td>
                        <td class="notPrint">
                            <!-- <a href="page.data.jadwal.php?idhapus=<?php //echo $jadwal['id_jadwal']?>"
                                class="btn btn-danger btn-sm" type="hapus">
                                <i class="fi fi-sr-delete mr-1"></i> Hapus</a> -->
                            <span type="button" class="badge badge-danger p-2" data-toggle="modal"
                                data-target="#hapusj-<?php echo $jadwal['id_jadwal']?>">
                                <i class="fa fa-trash"></i> Hapus
                            </span>
                            <div class="modal fade" tabindex="-1" id="hapusj-<?php echo $jadwal['id_jadwal']?>">
                                <div class="modal-dialog modal-dialog-centered modal-sm ">
                                    <div class="modal-content p-3 text-center">
                                        <div class="modal-body">
                                            <p>Hapus Jadwal?
                                            </p>
                                        </div>
                                        <div class="text-center mb-2">
                                            <button type="button" class="mr-2 btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <a href="page.data.jadwal.php?idhapus=<?php echo $jadwal['id_jadwal']?>"
                                                type="button" class="ml-2 btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr><?php ;$no++; }?>
                </tbody>
            </table>
        </div><!-- tab-->

    </div>

    <?php


    }?>
</section>
<div class="card-footer bg-white">

</div>
<!-- /.col -->
<div class="modal fade" id="editjadwal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group mb-2" method="post" action="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2" id="inHari">
                                <label>Hari</label>
                                <div id="formHari" class="mb-2">
                                    <select class="form-control select2bs4 mb-2" name="pilihhari" required="required">
                                        <option value=""></option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-2" id="inKelas">
                                <label class="">Kelas</label>
                                <div id="formKelas" class="mb-2">
                                    <select class="form-control select2bs4 mb-2" name="pilihkelas" required="required">
                                        <option value=""></option>
                                        <?php $kelas = 'SELECT * FROM kelas';
                                $qkelas = mysqli_query($koneksi, $kelas);
                                while ($lkelas = mysqli_fetch_array($qkelas)) {
                                    echo '<option value="'.$lkelas['id_kelas'].'">'.$lkelas['namakelas'].'</option>';}?>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-1" id="inJamke">
                            <label class="">Jam ke</label>
                            <div id="formJamke">
                                <input type="number" name="jam_ke[]" class="form-control mb-2" value=""
                                    required="required">
                            </div>

                        </div>
                        <div class="col-2" id="inMulai">
                            <label class="">Mulai</label>
                            <div id="formMulai">
                                <div class="input-group date mb-2" id="mulai" data-target-input="nearest">
                                    <input type="time" class="form-control " name="mulai[]" required="required" />

                                </div>
                            </div>

                        </div>
                        <div class="col-2" id="inSelesai">
                            <label class="">Selesai</label>
                            <div id="formSelesai">
                                <div class="input-group date mb-2" id="selesai" data-target-input="nearest">
                                    <input type="time" class="form-control " name="selesai[]" required="required" />

                                </div>
                            </div>

                        </div>
                        <div class="col-6" id="inMapel">
                            <label class="">Mapel</label>
                            <div id="formMapel" class="mb-2">
                                <select class="form-control select2bs4 mb-2" name="mapel[]" style="width: 100%;"
                                    required="required">
                                    <option value="" selected="selected"></option>
                                    <?php $sql_mapel = 'SELECT * FROM mapel';
                                $query_mapel = mysqli_query($koneksi, $sql_mapel);
                                while ($row_mapel = mysqli_fetch_array($query_mapel)) {
                                    echo '<option value="'.$row_mapel['id'].'">'.$row_mapel['mapel'].'</option>';}?>
                                </select>
                            </div>


                        </div>
                        <div class="col-1" id="inDurasi">
                            <label class="">Durasi (JP)</label>
                            <div id="formDurasi">
                                <input type="number" name="durasi[]" class="form-control mb-2" value=""
                                    required="required">
                            </div>

                        </div>

                    </div>
                    <div class="mt-2 mb-2">
                        <a class="btn btn-secondary" id="btnTambah"><i class="fa fa-plus"></i></a>
                    </div>
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

<div class="modal fade" id="resetjadwal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body bg-danger text-center">
                <p>Semua Jadwal akan dihapus dari database. Silahkan lakukan Backup terlebih dahulu karena tindakan ini
                    tidak dapat di urungkan</p>
                <div class="text-center">
                    <!-- <button type="button" class="btn btn-primary">Backup Data</button> -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a href="page.data.jadwal.php?reset=reset" type="submit" class="btn btn-dark">Hapus</a>
                </div>


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

if(isset($_GET['reset'])){
    $reset = mysqli_query($koneksi, "DELETE FROM jadwal");
    if($reset == TRUE){
        echo "<script> $('#berhasil').modal('show');
        const timeout = setTimeout(reload, 1000);

        function reload() {
            location.replace('page.data.jadwal.php');
        }</script>";
       } else {
            echo "<script> $('#gagal').modal('show');</script>";
        }
}

                    
if(isset($_POST['simpan'])){
    $pilihhari = $_POST['pilihhari'];
    $pilihkelas = $_POST['pilihkelas'];
    $jam_ke = $_POST['jam_ke'];
    $mapel = $_POST['mapel'];
    $durasi = $_POST['durasi'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];

   
    
    
    $jml = count($jam_ke);
    for ($i=0; $i < $jml ; $i++){
        $dtguru = "SELECT id_guru FROM mapel WHERE id='$mapel[$i]'";
        $lguru = mysqli_query($koneksi, $dtguru);
        $no = 0;
        while($idg = mysqli_fetch_array($lguru)){
            $gr = $idg['id_guru'];
            // echo "<h1>".$gr."</h1><br><hr>";
            $tambah = mysqli_query($koneksi, "INSERT INTO jadwal (hari, jam_ke, mulai, selesai, kelas,  id_guru, id_mapel, durasi) VALUES ('$pilihhari', '$jam_ke[$i]','$mulai[$i]', '$selesai[$i]', '$pilihkelas','$gr','$mapel[$i]', '$durasi[$i]')");

            if($tambah == TRUE){
                echo "<script> $('#berhasil').modal('show');
                const timeout = setTimeout(reload, 1000);
        
                function reload() {
                    location.replace('page.data.jadwal.php');
                }</script>";
               } else {
                    echo "<script> $('#gagal').modal('show');</script>";
                }
      $no++; }
       
       
        
    }
}

if(isset($_GET['idhapus'])){
    $idj = $_GET['idhapus'];
    $hapjad = mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal='$idj'");

    if($hapjad == TRUE){
        echo "<script> $('#berhasil').modal('show');
        const timeout = setTimeout(reload, 1000);

        function reload() {
            location.replace('page.data.jadwal.php');
        }</script>";
       } else {
            echo "<script> $('#gagal').modal('show');</script>";
        }
}

                    
?>
<script>
$(function() {
    $("#tabelJadwal").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tabelJadwal_wrapper .col-md-6:eq(0)');
});
</script>
<script>
function printJadwal() {
    const d = new Date();
    var title = document.getElementById('title').innerHTML;
    var css = document.getElementById('css').innerHTML;
    var jadwal = document.getElementById("isiJadwal").innerHTML;
    var a = window.open('', '', 'height=1000px, width=1500px');
    a.document.write('<html width="210mm" height="297mm"><head><title>' + title + Date.now() +
        '</title><style>' + css + '</style></head><body>' + jadwal + '</body></html>');

    a.document.close();
    a.print();
    a.close();
}
</script>
<script>
//Timepicker
$('#mulai').datetimepicker({
    format: 'hh:mm'
})
$('#selesai').datetimepicker({
    format: 'hh:mm'
})
</script>
<script>
// var formHari = document.getElementById("formHari").innerHTML;
// var formKelas = document.getElementById("formKelas").innerHTML;
var formJamke = document.getElementById("formJamke").innerHTML;
var formMulai = document.getElementById("formMulai").innerHTML;
var formSelesai = document.getElementById("formSelesai").innerHTML;
var formMapel = document.getElementById("formMapel").innerHTML;
var formDurasi = document.getElementById("formDurasi").innerHTML;

$("#btnTambah").on("click", function() {
    // $("#inHari").append(formHari);
    // $("#inKelas").append(formKelas);
    $("#inJamke").append(formJamke);
    $("#inMulai").append(formMulai);
    $("#inSelesai").append(formSelesai);
    $("#inMapel").append(formMapel);
    $("#inDurasi").append(formDurasi);
})
</script>

</html>