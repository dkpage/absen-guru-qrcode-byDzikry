<?php
$title = 'Login QR';
require 'header.php';

?>
<style>
body {
    margin: 0;
}

canvas {
    width: 100%;
    height: 100%;
    position: absolute;
}

.perintah {
    position: absolute;
    text-align: center;
    color: #fff;
    /* background-color: rgba(255, 100, 100, 0.4); */
}

#output {
    display: none;
}

#loadingMessage {
    margin-top: 100px;
}
</style>

<body class="bg-dark">

    <div id="loadingMessage" class="text-center p-3">
        <div class="ikonresult" style="margin: top 100px;">
            <i class="fa-solid fa-camera-rotate"></i>
        </div>
        <h6 id="loadVideo">
            Menghubungkan ke kamera... pastikan anda mengijinkan akses kamera!
        </h6>
    </div>
    <canvas id="canvas" hidden></canvas>
    <div id="perintah" class="perintah text-center p-3 m-3 bg-primary" hidden>
        <p>Silahkan arahkan kamera pada QR Code yang ada pada <span class="badge badge-warning"> ID Card!</span></p>
    </div>
    <div id="output" hidden>
        <div id="outputMessage" hidden>No QR code detected.</div>
        <div hidden><b>Data:</b> <span id="outputData"></span></div>
    </div>


    <script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var loadingMessage = document.getElementById("loadingMessage");
    var outputContainer = document.getElementById("output");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("outputData");
    var perintah = document.getElementById("perintah");


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
            perintah.hidden = false;

            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
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
                outputMessage.hidden = true;
                outputData.parentElement.hidden = false;
                outputData.innerText = code.data;

                location.href = 'cek_login.php?qr=' + code.data;

            } else {
                outputMessage.hidden = false;
                outputData.parentElement.hidden = true;

            }
        }
        requestAnimationFrame(tick);
    }
    </script>
</body>

</html>