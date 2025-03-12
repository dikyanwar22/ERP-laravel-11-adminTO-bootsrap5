<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .error-container {
            text-align: center;
        }
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #007bff;
            text-shadow: 2px 2px 5px rgba(0, 123, 255, 0.3);
        }
        .error-text {
            font-size: 1.5rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .btn-primary {
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">404</h1>
        <p class="error-text">Oops! Halaman yang Anda cari tidak ditemukan.</p>
        <a href="javascript:void(0);" onclick="window.history.back()" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>
