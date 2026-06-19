<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Order</title>

    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body class="bg-[#071426] text-white">

    {{ $slot }}

    @livewireScripts
</body>
</html>