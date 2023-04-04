<?php
$title = 'Scan ID Card';

?>
<style>

</style>
<section class="p-3">
    <div id="status" hidden><?php if(isset($_GET['s'])){echo $_GET['s'];}?></div>
    <div class=" mb-4 p-3">
        <div class=" mb-1">
            <div class="d-grid ">
                <a href="index" class="">
                    <i class="fa-solid fa-angle-left"></i> Kembali </a>
            </div>
        </div>

    </div>
    <div class="container mt-5 d-grid d-md-flex justify-content-between scanqr">
        <div class="judul-kiri">
            <span class="badge badge-success" id="st"></span>
            <div class="judul">Ambil Absen </div>
            <div class="deskripsi">Silahkan arahkan QR Code yang ada pada ID Card ke kamera</div>
            <br>
            <br>
            <br>

        </div>
        <div class="" id="kamera">
            <div id="loadingMessage" class="text-center p-3">
                <div class="ikonresult" style="margin: top 100px;">
                    <i class="fa-solid fa-camera-rotate"></i>
                </div>
                <h6 id="loadVideo">
                    Menghubungkan ke kamera... pastikan anda mengijinkan akses kamera!
                </h6>
            </div>
            <canvas id="canvas" hidden></canvas>
        </div>
    </div>
</section>







<div id="output" hidden>
    <div id="outputMessage" hidden>No QR code detected.</div>
    <div hidden><b>Data:</b> <span id="outputData"></span></div>
</div>


<script>
var status = document.getElementById("status").innerHTML;
document.getElementById("st").innerHTML = status;
var video = document.createElement("video");
var canvasElement = document.getElementById("canvas");
var canvas = canvasElement.getContext("2d");
var loadingMessage = document.getElementById("loadingMessage");
var outputContainer = document.getElementById("output");
var outputMessage = document.getElementById("outputMessage");
var outputData = document.getElementById("outputData");
// var perintah = document.getElementById("perintah");



function drawLine(begin, end, color) {
    canvas.beginPath();
    canvas.moveTo(begin.x, begin.y);
    canvas.lineTo(end.x, end.y);
    canvas.lineWidth = 4;
    canvas.strokeStyle = color;
    canvas.stroke();
}

// Use facingMode: environment to attemt to get the front camera on phones
navigator.mediaDevices.getUserMedia({
    video: {
        facingMode: "environment"
    }
}).then(function(stream) {
    video.srcObject = stream;
    video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
    video.play();
    requestAnimationFrame(tick);
});

function tick() {
    loadingMessage.innerText = "Membuka Kamera ..."
    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        loadingMessage.hidden = true;
        canvasElement.hidden = false;
        outputContainer.hidden = false;
        // perintah.hidden = false;

        // canvasElement.height = video.videoHeight;
        // canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height, {
            inversionAttempts: "dontInvert",
        });
        if (code) {
            drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
            drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
            drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
            drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
            // outputMessage.hidden = true;
            // outputData.parentElement.hidden = false;
            // outputData.innerText = code.data;

            // location.replace = 'ceknama.php?qr=' + code.data;
            $("#canvas").remove();
            $("#result").load("result?qr=" + code.data);
            history.pushState({}, null, "result?qr=" + code.data + '&s=' + status);

            window.location.reload();
            // canvasElement.hidden = true;


        } else {
            outputMessage.hidden = false;
            outputData.parentElement.hidden = true;

        }
    }
    requestAnimationFrame(tick);
}
</script>