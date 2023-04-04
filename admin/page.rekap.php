<?php
$title = 'Rekap Kehadiran';

require 'sidebar.admin.php';
if($aksesrekap !== 'Ya'){
    ?>
<script>
location.replace("dashboard.php");
</script>
<?php
    }

?>
<section class="container ml-2">
    <div class="container p-2 bg-dark row">
        <form action="" method="GET" class="col-md-10" id="pilih">
            <!-- <label for="">Lihat Berdasarkan : </label> -->
            <div class="row">

                <div class="col-sm-2 m-1">
                    <!-- <select class="form-control " name="tahun">
                        <option selected="selected">Tahun</option> -->
                    <select name="tahun" class="form-control" required="required" id="thn">
                        <?php 
                    if(isset($_GET['lihat'])){ ?>
                        <option value="">Tahun</option>
                        <option selected="selected" value="<?php echo $_GET['tahun'] ?>"><?php echo $_GET['tahun'] ?>
                        </option>
                        <?php }else{ ?>
                        <option selected="selected" value="">Tahun</option>
                        <?php } ?>

                        <?php
                        $now=date('Y');
                        
                        for ($a=2012;$a<=$now;$a++)
                        {
                            echo "<option value='$a'>$a</option>";
                        }
                        echo "</select>";
                        ?>
                </div>
                <div class="col-sm-2 m-1">
                    <select class="form-control" name="bulan" required="required">
                        <?php 
                            if(isset($_GET['bulan'])){ ?>
                        <option value="">Bulan</option>
                        <option selected="selected" value="<?php echo $_GET['bulan'] ?>">
                            <?php echo getBulan($_GET['bulan']) ?>
                        </option>
                        <?php }else{ ?>
                        <option selected="selected" value="">Bulan</option>
                        <?php } ?>
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
                <div class="col-sm-2 m-1">
                    <select class="form-control" name="tanggal">
                        <?php 
                    if(isset($_GET['lihat'])){ ?>
                        <option value="">Tanggal</option>
                        <option selected="selected" value="<?php echo $_GET['tanggal'] ?>">
                            <?php echo $_GET['tanggal'] ?>
                        </option>
                        <?php }else{ ?>
                        <option selected="selected" value="">Tanggal</option>
                        <?php } ?>
                        <?php
                            for($a=1; $a<=31; $a+=1){
                                echo"<option value='$a'> $a </option>";
                            }
                            ?>
                    </select>
                </div>

                <button type="submit" name="lihat" class="btn btn-primary  mt-1 mb-1" style="margin-left:11px;"><i
                        class=" fa fa-eye"></i>
                    Lihat</button>
            </div>
        </form>
        <div class="col-md-2">
            <!-- <button class="btn btn-light m-1 d-grid" onclick="cetakRekapan()">
                <i class="fa-solid fa-print mr-2"></i>Cetak / PDF
            </button> -->
        </div>
    </div>

</section>
<div class="col-12">
    <div class="container" id="tabelRekapan">
        <div class="card-header">
            <h3 class="mb-2 buka card-title" id="title2">Rekap Keahadiran Guru <?=$sekolah?>
                <?php
                    if(isset($_GET['lihat'])){
                        echo "";
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
            <table id="tabelrekap" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Hari, Tanggal</th>
                        <!-- <th>Tanggal Absen</th> -->
                        <th>Nama PTK</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Jam ke</th>
                        <th>Durasi</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>


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
                            $rekap = "SELECT * FROM rekap WHERE thn=$tahun and bln=$bulan $pilihan2 ORDER BY tgl" ;
                            $d_rekap = mysqli_query($koneksi, $rekap);
                            $no     = 1;
                            while ($r_rekap = mysqli_fetch_array($d_rekap))
                            {
                                $status = $r_rekap['status_hadir'];
                                if($status == 'reguler'){
                                    $color_class = '';
                                    $spanclass = 'badge badge-success';
                                }elseif($status == 'invaler'){
                                    $color_class = 'bg-secondary';
                                    $spanclass = 'badge badge-warning';
                                }
                                ?>
                    <tr class="<?php echo $color_class;?>">
                        <td class="text-center"><?php echo $no;?></td>
                        <td><?php echo $r_rekap['hari'].', '.$r_rekap['tgl'].'-'.$r_rekap['bln'].'-'.$r_rekap['thn'];?>
                        </td>

                        <!-- <td><?php echo $r_rekap['timestamp'];?></td> -->
                        <td><?php echo $r_rekap['nama'];?></td>
                        <td><?php echo $r_rekap['mapel'];?></td>
                        <td><?php echo $r_rekap['kelas'];?></td>
                        <td><?php echo $r_rekap['jam_ke'];?></td>
                        <td><?php echo $r_rekap['durasi'];?> JP</td>
                        <td><span class="<?php echo $spanclass;?>"><?php echo $status;?></span></td>
                    </tr><?php ;$no++;}}else{?>
                    <?php $rekap = "SELECT * FROM rekap ";
                            $d_rekap = mysqli_query($koneksi, $rekap);
                            $no     = 1;
                            while ($r_rekap = mysqli_fetch_array($d_rekap))
                            {
                        $status = $r_rekap['status_hadir'];
                        if($status == 'reguler'){
                            $color_class = '';
                            $spanclass = 'badge badge-success';
                        }elseif($status == 'invaler'){
                            $color_class = 'bg-secondary';
                            $spanclass = 'badge badge-warning';
                        }
                        ?>
                    <tr class="<?php echo $color_class;?>">
                        <td class="text-center"><?php echo $no;?></td>
                        <td><?php echo $r_rekap['hari'].', '.$r_rekap['tgl'].'-'.$r_rekap['bln'].'-'.$r_rekap['thn'];?>

                        </td>
                        <!-- <td><?php echo $r_rekap['timestamp'];?></td> -->
                        <td><?php echo $r_rekap['nama'];?></td>
                        <td><?php echo $r_rekap['mapel'];?></td>
                        <td><?php echo $r_rekap['kelas'];?></td>
                        <td><?php echo $r_rekap['jam_ke'];?></td>
                        <td><?php echo $r_rekap['durasi'];?> JP</td>
                        <td><span class="<?php echo $spanclass;?>"><?php echo $status;?></span></td>
                    </tr><?php ;$no++;}}?>


                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<script>
var judul = document.getElementById("title2").innerHTML;

$(document).ready(function() {
    $("title").html(judul);
})
</script>




<?php
require 'footer.admin.php';
require 'script.php';
?>
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