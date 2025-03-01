<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        #qrcode {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>QR Code Generator</h2>
    <input type="text" id="text" placeholder="Masukkan teks atau URL">
    <button onclick="generateQRCode()">Generate QR Code</button>

    <div id="qrcode"></div>

    <script>
        function generateQRCode() {
            let text = document.getElementById("text").value;
            document.getElementById("qrcode").innerHTML = ""; // Reset QR code lama
            
            if (text.trim() === "") {
                alert("Masukkan teks atau URL terlebih dahulu!");
                return;
            }
            
            new QRCode(document.getElementById("qrcode"), {
                text: text,
                width: 200,
                height: 200
            });
        }
    </script>

</body>
</html>
