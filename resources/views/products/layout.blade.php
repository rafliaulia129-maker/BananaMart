<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BananaMart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
    <div class="container">
        <a class="navbar-brand text-dark fw-bold" href="{{ route('products.index') }}">
            BananaMart
        </a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>