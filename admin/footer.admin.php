</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<style>
.mobile-menu i {
    font-size: 22pt;
}
</style>
<div class="d-flex justify-content-between align-items-center d-sm-none fixed-bottom bg-light mobile-menu shadow-lg p-2 rounded-0"
    id="mobileMenu" style="height:70px">
    <a class="nav-link  text-primary d-grid text-center" data-widget="pushmenu" href="#" role="button" id="togle">
        <i class="fa fa-bars"></i><br><span>Menu</span>
    </a>
    <a href="../index" class="nav-link text-primary d-grid text-center">
        <i class="fa fa-qrcode primary"></i><br><span class="primary">Isi Absen</span>
    </a>

    <a href="#" class="nav-link d-grid text-center" id="dropdownUser2" data-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-user"></i><br><span>Akun</span>
    </a>
    <ul class="dropdown-menu text-small shadow pt-0" aria-labelledby="dropdownUser2">
        <li>
            <span class="dropdown-item bg-primary p-2 mt-0">
                <strong><?php echo $namauser;?></strong><br><span
                    class="badge badge-warning ml-1"><?php echo $roleuser;?></span>
            </span>

        </li>
        <li><a class="dropdown-item" href="page.profile.php">Profil</a></li>
        <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
    </ul>
</div>




<script>
function scan() {
    window.location.replace('../ambilabsen.php');
}
</script>

<footer class="main-footer text-disabled fixed-bottom d-none d-sm-block" id="footer">
    <small>Copyright &copy; <?= $thnid?> <a href="<?php echo $websekolah;?>"><?=$sekolah?></a>.
    </small>
</footer>


<div class="modal fade" id="berhasil">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-light rounded-2">
            <span class="text-center p-2">
                <i class="fa-solid fa-circle-check mr-3 text-success"></i>
                Berhasil
            </span>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="gagal" style="background:none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-light rounded-2">
            <span class="text-center p-2">
                <i class="fa-solid fa-circle-xmark mr-3 text-danger"></i>
                Gagal, Terjadi Kesalahan
            </span>



        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->