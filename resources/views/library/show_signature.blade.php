<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Tangan</title>
</head>
<body>
    <h1>Tanda Tangan yang Disimpan</h1>
    @if (!empty($signature['signature']))
        <img src="data:image/png;base64,{{ substr($signature['signature'], strpos($signature['signature'], ',') + 1) }}" alt="Tanda Tangan">
    @else
        <p>No signature available</p>
    @endif
</body>
</html>
