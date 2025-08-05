<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookstore App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="{{ url('/') }}">📚 Bookstore</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Books</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/authors') }}">Top Authors</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/ratings') }}">Rate a Book</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')

        <div class="mt-3">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    </div>

    <footer class="text-center mt-4 mb-3">
        <hr>
        <small>&copy; {{ date('Y') }} Bookstore App</small>
    </footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('scripts')
{{-- <script>
    $(document).ready(function() {
        $('#book-select').select2({
            placeholder: "-- Select Book --",
            width: '100%'
        });
    });
</script> --}}

</body>
</html>
