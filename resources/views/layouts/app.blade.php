<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('includes.links')
</head>
<body class="bg-gray-50">
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')

    
    
</body>
</html>
