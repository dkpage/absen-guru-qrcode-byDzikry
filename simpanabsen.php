<?php
$title = 'Simpan Absen';
require 'header.php';

date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id-ID');

$now = new DateTime();
// id berarti format Indonesia
$hariid = $hariini;
$tglid = strftime('%d', $now->getTimestamp());
$blnid = strftime('%B', $now->getTimestamp());
$thnid = strftime('%Y', $now->getTimestamp());
$waktuid = strftime('%H:%M', $now->getTimestamp());

$tgl = date('d');
$bln = date('m');
$thn = date('Y');
$jam = date('H:i:s');




if(isset($_POST['nama'])){
    $status = $_POST['status'];
    $idjadwal = $_POST['jadwal']; 
    $namaguru = $_POST['nama'];
    $idguru =  $_POST['idguru'];
    $lokasi = $_POST['lokasi'];
    $timestamp = "$tgl/$bln/$thn $waktu";
    // echo $idjadwal.'<br>'.$nama.'<br>'.$lokasi.'<br>';

    $datajadwal = mysqli_query($koneksi, "SELECT * FROM jadwal where id_jadwal='$idjadwal'");
    $arrjadwal = mysqli_fetch_array($datajadwal);
    $idmapel = $arrjadwal['id_mapel'];
    $idkelas = $arrjadwal['kelas'];
    $jamke = $arrjadwal['jam_ke'];
    $waktu = $arrjadwal['mulai'].' - '.$arrjadwal['selesai'];
    $durasi = $arrjadwal['durasi'];

    $idmapel = $idmapel;
    $datamapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE id='$idmapel'");
    while($nmapel = mysqli_fetch_array($datamapel)){
        $mapel = $nmapel['mapel'];

    $idkelas = $idkelas;
    $datakelas = mysqli_query($koneksi,"SELECT namakelas FROM kelas WHERE id_kelas='$idkelas'");
    while($nkelas = mysqli_fetch_array($datakelas)){
        $kelas = $nkelas['namakelas'];

    // echo $mapel.'<br>'.$kelas.'<br>'.$jamke.'<br>'.$waktu.'<br>'.$durasi;

    $datarekap = mysqli_query($koneksi, "SELECT * FROM rekap WHERE hari='$hariid' AND tgl='$tglid' AND bln='$bln' AND thn='$thnid' AND mapel='$mapel' AND kelas='$kelas' AND jam_ke='$jamke'");
    $arrrekap = mysqli_fetch_array($datarekap);
    if(empty($arrrekap)){
        // echo '<h1>INI MUNCUL KETIKA ABSEN BISA DIREKAP</h1>';

        $rekap = mysqli_query($koneksi, "INSERT INTO rekap (timestamp, thn, bln, tgl, hari, nama, mapel, kelas, jam_ke, waktu, durasi, id_guru, status_hadir, lokasi) VALUES ('$timestamp', '$thnid', '$bln', '$tglid', '$hariid', '$namaguru', '$mapel', '$kelas', '$jamke', '$waktu', '$durasi', '$idguru', '$status', '$lokasi' )");
    
        if($rekap == TRUE){
            // echo 'DATA BERHASIL DISIMPAN';

    ?>

<body class="bg-success p-2">
    <section class="container qr-error " style="margin-top:100px;">
        <div class="text-center ">
            <div class="ikonresult">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h3>Berhasil!</h3><br>
            <p>Absen hari ini Mata Pelajaran
                <b><?php echo $mapel;?> </b>
                di <b><?php echo $kelas;?> </b>
                jam ke <b><?php echo $jamke;?> </b>
                Telah tersimpan <br>
                Terimakasih.

            </p>
            <br>
            <div class=" ">
                <div class=" mb-1">
                    <a href="index" class="btn btn-light"><i class="fa fa-check mr-2"></i> Selesai</a>
                </div>
            </div>

        </div>
    </section>
    <script>
    // const timeout = setTimeout(selesai, 1000);

    // function selesai() {
    //     location.replace('halamanakhir.php');
    // }
    </script>
</body>
<?php
        }
            
    }else{
 // echo '<h1>INI MUNCUL KETIKA ABSEN TIDAK BISA DIREKAP KARENA SUDAH</h1>';

?>

<body class="bg-danger p-2">
    <section class="container qr-error " style="margin-top:80px;">
        <div class="text-center ">
            <div class="ikonresult">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h3>Gagal!</h3>
            <p>Anda sudah absen hari ini untuk Mata Pelajaran
                <b><?php echo $mapel;?> </b>
                di <b><?php echo $kelas;?> </b>
                jam ke <b><?php echo $jamke;?> </b><br>
                Silahkan lakukan absen di lain hari!

            </p>
            <br>
            <br>

            <div class=" ">
                <div class=" mb-1">
                    <a href="index" class="btn btn-light"><i class="fa fa-xmark mr-2"></i> Keluar</a>
                </div>
            </div>

        </div>
    </section>
</body>
<?php
    }}}

}

include 'footer.php';
?>