<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang chủ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .modal-body p strong {
            display: inline-block;
            width: 120px;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <header class="custom-header">
        <div class="logo">
            <img src="{{ asset('images/manhinhchinhsuataikhoan/logo.png') }}" alt="Logo">
        </div>
    </header>

    {{-- Nội dung --}}
    <main>
        @yield('content')
    </main>

    {{-- Scripts --}}
    @yield('scripts')

</body>
</html>
