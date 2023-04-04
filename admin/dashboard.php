<?php
$title = 'Dashboard';
require 'sidebar.admin.php';

?>


<section class="content">

    <div class="container">
        <!-- <img src="dist/img/cover.jpg" alt="" width="100%"> -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <?php 
                        $dataptk = mysqli_query($koneksi, "SELECT * FROM user");
                        $jumlahuser = mysqli_num_rows($dataptk);
                        ?>
                        <h3><?php echo $jumlahuser; ?></h3>

                        <p>PTK</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <a href="page.data.ptk.php" class="small-box-footer">Lihat Data <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php 
                        $datamp = mysqli_query($koneksi, "SELECT * FROM mapel");
                        $jumlahmp = mysqli_num_rows($datamp);
                        ?>
                        <h3><?php echo $jumlahmp?></h3>

                        <p>Mata Pelajaran</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <a href="page.edit.mapel.php" class="small-box-footer">Lihat Mapel <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <?php 
                        $dataadmin = mysqli_query($koneksi, "SELECT * FROM user WHERE role!=''");
                        $jumlahadmin = mysqli_num_rows($dataadmin);
                        ?>
                        <h3><?php echo $jumlahadmin;?></h3>

                        <p>Admin Aplikasi</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <a href="page.data.admin.php" class="small-box-footer">Lihat Data <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <?php 
                        $datarek = mysqli_query($koneksi, "SELECT * FROM rekap");
                        $jumlahrekap = mysqli_num_rows($datarek);
                        ?>
                        <h3><?php echo $jumlahrekap?></h3>

                        <p>Total Absen</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">Lihat Rekapan <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Hari ini</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-2">
                        <?php 
                $datajadwal = mysqli_query($koneksi, "SELECT * FROM jadwal where hari='$hariini' ORDER BY jam_ke");
                if(mysqli_num_rows($datajadwal) !== 0){
                    $i=1;
                    while($jadwal = mysqli_fetch_array($datajadwal)){
                        $idguru = $jadwal['id_guru'];
                        $waktu = $jadwal['mulai'].' - '.$jadwal['selesai'];
                        $idmapel = $jadwal['id_mapel'];
                        $jamke = $jadwal['jam_ke'];
                        $idkelas = $jadwal['kelas'];


                        $dataguru = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$idguru'");
                        $guru = mysqli_fetch_array($dataguru);
                        $namaguru = $guru['nama'];
                        $fotoguru = $guru['foto'];

                        $idmapel = $idmapel;
                        $datamapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE id='$idmapel'");
                        $nmapel = mysqli_fetch_array($datamapel);
                        $mapel = $nmapel['mapel'];

                        $idkelas = $idkelas;
                        $datakelas = mysqli_query($koneksi,"SELECT namakelas FROM kelas WHERE id_kelas='$idkelas'");
                        $nkelas = mysqli_fetch_array($datakelas);
                        $kelas = $nkelas['namakelas'];
                        
                ?>
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                <div class="product-img img-size-50 rounded-circle"
                                    style="background-image:url('dist/img/foto-user/<?php if(!empty($fotoguru)){echo $fotoguru;}else{echo "blank.jpg";} ?>'); height:50px; width:50px; background-size:cover; background-position:top;">

                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"><?php echo $namaguru?>
                                        <span class="badge badge-warning float-right"> <i class="fa fa-clock"></i>
                                            <?php echo $waktu?></span></a>
                                    <span class="product-description text-wrap">
                                        <b><?php echo $mapel?></b> :: <?php echo $kelas?> :: jam ke
                                        <?php echo $jamke?>
                                    </span>
                                </div>
                            </li>

                        </ul>
                        <?php $i++; } } ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="page.data.jadwal.php" class="uppercase">Lihat Semua Jadwal</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Absen Hari Ini</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-2">
                        <?php 
                $datarekap = mysqli_query($koneksi, "SELECT * FROM rekap where thn='$thnid' AND bln='$bln' AND tgl='$tglid'");
                // echo $thnid.$bln.$tglid;
                if(mysqli_num_rows($datarekap) !== 0){
                    $i=1;
                    while($rekap = mysqli_fetch_array($datarekap)){
                    $nama = $rekap['nama'];
                    $kelas = $rekap['kelas'];
                    $mapel = $rekap['mapel'];
                    $jamke = $rekap['jam_ke'];
                    $timestamp = $rekap['timestamp'];
                    $durasi = $rekap['durasi'];
                    $lokasi = $rekap['lokasi'];


                        $dataguru = mysqli_query($koneksi, "SELECT * FROM user WHERE nama='$nama'");
                        $guru = mysqli_fetch_array($dataguru);
                        $namaguru = $guru['nama'];
                        $fotoguru = $guru['foto'];
                        
                ?>
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                <div class="product-img img-size-50 rounded-circle"
                                    style="background-image:url('dist/img/foto-user/<?php if(!empty($fotoguru)){echo $fotoguru;}else{echo "blank.jpg";} ?>'); height:50px; width:50px; background-size:cover; background-position:top;">

                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title"><?php echo $namaguru?>
                                        <span class="badge badge-success float-right"> <i class="fa fa-clock"></i>
                                            <?php echo $timestamp?></span></a>
                                    <span class="product-description text-wrap">
                                        <b><?php echo $mapel?></b> :: <?php echo $kelas?> :: jam ke
                                        <?php echo $jamke?>
                                    </span>
                                </div>
                            </li>

                        </ul>
                        <?php $i++; } } ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="page.rekap.php" class="uppercase">Lihat Semua Rekapan</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>
</section>


<?php
require 'footer.admin.php';
require 'script.php';
?>

</html>