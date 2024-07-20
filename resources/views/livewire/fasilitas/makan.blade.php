<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <style>
        #qr-reader {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        .content-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
    </style>

    <script src="{{ asset('public/js/html5-qrcode.min.js') }}"></script>

    <header class="bg-primary bg-gradient text-white">
        <div class="content-center">
            <div id="qr-reader" style="width:300px"></div>
            <div id="qr-reader-results">{{ $qrCodeScanned }}</div>
        </div>
    </header>

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
</div>