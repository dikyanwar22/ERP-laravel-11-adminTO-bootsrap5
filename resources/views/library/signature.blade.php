<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signature</title>
    <!-- CDN SignaturePad -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
</head>
<body>
    <h1>Digital Signature</h1>
    <canvas id="signature-pad" width="600" height="200" style="border:1px solid #000;"></canvas>
    <button id="clear">Clear</button>
    <button id="save">Save</button>

    <script>
    window.onload = function() {
    const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas);

    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
    });

    document.getElementById('save').addEventListener('click', function () {
    if (signaturePad.isEmpty()) {
        alert("Tanda tangan tidak boleh kosong!");
        return;
    }

    const data = signaturePad.toDataURL();  // Ambil data signature dalam format base64
    console.log(data);  // Log data untuk memeriksa apakah ada

    fetch('{{ url("signature") }}', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
        },
        body: JSON.stringify({ signature: data }),
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);  // Menampilkan pesan sukses
    })
    .catch(error => {
        alert('Error: ' + error);
    });
});

};
    </script>
</body>
</html>
