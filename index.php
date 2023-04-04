<?php
$title = 'Home';
// require 'admin/config/appconfig.php';
include 'header.php';
    ?>

<body class="">
    <!-- <div class="background1 bg-primary"> -->

    </div>
    <div class="bg-light" id="#konten">
        <div id="cover"><?php include 'cover.php'?></div>
        <div id="isiAbsen"></div>
        <div id="result"></div>

    </div>

    <script>
    $("#tbAbsen").click(function() {
        $("#isiAbsen").load("isiabsen.php?s=reguler");
        $("#cover").hide();
    })
    $("#tbInvaler").click(function() {
        $("#isiAbsen").load("isiabsen.php?s=invaler");
        $("#cover").hide();
    })


    if (window.location.href.indexOf("?qr=") > -1) {
        $("#cover").hide();
        $("#result").load("result.php" + window.location.search);
    }

    $(document).ready(function() {
        if (window.location.href.indexOf("#ulangi") > -1) {
            // $("#isiAbsen").load("isiabsen.php");
            // $("#cover").hide();
            $("#ulang").modal("show");
        }
        if (window.location.href.indexOf("#logout") > -1) {
            $("#logout").modal("show");
            const timeout = setTimeout(reload, 1000);

            function reload() {
                history.pushState({}, null, "index");
                $("#logout").modal("hide");
            }
        }
        if (window.location.href.indexOf("#auto-logout") > -1) {
            $("#auto-logout").modal("show");
        }
        $("#btnOut").on("click", function() {
            history.pushState({}, null, "index");
            $("#auto-logout").modal("hide");
        })
        $("#btnUlang").on("click", function() {
            history.pushState({}, null, "index");
            $("#ulang").modal("hide");
        })
    })
    </script>
    <div class="modal fade" id="logout">
        <div class="modal-dialog modal-sm ">
            <div class="modal-content bg-success rounded-2">
                <span class="text-center p-2">
                    <i class="fa-solid fa-circle-check mr-3 text-white"></i>
                    Logout Success
                </span>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="auto-logout">
        <div class="modal-dialog modal-sm ">
            <div class="modal-content bg-light rounded-2 p-2">
                <span class="text-center p-2">
                    <!-- <i class="fa-solid fa-circle-check mr-3 text-white"></i> -->
                    Sesi anda telah berakhir karena tidak aktif selama 15 menit. <br>
                    <b>Silahkan Login kembali</b><br><br>
                    <button id="btnOut" class="btn btn-outline-dark">Keluar</button>
                    <a href="login" id="btnOke" class="btn btn-outline-dark">Login</a>
                </span>

            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="ulang">
        <div class="modal-dialog modal-sm ">
            <div class="modal-content bg-light rounded-2">
                <span class="text-center p-2">

                    Silahkan Ulangi Pemindaian <br><br>
                    <button id="btnUlang" class="btn btn-outline-dark">Oke</button>
                </span>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php
include 'footer.php';
?>