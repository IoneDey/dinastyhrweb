<!-- resources/views/your-view.blade.php -->

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
            var lastResult;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    lastResult = decodedText;
                    sendDataToServer(decodedText);
                }
            }

            function sendDataToServer(data) {
                fetch('/process-qr-code', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            qrCodeData: data
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response from server:', data);
                        // Handle response from server if needed
                    })
                    .catch(error => {
                        console.error('Error sending data to server:', error);
                    });
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