<?php
$title = 'Mata Pelajaran';

require 'sidebar.admin.php';

$mapel = 'SELECT * FROM mapel ORDER BY mapel';
$list_mapel = mysqli_query($koneksi, $mapel);
$user = 'SELECT * FROM user ORDER BY nama';
$d_user = mysqli_query($koneksi, $user);

?>

<section class="content mb-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="">

                    <div class="card-body p-0 table-reponsive">
                        <table id="tabelmapel" class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Inisial</th>
                                    <th>Nama Mapel</th>
                                    <th>Guru</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                    
                                    while ($r_mapel= mysqli_fetch_array($list_mapel))
                                    {?>
                                <tr>
                                    <td><?php echo $r_mapel['inisial'];?></td>
                                    <td><?php echo $r_mapel['mapel'];?></td>
                                    <td><?php 
                                    $id_g = $r_mapel['id_guru'];
                                    if(!empty($id_g)){
                                        $dguru = "SELECT * FROM user where id=$id_g";
                                        $dtguru = mysqli_query($koneksi, $dguru);
                                        $pguru = mysqli_fetch_array($dtguru);
                                        echo $pguru['nama'];
                                    }else{
                                        echo '';
                                    }
                                     ?> </td>
                                    <td>
                                        <span type="button" class="badge badge-danger p-2" data-toggle="modal"
                                            data-target="#hapusptk-<?php echo $r_mapel['id']?>">
                                            <i class="fa fa-trash"></i> Hapus
                                        </span>
                                        <div class="modal fade" tabindex="-1" id="hapusptk-<?php echo $r_mapel['id']?>">
                                            <div class="modal-dialog modal-dialog-centered modal-sm ">
                                                <div class="modal-content p-3 text-center">
                                                    <div class="modal-body">
                                                        <p>Mata Pelajaran <b><?php echo $r_mapel['mapel'] ?></b> akan
                                                            dihapus dari
                                                            database?
                                                        </p>
                                                    </div>
                                                    <div class="text-center mb-2">
                                                        <button type="button" class="mr-2 btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <a href="page.edit.mapel.php?idmapel=<?php echo $r_mapel['id']?>"
                                                            type="button" class="ml-2 btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <?php  }
                                    ?>

                                </tr>




                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="pl-2 pt-2 pr-2 bg-primary">
                    <button class="btn btn-dark mr-0 rounded-0" id="btntambah">Tambah Mapel</button>
                    <button class="btn btn-primary ml-0 rounded-0" id="btnedit">Edit Mapel</button>

                </div>
                <div class="bg-dark rounded-0" id="tambah">

                    <div class="card-body p-0">
                        <form class="card-body" action="" method="POST">
                            <label for="">Nama Mapel</label>
                            <input class="form-control rounded-0" type="text" placeholder="Nama Mapel" name="mapel"
                                required="required">
                            <br>
                            <label for="">Inisial</label>
                            <input class="form-control rounded-0" type="text" placeholder="Inisial Mapel"
                                style="width:40%;" name="in_mapel" required="required">
                            <br>
                            <label>Guru Mapel</label>
                            <select class="for  m-control select2bs4 mb-2 rounded-0" data-placeholder="Pilih Guru Mapel"
                                name="guru_m" style="width: 100%;" required="required">
                                <option value=""></option>
                                <?php 
                                while ($ptk = mysqli_fetch_array($d_user))
                                {echo '<option value="'.$ptk['id'].'"> '.$ptk['nama'].'</option>'; }?>
                            </select>
                            <br>
                            <button type="submit" name="simpan" class="btn btn-primary float-right">
                                <i class="fas fa-save mr-2"></i>
                                <span>Simpan</span>
                            </button>

                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="bg-dark rounded-0" id="edit">

                    <div class="card-body p-0">
                        <form class="card-body" action="" method="POST">
                            <label for="">Mapel yang akan di edit</label>
                            <select class="for  m-control select2bs4 mb-2 rounded-0" data-placeholder="Pilih Mapel"
                                name="idmapel" style="width: 100%;" required="required">
                                <?php $sql_mapel = 'SELECT * FROM mapel';
                                $query_mapel = mysqli_query($koneksi, $sql_mapel);
                                while ($row_mapel = mysqli_fetch_array($query_mapel)) {
                                    echo '<option value="'.$row_mapel['id'].'">'.$row_mapel['mapel'].'</option>';}?>
                            </select>
                            <br>
                            <label for="">Nama Mapel Baru</label>
                            <input class="form-control rounded-0" type="text" placeholder="Nama Mapel Baru"
                                name="mapelbaru">
                            <br>
                            <label for="">Inisial</label>
                            <input class="form-control rounded-0" type="text" placeholder="Inisial Mapel"
                                style="width:40%;" name="in_baru">
                            <br>

                            <label>Guru Mapel</label>
                            <select class="for  m-control select2bs4 mb-2 rounded-0" data-placeholder="Pilih Guru Mapel"
                                name="gurubaru" style="width: 100%;">
                                <option value=""></option>

                                <?php $dataguru = 'SELECT * FROM user';
                                $queryguru = mysqli_query($koneksi, $dataguru);
                                while ($guru = mysqli_fetch_array($queryguru)) {
                                    echo '<option value="'.$guru['id'].'">'.$guru['nama'].'</option>';}?>
                            </select>
                            <br>
                            <button type="submit" name="editmapel" class="btn btn-primary float-right">
                                <i class="fas fa-save mr-2"></i>
                                <span>Simpan</span>
                            </button>

                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

    </div>
</section>
<script>
$(document).ready(function() {
    $("#edit").hide();
})
$("#btnedit").on("click", function() {
    $("#tambah").hide();
    $("#edit").show();
    $("#btntambah").removeClass("btn-dark");
    $("#btntambah").addClass("btn-primary");
    $("#btnedit").removeClass("btn-primary");
    $("#btnedit").addClass("btn-dark");
})
$("#btntambah").on("click", function() {
    $("#tambah").show();
    $("#edit").hide();
    $("#btntambah").removeClass("btn-primary");
    $("#btntambah").addClass("btn-dark");
    $("#btnedit").removeClass("btn-dark");
    $("#btnedit").addClass("btn-primary");
})
</script>

<?php
require 'footer.admin.php';
?>

<?php
require 'script.php';

// [ TAMBAH MAPEL ]

if(isset($_POST['simpan'])){
    $mapel = $_POST['mapel'];
    $inisial = $_POST['in_mapel'];
    $id_guru = $_POST['guru_m'];

    $tambahmapel="INSERT INTO mapel (inisial, mapel, id_guru) VALUES ('$inisial','$mapel','$id_guru')";

    if ($koneksi->query($tambahmapel) === TRUE) {
        echo "<script> $('#berhasil').modal('show');
        const timeout = setTimeout(reload, 1000);

        function reload() {
            location.replace('page.edit.mapel.php');
        }</script>";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}

// [ EDIT MAPEL ]
if(isset($_POST['editmapel'])){
    $idmapel = $_POST['idmapel'];

    $mapelbaru = $_POST['mapelbaru'];
    $idguru = $_POST['gurubaru'];
    $inbaru = $_POST['in_baru'];

    if(!empty($_POST['in_baru'])){
        $inisial = ", inisial='$inbaru'";
    }else{
        $inisial = "";
    }

    if(!empty($_POST['gurubaru'])){
        $gurubaru = ", id_guru='$idguru'";
    }else{
        $gurubaru = "";
    }


    $simpanbaru = mysqli_query($koneksi, "UPDATE mapel SET mapel='$mapelbaru' $inisial $gurubaru WHERE id='$idmapel'");

    if ($simpanbaru === TRUE) {

        if(!empty($_POST['gurubaru'])){
        $ubahjadwal = mysqli_query($koneksi, "UPDATE jadwal SET id_guru='$idguru' WHERE id_mapel='$idmapel'");

            if($ubahjadwal === TRUE){
                echo "<script> $('#berhasil').modal('show');
                const timeout = setTimeout(reload, 1000);

                function reload() {
                location.replace('page.edit.mapel.php');
                }</script>";
                }else {
                    echo "<script> $('#gagal').modal('show');</script>";
                }
        }else {
                echo "<script> $('#berhasil').modal('show');
                const timeout = setTimeout(reload, 1000);
        
                function reload() {
                    location.replace('page.edit.mapel.php');
                }</script>";
        }

       
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}

// [ HAPUS MAPEL ]
if(isset($_GET['idmapel'])){
    $id = $_GET['idmapel'];
 
    $hapusmapel = mysqli_query($koneksi,"DELETE FROM mapel WHERE id='$id'");
    if ($hapusmapel === TRUE) {
        echo "<script> $('#berhasil').modal('show');
        const timeout = setTimeout(reload, 1000);

        function reload() {
            location.replace('page.edit.mapel.php');
        }</script>";
    }else{
        echo "<script> $('#gagal').modal('show');</script>";
    }
}



?>

<script>
$(function() {
    $("#tabelmapel").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["csv", "excel", "colvis"]
    }).buttons().container().appendTo('#tabelmapel_wrapper .col-md-6:eq(0)');
});
</script>

</html>