<?php
$title = 'Cetak ID Card';


require 'sidebar.admin.php';

if($aksesidcard !== 'Ya'){
    ?>
<script>
location.replace("dashboard.php");
</script>
<?php
    }

?>
<style>
iframe {
    width: 100%;
    height: 500px;
}
</style>
<div class="container">
    <!-- <section class="pilihan" id="notPrint">
        <div class="">
            <div class="d-flex p-0">
                <a href="page.set-idcard.php" class="btn btn-primary mb-3">
                    <i class="fas fa-edit mr-2"></i>Edit Layout ID Card</a>
                <div class="nav nav-pills  ml-auto p-2">

                    <button class="btn btn-success mr-2" id="cSemua" onclick="cetakSemua()">Tampilkan Semua
                    </button>
                    <button id="pilih" onclick="lihatFilter()" class="btn btn-success">
                        Tampilkan Beberapa</button>
                    <button class="btn btn-danger" id="tutup" onclick="tutupFilter()" hidden>X</i></button>

                    <form action="cobascript.php" method="POST" style="width:300px;" class="ml-2" id="filter">
                        <div class=" input-group input-group-sm">
                            <select class="form-control select2bs4" placeholder="Pilih Nama (Maks. 5)"
                                name="filternama[]" multiple="multiple">
                                <option value="1">Kamaludin</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <button type="submit" name="lihat" class="btn btn-success ml-2">Lihat</button>
                        </div>
                    </form>
                    </ul>
                </div>
            </div>
    </section>
    <hr> -->
    <section>
        <div class="p-3 preview" id="preview">
            <iframe src="page.cetak.kartu.print.php?cetak=23424234234" frameborder="0"></iframe>
        </div>
    </section>
</div>
<?php
require 'footer.admin.php';
?>

<script>
function cetakSemua() {
    // location.replace('page.cetak.kartu.php?cetak=semua');
    // window.print();
}

function lihatFilter() {
    document.getElementById("cSemua").hidden = true;
    document.getElementById("pilih").hidden = true;
    document.getElementById("filter").hidden = false;
    document.getElementById("tutup").hidden = false;
}

function tutupFilter() {
    document.getElementById("cSemua").hidden = false;
    document.getElementById("pilih").hidden = false;
    document.getElementById("filter").hidden = true;
    document.getElementById("tutup").hidden = true;
}
</script>
<script src="plugins/printjs/print.min.js"></script>

<?php
require 'script.php';
?>

</html>