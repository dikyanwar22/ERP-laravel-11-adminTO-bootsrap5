<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Static</title>
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

    <h2>QR Code Static</h2>
    <p>Value: <strong>Dicky Anwar Kabut Salju</strong></p>
    <div id="qrcode"></div>

    <script>
        let qrValue = "Dicky Anwar Kabut Salju"; // Nilai QR Code
        new QRCode(document.getElementById("qrcode"), {
            text: qrValue,
            width: 200,
            height: 200
        });
    </script>

</body>
</html>
