<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <!-- Tailwind CDN for quick styling improvements (keeps functionality intact) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@php
if(Auth::user()->role == 'Administrador') {
$image = 'images/pets-dashboard-2.png';
} else {
$image = 'images/pets-dashboard.png';
}
@endphp

<body class="min-h-[100dvh] bg-[url({{ asset($image) }})] bg-contain bg-cover bg-fixed bg-center bg-black w-full flex flex-col gap-4 items-center justify-center p-8 pt-20">
    @include('layouts.navbar')
    @yield('content')
    @yield('js')
</body>

</html>