<style>
body {
    min-height: 496.781px;
    top: 0;
}

section {
    align-items: center;
    /* margin-top: 80px; */
}


.hasil {
    align-items: center;
}

.bawah {
    display: inline-block;
}

.qr-error {
    padding: 20px;
    margin-top: 80px;
    width: 100%;
    height: 100%;
}
</style>

<?php
$title = 'Detail Absen';
include 'header.php';
// require 'admin/config/appconfig.php';
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id-ID');

$now = new DateTime();
// $hariini = strftime('%A', $now->getTimestamp());
// $hariini = 'Sabtu';
$tglini = strftime('%d', $now->getTimestamp());
$blnini = strftime('%B', $now->getTimestamp());
$thnini = strftime('%Y', $now->getTimestamp());
$waktuini = strftime('%H:%M', $now->getTimestamp());
// echo "<h1>$hariini</h1>";
if (isset($_GET['qr'])){
    if(!empty($_GET['qr'])){
        $qr = $_GET['qr'];
        $status = $_GET['s'];
        $qrcode = $qr;

        

        $guru = mysqli_query($koneksi, "SELECT * FROM user WHERE qrcode='$qrcode'");
        $dataguru = mysqli_fetch_array($guru);
        if(!empty($dataguru)){
            $idguru = $dataguru['id'];
            $namaguru = $dataguru['nama'];
            $fotoguru = $dataguru['foto'];
            $nipguru = $dataguru['nip'];
        
            
            if($status == 'reguler'){
                $opsi = "WHERE id_guru='$idguru' AND hari='$hariini'";
            }elseif($status = 'invaler'){
                $opsi = "WHERE hari='$hariini'";
            }
                $datajadwal = mysqli_query($koneksi, "SELECT * FROM jadwal $opsi  ORDER BY jam_ke");

        
            
                if(!empty(mysqli_num_rows($datajadwal))){
                // echo '<h1>INI Muncul KETIKA NOT EMPTY</h1>';
?>

<body class=" p-2">

    <!-- [ Tampilan jika QR Tidak bermasalah ] -->
    <section class="container">
        <div class="hasil mt-5">

            <div class="d-grid text-center">
                <div class="d-flex justify-content-center m-2">
                    <div class="foto-user rounded-circle">
                        <style>
                        .foto-user {
                            width: 100px;
                            height: 100px;
                            background-image: url('admin/dist/img/foto-user/<?php echo $fotoguru;?>');
                            background-position: top;
                            background-size: cover;
                            padding: 0;
                            border: 1px solid;

                        }
                        </style>
                    </div>
                </div>
                <h4 class="nama"><?php echo $namaguru;?></h4>
                <span>NIP/NUPTK. <?php echo $nipguru;?></span>
                <style>
                .nama {
                    position: relative;
                    /* top: 248px;
                            background-color: #fff; */
                    /* height: 40px;
                            width: 198px; */
                    text-align: center;
                    font-family: 'Poppins', sans-serif;
                    line-height: 30px;
                    text-transform: uppercase;
                    font-weight: 700;
                    margin-top: 10px;
                }
                </style>
                <!-- <div class="bg-primary pt-2 pb-1 rounded-2 mt-3">
                    <h5 class="text-center">Pilih Jadwal <span class="badge badge-warning"><?php echo $status;?></span>
                    </h5>
                </div> -->
                <div class="m-2 text-left">
                    <form action="simpanabsen.php" method="post" class="mt-2">
                        <div class="form-group">
                            <input type="text" name="status" id="" value="<?php echo $status;?>" hidden><br>

                            <!-- <label for="">Nama</label> -->
                            <input class="form-control form-control-border rounded-0 " type="text"
                                value="<?php echo $namaguru;?>" name="nama" id="inputNama" hidden>
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Pilih Jadwal Hari ini</label>
                            <select class="form-select  form-control-border rounded-0"
                                aria-label="Default select example" type="text" value="" name="jadwal">
                                <?php
                        while($listjadwal = mysqli_fetch_array($datajadwal)){
                            $idjadwal = $listjadwal['id_jadwal'];
                            $mapel = $listjadwal['id_mapel'];
                            $jamke = $listjadwal['jam_ke'];
                            $waktu = $listjadwal['mulai'].' - '.$listjadwal['selesai'];
                            $kelas = $listjadwal['kelas'];
                            $durasi = $listjadwal['durasi'];

                            $idmapel = $mapel;
                            $datamapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE id='$idmapel'");
                            while($nmapel = mysqli_fetch_array($datamapel)){
                                $namamapel = $nmapel['mapel'];

                            $idkelas = $kelas;
                            $datakelas = mysqli_query($koneksi,"SELECT namakelas FROM kelas WHERE id_kelas='$idkelas'");
                            while($nkelas = mysqli_fetch_array($datakelas)){
                                $namakelas = $nkelas['namakelas'];

                        ?>
                                <option value="<?php echo $idjadwal ?>">
                                    <?php echo "$waktu :: $namamapel :: Jam ke $jamke :: di $namakelas"; }}}?></option>
                            </select>

                        </div>
                        <label for="">Koordinat Lokasi</label>
                        <input class="form-control form-control-border rounded-0 " type="text" value="" name="lokasi"
                            id="lokasi" readonly>

                        <input type="number" name="idguru" id="" value="<?php echo $idguru?>" hidden>

                        <div class=" d-grid gap-1 tb-aksi mt-5">
                            <button type="submit" class="btn btn-success tbresult" onclick="simpan()"><i
                                    class="fa fa-check mr-2"></i> Simpan</button>
                            <a href="index?s=<?php if(isset($_GET['s'])){echo $_GET['s'];}?>&role=ulangi"
                                class="btn btn-primary tbresult"><i class="fa fa-qrcode mr-2"></i>
                                Ulangi
                                Pemindaian</a>
                            <a href="index" class="btn btn-danger tbresult">
                                <i class="fa-solid fa-xmark mr-2"></i> Keluar </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <div class="modal fade" id="notlokasi" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="notlokasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-danger">
                <div class="modal-body text-center mt-5 mb-5">
                    <div class="text-center">
                        <h5>Anda sedang tidak berada di Sekolah!</h5>
                        <p>Tidak dapat melakukan absensi, Silahkan coba lagi di area sekitar sekolah atau keluar dari
                            aplikasi</p>
                    </div>
                    <br>
                    <div class="d-block gap-2">
                        <button onclick="location.reload()" type="button" class="btn btn-light">Sudah disekolah</button>
                        <!-- <button class="btn btn-light">Sudah disekolah</button> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
    var nama = document.getElementById('inputNama');
    var lokasi = document.getElementById('inputLokasi');

    function simpan() {
        // nama.disabled = false;
        lokasi.disabled = false;
    }
    </script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU"></script>
    <script>
    $(document).ready(function() {
        getLocation();
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;
        // lat = -5.7888;
        // lon = 107.677;
        koordinat = lat + ", " + lon;
        var minLot = -6.7618;
        var maxLot = -6.76215;

        var minLon = 107.2189;
        var maxLon = 107.2194;

        if (lat <= minLot && lat >= maxLot && lon >= minLon && lon <= maxLon) {
            console.log("lokasinya di sekolah");

            var formLokasi = document.getElementById("lokasi");
            formLokasi.value = koordinat;


        } else {
            console.log("lokasinya diluar sekolah");
            $("#notlokasi").modal("show");
        }
        console.log(koordinat);
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred.";
                break;
        }
    }
    </script>


</body>

<?php
}else{
        // echo '<h1>INI Muncul KETIKA kosong</h1>';

?>

<body class="bg-danger p-2">
    <section class="container qr-error " style="margin-top:100px;">
        <div class="text-center ">
            <div class="ikonresult">
                <i class="fa-solid fa-circle-xmark text-danger"></i>
            </div>
            <p style="line-height: 30px;">
                Tidak ada jadwal untuk <br>
                <b class="">
                    <?php echo $namaguru; ?>
                </b>
                <br>
                Hari ini!.
            </p>

            <!-- <p>Silahkan Isi Absen sesuai jadwal!.</p> -->
            <br>
            <div class="row  m-2">
                <div class="">
                    <div class="mb-1">
                        <a href="index#ulangi" class="btn btn-primary tbresult"><i class="fa fa-qrcode mr-2"></i>
                            Ulangi
                            Pemindaian</a>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <a href="index" class="btn btn-danger tbresult">
                            <i class="fa-solid fa-xmark mr-2"></i> Keluar </a>
                    </div>
                </div>

            </div>


        </div>
    </section>
</body>


<?php
    }   }
}else{
    ?>
<script>
window.location.replace("index#ulangi");
</script>
<?php
}
}

include 'footer.php';
?>