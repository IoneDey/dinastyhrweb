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
                        alert('Hasil scan QR Code: ' + data.qrCodeData);
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

        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var fileInput = document.getElementById('fileInput');
            var file = fileInput.files[0];

            if (!file) {
                alert('Please select a file to upload.');
                return;
            }

            var reader = new FileReader();
            reader.onload = function(event) {
                var imageSrc = event.target.result;
                scanQRCodeFromImage(imageSrc);
            };
            reader.readAsDataURL(file);
        });

        function scanQRCodeFromImage(imageSrc) {
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader-results", {
                    fps: 10,
                    qrbox: 200
                }
            );
            html5QrcodeScanner.scanFile(imageSrc)
                .then(decodedText => {
                    alert('Scanned QR Code result: ' + decodedText);
                    // Lakukan apa yang Anda ingin lakukan dengan hasil QR Code di sini
                })
                .catch(err => {
                    console.error(err);
                    alert('QR Code scan error: ' + err);
                });
        }
    </script>
    </script>

</body>

</html>