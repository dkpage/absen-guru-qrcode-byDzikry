<?php
$title = 'ID Card Print';

include 'header.admin.php';

// if(isset($_GET)){
    $d_user = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama");
    // $user = mysqli_fetch_array($select);

    
?>


<style type="text/css" id="css">
/* [ Menghapus Header dan footer ] */
*,
::after,
::before {
    box-sizing: unset;
}

.main-header,
.main-footer,
footer {
    display: none;
}

.preview {
    background-color: #e0e0e0;
    padding: 10px 20px 10px 20px;
    margin: 0;
}

.print {
    width: 210mm;
    min-height: 297mm;
}

@media print {
    * {
        -webkit-print-color-adjust: exact;
        box-sizing: unset;
    }


    body {
        margin: 0;
        padding: 0;
    }

    :not(#print) {
        background-color: white;
    }

    #notPrint,
    .notPrint {
        display: none;
    }

    .preview {

        background: transparent;
        padding: 0;
        margin: 0;
    }

    .print {
        width: 100%;
        min-height: 297mm;
        margin: none;
        padding: 0;
    }
}

.kartu {
    height: 85mm;
    width: 50mm;
    background: url('dist/img/bg-kartu-absen2.jpg');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    display: inline-table;
    text-align: center;
    margin: 1px;
    border-style: solid;
    border-width: 1px;
}

.foto {
    height: 20mm;
    width: 20mm;
    border-radius: 50%;
    margin: 18mm 0mm 0mm 14.9mm;
    background-size: cover;
    background-position: top;
    background-repeat: no-repeat;

}


.qrcode {
    height: 20mm;
    width: 20mm;
    border-radius: 10px;
    margin: 3mm 0mm 0mm 14.9mm;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.nama {
    color: #000000;
    margin: 5mm 5mm 0mm 5mm;
    word-wrap: break-word;
    text-align: center;

}

.nama h2 {
    font-family: 'Lato', sans-serif;
    font-weight: 700;
    font-size: 12pt;
    color: #083C5A;
    word-wrap: break-word;
    line-height: 1rem;
    margin: auto;

}

.nama span {
    display: block;
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    font-size: 8pt;
    line-height: 1.2;
    margin-top: 2px;
    color: #083C5A;
}

@media print {
    #print {
        -webkit-print-color-adjust: exact;
    }
}
</style>

<div>
    <div class="preview" id="preview">
        <div class="card-tools mb-3 p-3 sticky-top" id="notPrint">
            <button class="btn btn-success " onclick="printIDC()">Cetak / Simpan PDF</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="bg-white p-4 print" id="print">
                <?php 
                $no     = 1;
                while ($user = mysqli_fetch_array($d_user)){
                    $nama = $user['nama'];
                    $qr = $user['qrcode'];
                    $nip = $user['nip'];
                    $foto = $user['foto'];
            
                    if(!empty($foto)){
                        $ft = $foto;
                    }else{
                        $ft = 'kasep.png';
                    }
                    ?>
                <div class="kartu " id="kartu">
                    <div class="foto" style="background-image: url('dist/img/foto-user/<?php echo $foto ;?>');">
                    </div>
                    <div class="nama">
                        <h2>
                            <?php echo $user['nama']; ?>
                        </h2>
                        <span>
                            NIP/NUPTK. <?php echo $nip ?>
                        </span>
                    </div>
                    <div class="qrcode bg-dark"
                        style="background-image: url('dist/img/qrcode/<?php echo $qr ;?>.png');">
                    </div>


                </div>


                <?php ; $no++;}?>
            </div>
        </div>
    </div>
</div>
<div class="printpage" id="printpage">
</div>

<div id="title" hidden><?= $title?>-</div>

<?php

require 'footer.admin.php';
?>
<script>
function cetak() {
    var preview = document.getElementById('preview');
    var print = document.getElementById('print');
    var printPage = document.getElementById('printpage');
    preview.hidden = true;
    printPage.append(print);

    window.print();
    location.reload();
}
</script>
<script>
var footer = document.getElementById('footer');
var menuMobile = document.getElementById('mobileMenu');
$(document).ready(function() {
    footer.className = "main-footer";
    foter.hidden = true;
})
$(document).ready(function() {
    menuMobile.className = "main-footer";
    menuMobile.hidden = true;
})
</script>
<script>
function printIDC() {
    var title = document.getElementById('title').innerHTML;
    var css = document.getElementById("css").innerHTML;
    var printContents = document.getElementById("print").innerHTML;
    var a = window.open('', '', 'height=1000px, width=1500px');

    a.document.write('<html width="210mm" height="297mm"><head><title>' + title + Date.now() +
        '</title><style>' + css +
        '</style></head><body>' + printContents + '</body></html>');

    a.document.close();
    a.print();
    a.close();
}
</script>
<script src="plugins/printjs/print.min.js"></script>

<?php
require 'script.php';
?>

</html>