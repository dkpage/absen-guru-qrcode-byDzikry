<section class="container mt-5 p-3 pb-4 fixed-top">
    <div class="">
        <div class=" text-center">
            <div class="heading mb-5 mt-4">
                <img src="admin/dist/img/<?= $logo?>" alt="" height="100px" width="auto" class="mb-4">
                <h1 class="judul text-dark"><?=$n_aplikasi; ?></h1>
                <h2 class="judul2"><strong><?=$sekolah?></strong></h2>
            </div>
            <div class="text-center mb-3 d-grid gap-2 m-3 p-3 btn-main justify-content-center">
                <button class=" btn btn-primary btn-lg  p-2" role="button" id="tbMain"> <i
                        class="fa-solid fa-qrcode mr-3"></i>Isi Absen</button>
                <div class="" id="tbSecon" style="display:none;">
                    <div class="d-grid gap-2">
                        <button class=" btn btn-success " role="button" id="tbAbsen">Reguler</button>
                        <button class=" btn btn-secondary  " role="button" id="tbInvaler">Invaler</button>
                    </div>

                    <!-- <a href="login" class="btn btn-outline-primary btn-lg p-2" role="button"><i
                            class="fa-solid fa-user mr-2"></i> User Panel</a> -->
                </div>
                <a href="login" class="btn btn-outline-primary btn-lg p-2" id="tbLogin"><i
                        class="fa-solid fa-user mr-2"></i> User Panel</a>
            </div>

        </div>
        <br>
        <br>
        <span class="mt-5 fixed-bottom mb-5">
            <p class="text-disabled text-center copyright">© <?php echo $thnid.' - '.$sekolah?></p>
        </span>
    </div>
</section>
<script>
if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    // Desktop / pc
    // window.location.replace('login');
}
</script>

</div>

<script>
let klik = 0;
$("#tbMain").on("click", function() {
    if (klik == 0) {
        $("#tbSecon").show();
        klik = 1
        // console.log("klik ke " + klik);
    } else if (klik == 1) {
        $("#tbSecon").hide();
        klik = 0;
    }
    // document.getElementById("tbSecon").hidden = false;
    // $("#tbMain").hide();
})
$("#tbClose").on("click", function() {
    document.getElementById("tbSecon").hidden = true;
    $("#tbMain").show();
})
</script>