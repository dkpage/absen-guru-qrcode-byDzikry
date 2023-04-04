<?php
require 'header.admin.php';

$path = $_SERVER['REQUEST_URI'];
// echo "<h1>".$path."</h1><br>";
$ex = explode("/", $path);
$urlfile = $ex[3];
$uget = explode("?",$urlfile);
if(!empty($uget[1])){
    $urlget = '?'.$uget[1];
}else{
    $urlget = '';
}


if($urlfile == 'dashboard.php'.$urlget){
    $dashboard = 'active';
}elseif($urlfile == 'page.data.admin.php'.$urlget){
    $pageadmin = 'active';
}elseif($urlfile == 'page.data.ptk.php'.$urlget){
    $pageptk = 'active';
}elseif($urlfile == 'page.data.jadwal.php'.$urlget){
    $pagejadwal = 'active';
}elseif($urlfile == 'page.rekap.php'.$urlget){
    $pagerekap = 'active';
}elseif($urlfile == 'page.cetak.kartu.php'.$urlget){
    $pageidcard = 'active';
}//elseif($urlfile == 'page.cetak.gaji.php'.$urlget){
   // $pagegaji = 'active';
//}elseif($urlfile == 'page.lokasi.php'.$urlget){
  //  $pagelokasi = 'active';
//}
elseif($urlfile == 'page.cetak.gaji.php'.$urlget){
    $pagecetakgaji = 'active';
}elseif($urlfile == 'page.profile.php'.$urlget){
    $pageprofil = 'active';
}elseif($urlfile == 'page.pengaturan.php'.$urlget){
    $pageset = 'active';
}else{
    $dashboard = '';
    $pageadmin = '';
    $pageptk = '';
    $pagejadwal = '';
    $pagegaji = '';
    $pagerekap = '';
    $pageidcard = '';
    $pagelokasi = '';
    $pagecetakgaji = '';
    $pageprofil = '';
    $pageset = '';
}

if($urlfile == 'page.data.admin.php'.$urlget OR $urlfile ==  'page.data.ptk.php'.$urlget OR $urlfile =='page.data.jadwal.php'.$urlget OR $urlfile =='page.data.gaji.php'.$urlget){
    $menudata = 'active';
    $menudataop = 'menu-open';
}elseif($urlfile == 'page.cetak.kartu.php'.$urlget OR $urlfile == 'page.cetak.gaji.php'.$urlget OR $urlfile == 'page.lokasi.php'.$urlget ){
    $menucetak = 'active';
    $menucetakop = 'menu-open';
}else{
    $menudata = '';
    $menudataop = '';
    $menucetak = '';
    $menucetakop = '';
}

 
$dataakses = mysqli_query($koneksi,"SELECT * FROM role WHERE type_role='$roleuser'");
if($roleuser !== ''){
    $akses = mysqli_fetch_array($dataakses);
    $aksesdashboard = $akses['dashboard'];
    $aksesadmin = $akses['admin'];
    $aksesptk = $akses['ptk'];
    $aksesjadwal = $akses['jadwal'];
    $aksesgaji = $akses['gaji'];
    $aksesrekap = $akses['rekap'];
    $aksesidcard = $akses['idcard'];
    $akseslokasi = $akses['lokasi'];
    $aksesprofil = $akses['profil'];
    $aksespengaturan = $akses['pengaturan'];
}

// echo '<h1>'.$urlfile.'</h1>';
?>
<?php if($roleuser !== ''){?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link text-center">
        <img src="dist/img/<?= $logo?>" alt="Logo SMP Plus Albidayah" class="gambarlogo" id="sidelogo">
    </a>
    <script>
    var togle = document.getElementById('togle');
    var sidelogo = document.getElementById("sidelogo");

    var klik1 = true;
    togle.onclick = function() {
        if (klik1) {
            sidelogo.className = "gambarlogokecil";
            klik1 = false;
        } else {
            sidelogo.className = "gambarlogo";
            klik1 = true;
        }
    }
    </script>
    <!-- Sidebar -->
    <div class="d-flex " id="wrapper">
        <div class="sidebar vh-100" id="sidebar-wrapper">

            <!-- Sidebar Menu -->


            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                    <?php if($aksesdashboard == 'Ya'){?>

                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link <?php echo $dashboard; ?>">

                            <i class="nav-icon fa-solid fa-square-poll-horizontal"></i>
                            <p>
                                Dashboard

                            </p>
                        </a>

                    </li>

                    <?php };?>
                    <?php if($aksesadmin == 'Ya' OR $aksesptk == 'Ya' OR $aksesjadwal == 'Ya'){?>
                    <li class="nav-item <?php echo $menudataop;?>">
                        <a href="#" class="nav-link <?php echo $menudata; ?>">

                            <i class="nav-icon fa-solid fa-database"></i>
                            <p>
                                Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <?php if($aksesadmin == 'Ya'){?>
                            <li class="nav-item">
                                <a href="page.data.admin.php" class="nav-link <?php echo $pageadmin; ?>">

                                    <i class="nav-icon fa-solid fa-user-gear"></i>
                                    <p>Data Admin</p>
                                </a>
                            </li>
                            <?php }?>
                            <?php if($aksesptk == 'Ya'){?>
                            <li class="nav-item">
                                <a href="page.data.ptk.php" class="nav-link <?php echo $pageptk; ?>">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Data PTK</p>
                                </a>

                            </li>
                            <?php }?>
                            <?php if($aksesjadwal == 'Ya'){?>
                            <li class="nav-item">
                                <a href="page.data.jadwal.php" class="nav-link <?php echo $pagejadwal; ?>">
                                    <i class="nav-icon fa-solid fa-calendar-days"></i>
                                    <p>Jadwal Pelajaran</p>
                                </a>
                            </li>
                            <?php }?>
                            <!-- <li class="nav-item">
                                <a href="page.data.gaji.php" class="nav-link <?php// echo $pagegaji; ?>">
                                    <i class="fa fa-money nav-icon"></i>
                                    <p>Gaji</p>
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    <?php }?>
                    <?php if($aksesrekap == 'Ya'){?>
                    <li class="nav-item">
                        <a href="page.rekap.php" class="nav-link <?php echo $pagerekap; ?>">

                            <i class="nav-icon fa-solid fa-list-check"></i>
                            <p>
                                Rekap Kehadiran

                            </p>
                        </a>

                    </li>
                    <?php }?>
                    <?php if($aksesidcard == 'Ya' OR $aksesgaji == 'Ya'){?>
                    <li class="nav-item <?php echo $menucetakop;?>">
                        <a href="#" class="nav-link <?php echo $menucetak;?>">
                            <i class="nav-icon fas fa-print"></i>
                            <p>
                                Cetak
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <?php if($aksesidcard == 'Ya'){?>
                            <li class="nav-item">
                                <a href="page.cetak.kartu.php" class="nav-link <?php echo $pageidcard; ?>">
                                    <i class="fas fa-id-card nav-icon"></i>
                                    <p>Kartu Guru</p>
                                </a>
                            </li>
                            <?php }?>
                            <!-- <li class="nav-item">
                                <a href="page.lokasi.php" class="nav-link <?php //echo $pagelokasi; ?>">
                                    <i class="fas fa-street-view nav-icon"></i>
                                    <p>Lokasi</p>
                                </a>
                            </li> -->
                            <?php if($aksesgaji == 'Ya'){?>
                            <li class="nav-item">
                                <a href="page.cetak.gaji.php" class="nav-link <?php echo $pagecetakgaji; ?>">
                                    <i class="fa-solid fa-money-bills nav-icon"></i>
                                    <p>Rekap Gaji</p>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php }?>
                    <?php if($aksesprofil == 'Ya'){?>
                    <li class="nav-item">
                        <a href="page.profile.php" class="nav-link <?php echo $pageprofil; ?>">

                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Profil
                            </p>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($aksespengaturan == 'Ya'){?>
                    <li class="nav-item">
                        <a href="page.pengaturan.php" class="nav-link <?php echo $pageset; ?>" id="menuPengaturan">

                            <i class="nav-icon fa fa-gears"></i>
                            <p>
                                Pengaturan
                            </p>
                        </a>
                    </li>
                    <?php }?>
                    <!-- <li class="nav-item">
            <a href="logout.php" class="nav-link">

                <i class="nav-icon fa fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li> -->


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            <div class="text-muted ml-3 sidebarcopy d-block d-sm-none">
                <small clas="">Copyright &copy; <?= $thnid?><br> <a href="<?php echo $websekolah;?>"><?=$sekolah?></a>.
                </small>
            </div>

        </div>



    </div>


    <!-- /.sidebar -->
</aside>
<?php }?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-white">
    <!-- Content Header (Page header) -->
    <div class=" content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 "><b><?=$title?></b></h1>
                    <p><?= $n_aplikasi,' ',$sekolah?></p>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->