<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <script src="{{ asset('public/js/html5-qrcode.min.js') }}"></script>
    <div id="qr-reader" style="width:300px"></div>
    <div id="qr-reader-results">{{ $qrCodeScanned }}</div>

    <script>
        function docReady(fn) {
            // see if DOM is already available
            if (document.readyState === "complete" ||
                document.readyState === "interactive") {
                // call on next available tick
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function() {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    // console.log(`Scan result ${decodedText}`, decodedResult);
                    // resultContainer.innerText = `Scan result ${decodedText}`;

                    Livewire.dispatch('qrCodeScanned', {
                        decodedText: decodedText
                    });
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: 200
                });
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>

</body>

</html>