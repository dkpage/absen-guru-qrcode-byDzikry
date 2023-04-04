<?php
$title = 'Rekap Gaji';

require 'sidebar.admin.php';

if(isset($_GET['bulan'])){

    $title2 = 'Rekap Gaji '.getBulan($_GET['bulan']).' '.$_GET['tahun'];

    }




if($aksesgaji !== 'Ya'){
    ?>
<script>
location.replace("dashboard.php");
</script>
<?php
    }

$opsi = ".opsi{display:none;}";
?>
<style>

</style>
<section class="container ml-2">
    <div class="container p-2 bg-dark row">
        <form action="" method="GET" class="col-md-10" id="pilih">
            <!-- <label for="">Lihat Berdasarkan : </label> -->
            <div class="row">

                <div class="col-sm-2 m-1">
                    <!-- <select class="form-control " name="tahun">
                        <option selected="selected">Tahun</option> -->
                    <select name="tahun" class="form-control" required="required" id="thn">
                        <option selected="selected" value="<?php if(isset($_GET['tahun'])){echo $_GET['tahun'];}?>">
                            <?php if(isset($_GET['tahun'])){echo $_GET['tahun'];}else{echo "Tahun";}?></option>"
                        <?php
                        $now=date('Y');
                        for ($a=2012;$a<=$now;$a++)
                        {
                            echo "<option value='$a'>$a</option>";
                        }
                        echo "";
                        ?>
                    </select>
                </div>
                <div class="col-sm-2 m-1">
                    <select class="form-control" name="bulan" required="required">
                        <option selected="selected" value="<?php if(isset($_GET['bulan'])){echo $_GET['bulan'];}?>"
                            id="bln">
                            <?php if(isset($_GET['bulan'])){echo getBulan($_GET['bulan']);}else{echo "Bulan";}?>
                        </option>
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
                <button type="submit" name="lihat" class="btn btn-primary  mt-1 mb-1" style="margin-left:11px;"><i
                        class=" fa fa-eye"></i>
                    Lihat</button>
            </div>
        </form>
        <div class="col-md-2">
            <a href="#" class="btn btn-light m-1 d-grid">
                <i class="fa-solid fa-envelope mr-2"></i>Slip Gaji
            </a>
        </div>
    </div>

</section>
<div class="col-12">
    <div class="container" id="tabelRekapan">
        <div class="card-header">
            <h3 class="mb-2 buka card-title" id="title2">Rekap Gaji PTK <?= $sekolah?>

                <?php
                    if(isset($_GET['lihat'])){
                        echo " - ";
                    if(!empty($_GET['tanggal'])){
                    echo $_GET['tanggal'].' ';
                    }else{
                    echo '';
                    }
                    if(!empty($_GET['bulan'])){

                    echo ' '.getBulan($_GET['bulan']).' ';

                    }else{
                    echo '';
                    }
                    if(!empty($_GET['tahun'])){
                    echo ' '.$_GET['tahun'].'';
                    }
                    }
                    ?>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class=" table-responsive p-2" style="">
            <table id="tabelrekap" class="table table-bordered table-striped tabel-data">
                <thead>
                    <tr>
                        <th class=" text-center">No</th>
                        <th>Nama PTK</th>
                        <th class="opsi">Jabatan</th>
                        <th>Mata Pelajaran</th>
                        <th>Jumlah JP</th>
                        <th>Invaler</th>
                        <th>Gaji Mengajar</th>
                        <th class="opsi">Gaji Jabatan</th>
                        <th class="opsi">Jumlah Gaji</th>

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
                       
                        // MENDAPATKAN DATA PTK
                        $dataptk = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama");
                        $no=1;
                        
                        while($ptk = mysqli_fetch_array($dataptk)){
                            $idptk = $ptk['id'];
                            $namaptk = $ptk['nama'];
                            $nipptk = $ptk['nip'];
                            $jabptk = $ptk['jabatan'];

                            // MENGAMBIL DATA MAPEL SESUAI ID GURU
                            $mapel = mysqli_query($koneksi, "SELECT mapel FROM mapel WHERE id_guru='$idptk'");

                            // MENDAPATKAN JUMLAH JAM MENGAJAR SESUAI NAMA PTK
                            $rekap = mysqli_query($koneksi, "SELECT durasi FROM rekap WHERE id_guru='$idptk' AND bln='$bulan' AND thn='$tahun'") ;
                                $total = 0;
                                while($rrekap = mysqli_fetch_array($rekap)){
                                    $total += $rrekap['durasi'];
                                }
                                
                                $jmljp = $total;

                            // MENGAMBIL DATA GAJI GURU MAPEL
                            $gajiguru = mysqli_query($koneksi, "SELECT gaji FROM jabatan WHERE tipe_jabatan='Guru Mapel' ");
                            $gguru = mysqli_fetch_array($gajiguru);
                            $gajingajar = $gguru['gaji'];

                            // MENGHITUNG BESAR GAJI NGAJAR
                            $gajimengajar = $jmljp*$gajingajar;
                            
                            // MANGAMBIL DATA GAJI JABATAN SESUAI JABATAN PTK
                            if($jabptk !== '-'){
                                // $exj = explode(" / ",$jabptk);
                                
                                // $jmljb = count($exj);
                                // for($i=0; $i < $jmljb ; $i++);//{
                                //     $tj = $exj[$i];
                                    
                                //     $djabatan = mysqli_query($koneksi, "SELECT gaji FROM jabatan WHERE tipe_jabatan='$tj' ");
                                //     while($rjab = mysqli_fetch_array($djabatan)){
                                //         $gajijabatan = array_sum($rjab);
                                //    }
                                    
                                // }
                            $gajijabatan = 0;

                            }else{
                                $gajijabatan = 0;
                            }?>
                        <td><?php echo $no ;?></td>
                        <td class="namaptk"><?php echo $namaptk;?>
                        </td>
                        <td class="opsi"><?php echo $jabptk; ?></td>
                        <td>
                            <?php 
                        // PENGULANGAN UNTUK DATA MAPEL
                        while($rmapel = mysqli_fetch_array($mapel)){
                        echo '- '.$rmapel['mapel'].' <br>';
                        };?>
                        </td>
                        <td><?php echo $jmljp;?></td>
                        <td><?php echo $jmljp;?></td>
                        <td><?php echo rupiah($gajimengajar);?></td>
                        <td class="opsi"><?php // echo rupiah($gajijabatan);?></td>
                        <td class="opsi"><?php echo rupiah($gajimengajar+$gajijabatan);?></td>
                    </tr>

                    <?php $no++; } }else{ 
                        // MENDAPATKAN DATA PTK
                        $dataptk = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama");
                        $no=1;
                        
                        while($ptk = mysqli_fetch_array($dataptk)){
                            $idptk = $ptk['id'];
                            $namaptk = $ptk['nama'];
                            $nipptk = $ptk['nip'];
                            $jabptk = $ptk['jabatan'];

                            // MENGAMBIL DATA MAPEL SESUAI ID GURU
                            $mapel = mysqli_query($koneksi, "SELECT mapel FROM mapel WHERE id_guru='$idptk'");

                            // MENDAPATKAN JUMLAH JAM MENGAJAR SESUAI NAMA PTK
                            $rekap = mysqli_query($koneksi, "SELECT durasi FROM rekap WHERE id_guru='$idptk'") ;
                                $total = 0;
                                while($rrekap = mysqli_fetch_array($rekap)){
                                    $total += $rrekap['durasi'];
                                }
                                $jmljp = $total;
                                
                           
                            
                            // MENGAMBIL DATA GAJI GURU MAPEL
                            $gajiguru = mysqli_query($koneksi, "SELECT gaji FROM jabatan ");
                            $gguru = mysqli_fetch_array($gajiguru);
                            $gajingajar = $gguru['gaji'];

                            // MENGHITUNG BESAR GAJI NGAJAR
                            $gajimengajar = $jmljp*$gajingajar;
                            
                            // MANGAMBIL DATA GAJI JABATAN SESUAI JABATAN PTK
                            // if(!empty($jabptk)){
                            //     $djabatan = mysqli_query($koneksi, "SELECT gaji FROM jabatan WHERE tipe_jabatan='$jabptk' ");
                            //     $gjab = mysqli_fetch_array($djabatan);
                            //     $gajijabatan = $gjab['gaji'];
                            // }else{
                            //     $gajijabatan = 0;
                            // }
                            $gajijabatan =0;
                            ?>
                    <td><?php echo $no ;?></td>
                    <td class="namaptk"><?php echo $namaptk;?>
                    </td>
                    <td class="opsi"><?php echo $jabptk;?></td>
                    <td>
                        <?php 
                        // PENGULANGAN UNTUK DATA MAPEL
                        while($rmapel = mysqli_fetch_array($mapel)){
                        echo '- '.$rmapel['mapel'].' <br>';
                        };?>
                    </td>
                    <td><?php echo $jmljp;?></td>
                    <td><?php echo $jmljp;?></td>
                    <td><?php echo rupiah($gajimengajar);?></td>
                    <td class="opsi"></td>
                    <td class="opsi"><?php echo rupiah($gajimengajar+$gajijabatan);?></td>
                    </tr>

                    <?php ;$no++;}}?>


                </tbody>

            </table>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="modal fade" tabindex="-1" id="note">
    <div class="modal-dialog modal-dialog-centered modal-sm ">
        <div class="modal-content p-3 text-center">
            <div class="modal-body">
                <p><b>Note :</b> <br>Untuk gaji Jabatan akan muncul pada rekapan perbulan dan hanya 1 jabatan yang di
                    input di
                    aplikasi saja yang akan di hitung.
                </p>
            </div>
            <div class="text-center mb-2">
                <button type="button" class="mr-2 btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
        </div>
    </div>
</div>


<?php
require 'footer.admin.php';
require 'script.php';
?>


<script>
$(document).ready(function() {
    if (!(window.location.href.indexOf("&bulan=") > -1)) {
        $("#note").modal("show");
    }

    if (window.location.href.indexOf("&bulan=") > -1) {
        $("title").text("<?php echo $title2;?> - <?php echo $n_aplikasi;?> - <?php echo $sekolah;?>");
    }

    // if (window.location.href.indexOf("#dt") > -1) {
    //     $(".tabel-data").attr("id", "tabelrekap");
    // }
})
</script>

<script>
$(function() {
    $("#tabelrekap").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#tabelrekap_wrapper .col-md-6:eq(0)');

});
</script>


</html>