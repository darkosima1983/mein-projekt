@php
    $theme = session('theme', 'light'); // default light
@endphp

<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'MeinProjekt' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="{{ $theme === 'dark' ? 'bg-dark text-white' : 'bg-light text-dark' }}">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg {{ $theme === 'dark' ? 'bg-secondary navbar-dark' : 'bg-dark navbar-dark' }} p-2">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">MeinProjekt</a>
        <div class="d-flex ms-auto">
            <a href="{{ route('theme.switch', 'dark') }}" class="btn btn-sm btn-outline-light me-1">🌙 Dark</a>
            <a href="{{ route('theme.switch', 'light') }}" class="btn btn-sm btn-outline-secondary">☀️ Light</a>
        </div>
    </div>
</nav>

<!-- Glavni sadržaj -->
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="w-100" style="max-width: 420px;">
        <div class="card {{ $theme === 'dark' ? 'bg-dark text-white' : 'bg-light' }} shadow-lg p-5 rounded">
            {{ $slot }}
        </div>
    </div>
</div>

</body>
</html>
