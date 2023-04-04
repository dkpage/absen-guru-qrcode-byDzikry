<?php
require 'config.database.php';


// [ Menampilkan Data Sekolah ] //
$datasekolah = mysqli_query($koneksi, "SELECT * FROM sekolah");
$dsekolah = mysqli_fetch_array($datasekolah);

$s_jenjang = $dsekolah['jenjang'];
$sekolah = $dsekolah['nama_sekolah'];
$alamat = $dsekolah['alamat']; 
$desa_kel = $dsekolah['desa_kel'];
$kec = $dsekolah['kec'];
$kab = $dsekolah['kab_kota'];
$prov = $dsekolah['prov'];

$websekolah = $dsekolah['web_sekolah'];
$emailsekolah = $dsekolah['email'];
$tlpsekolah = $dsekolah['tlp'];

$logo = $dsekolah['logo'];

// [ Kepala Sekolah ]
$dkepsek = mysqli_query($koneksi, "SELECT * FROM user WHERE jabatan='Kepala Sekolah'");
$kepsek = mysqli_fetch_array($dkepsek);
if(!empty($kepsek)){
    $namakepsek = $kepsek['nama'];
    $nipkepsek = $kepsek['nip'];
}else{
    $namakepsek = '';
    $nipkepsek = '';
}


// [ Bendahara ]
$dbend = mysqli_query($koneksi, "SELECT * FROM user WHERE jabatan='Bendahara'");
$bendahara = mysqli_fetch_array($dbend);
if(!empty($bendahara)){
    $namabendahara = $bendahara['nama'];
    $nipbendahara = $bendahara['nip'];
}else{
    $namabendahara = '';
    $nipbendahara = '';
}

// [ Kurikulum ]
$dkur = mysqli_query($koneksi, "SELECT * FROM user WHERE jabatan='Kurikulum'");
$kurikulum = mysqli_fetch_array($dkur);
if(!empty($kurikulum)){
    $namakurikulum = $kurikulum['nama'];
    $nipkurikulum = $kurikulum['nip'];
}else{
    $namakurikulum = '';
    $nipkurikulum = '';
}


// echo "<h1>Nama Kepseknya adalah $namakepsek dengan NIP $nipkepsek</h1>";

// [ Menampilkan Data Aplikasi ] //
$dataapp = mysqli_query($koneksi, "SELECT * FROM aplikasi");
$dapp = mysqli_fetch_array($dataapp);

$n_aplikasi = $dapp['nama_aplikasi'];
$versiapp = $dapp['versi'];
$devapp = $dapp['developer'];


// [ Konfigurasi Tanggal Format Indonesi ] //
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id-ID');
$now = new DateTime();
$tglid = strftime('%d', $now->getTimestamp());
$blnid = strftime('%B', $now->getTimestamp());
$thnid = strftime('%Y', $now->getTimestamp());
$waktuid = strftime('%H:%M', $now->getTimestamp());

// [ Konfigurasi Tanggal Format US ] //
$tgl = date('d');
$bln = date('m');
$thn = date('Y');
$waktu = date('H:i:s');

// [ Fungsi untuk mengubah angka menjadi nama bulan ] //
function  getBulan($bln){
    switch  ($bln){
        case  1:
        return  "Januari";
        break;
        case  2:
        return  "Februari";
        break;
        case  3:
        return  "Maret";
        break;
        case  4:
        return  "April";
        break;
        case  5:
        return  "Mei";
        break;
        case  6:
        return  "Juni";
        break;
        case  7:
        return  "Juli";
        break;
        case  8:
        return  "Agustus";
        break;
        case  9:
        return  "September";
        break;
        case  10:
        return  "Oktober";
        break;
        case  11:
        return  "November";
        break;
        case  12:
        return  "Desember";
        break;
    }
}

// [ Fungsi untuk mengubah nama hari menjadi bahasa Indonesia ] //
function getHari($date){
    $datetime = DateTime::createFromFormat('Y-m-d', $date);
     $day = $datetime->format('l');
    switch ($day) {
     case 'Sunday':
      $hari = 'Minggu';
      break;
     case 'Monday':
      $hari = 'Senin';
      break;
     case 'Tuesday':
      $hari = 'Selasa';
      break;
     case 'Wednesday':
      $hari = 'Rabu';
      break;
     case 'Thursday':
      $hari = 'Kamis';
      break;
     case 'Friday':
      $hari = 'Jumat';
      break;
     case 'Saturday':
      $hari = 'Sabtu';
      break;
     default:
      $hari = 'Tidak ada';
      break;
    }
    return $hari;
   }
$hariini = getHari(date('Y-m-d'));  

// [ Konfigurasi nilai mata uang jadi Rupiah ] //
function rupiah($angka){
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
    }