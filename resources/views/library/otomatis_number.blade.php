<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Otomatis</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Nomor Otomatis</h2>
    <button id="generate">Buat Nomor Baru</button>
    <p>Nomor: <span id="number">-</span></p>

    <script>
        $(document).ready(function() {
            $('#generate').click(function() {
                $.get('/generate-number', function(data) {
                    $('#number').text(data.auto_number);
                });
            });
        });
    </script>
</body>
</html>
