<?php
$title = 'Data Admin';

require 'sidebar.admin.php';
if($aksesadmin !== 'Ya'){
    ?>
<script>
location.replace("dashboard.php");
</script>
<?php
    }

$user = 'SELECT * FROM user where role<>""';
$d_user = mysqli_query($koneksi, $user);
?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="card-header ">
                        <!-- <h3 class="card-title ">Data Admin Aplikasi</h3> -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary"
                                style="width:auto; font-size:14px;font-weight:bold;" data-toggle="modal"
                                data-target="#tambahadmin">
                                <i class="fa fa-user-plus mr-2"></i> Tambah Admin
                            </button>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-reponsive" style="">
                        <table id="tabelptk" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5px">No</th>
                                    <th>Nama PTK</th>

                                    <th>Role</th>
                                    <th style="width: 150px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no     = 1;
                                    while ($ptk = mysqli_fetch_array($d_user))
                                    {?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $no?></td>
                                    <td class="align-middle"><b><?php echo $ptk['nama']?></b>
                                        <br><small><?php echo $ptk['email']?></small>
                                    </td>
                                    <td class="align-middle"><?php echo $ptk['role']?></td>
                                    <td class="text-center align-middle">
                                        <a href="hapusadmin.php?id=<?php echo $ptk['id']?>">
                                            <span class="badge bg-danger p-2">
                                                <i class="fi fi-sr-trash"></i>
                                                Hapus akses admin</span>
                                        </a>
                                    </td>
                                </tr><?php ;$no++;}?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="tambahadmin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Admin dari data PTK</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" method="post" action="">
                    <label>Pilih PTK</label>
                    <select class="form-control select2bs4 mb-2" data-placeholder="Pilih PTK" name="pilihptk"
                        style="width: 100%;">
                        <?php 
                        $user = 'SELECT * FROM user';
                        $d_user = mysqli_query($koneksi, $user);
                        while ($ptk = mysqli_fetch_array($d_user))
                        {echo '<option value="'.$ptk['id'].'"> '.$ptk['nama'].'</option>'; }?>
                    </select>
                    <label>Role</label>
                    <select class="form-control select2bs4 mb-2 " data-placeholder="Pilih Role" name="role"
                        style="width: 100%;" required>
                        <?php 
                        $role = 'SELECT * FROM role';
                        $d_role = mysqli_query($koneksi, $role);
                        while ($prole= mysqli_fetch_array($d_role))
                        {echo '<option value="'.$prole['type_role'].'"> '.$prole['type_role'].'</option>'; }?>
                    </select>


                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary"><i
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


<?php


require 'footer.admin.php';
require 'script.php';

if(isset($_POST['simpan'])){
    $id = $_POST['pilihptk'];
    $role = $_POST['role'];



    $jadikan_admin = mysqli_query($koneksi,"UPDATE user SET role='$role' WHERE id='$id'");

    if($jadikan_admin == TRUE){
        echo "<script> $('#berhasil').modal('show');
        $('#xberhasil').on('click', function(){
            location.replace('page.data.admin.php');
        })</script>";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }

}

?>

<script>
$(function() {
    $("#tabelptk").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tabelptk_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
<?php

?>

</html>