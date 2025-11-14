<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magang in</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #7f8c8d;
            /* abu abu */
        }

        .brand-in {
            background: #ffffff;
            color: #000;
            padding: 0 6px;
            border-radius: 4px;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">

        <!-- Judul -->
        <h1 class="fw-bold mb-3">
            Magang <span class="brand-in">in</span>
        </h1>

        <!-- Deskripsi -->
        <p class="text-center text-muted mb-4" style="max-width: 480px;">
            Ngatur anak magang ? Magang <span class="brand-in">in</span> aja!
        </p>
        <p class="text-center text-muted mb-4" style="max-width: 480px;">
            Yang anak baru register dulu yaa... :v
        </p>


        <!-- Tombol -->
        <div class="d-flex gap-3">
            <a href="{{ route('login') }}" class="btn btn-secondary px-4">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-dark px-4">Register</a>
        </div>

    </div>

</body>

</html>
