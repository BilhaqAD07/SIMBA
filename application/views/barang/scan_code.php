<!DOCTYPE html>
<html>
<head>
    <title>Scan QR/Barcode</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>
<body>
    <div class="container-fluid">
        <center>
            <div id="reader" style="width:500px; height:500px; align-content:center;"></div>
        </center>
        <script>
            let soundPlayed = false;

            function onScanSuccess(codeMessage) {
                 if (!soundPlayed) {
                        // Play success sound
                        var audio = new Audio('<?= base_url() ?>assets/sounds/success.mp3');
                        audio.play();
                        soundPlayed = true; // Set the flag to true
                    }
                alert('Scanned Code: ' + codeMessage);
                window.location.href = "<?= base_url('barang/detail/') ?>" + codeMessage;
            }

            function onScanFailure(error) {
                console.warn(`Code error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    </div>
</body>
</html>
