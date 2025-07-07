<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDAM Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-white min-h-screen overflow-hidden">
    <div class="flex h-screen">
        <x-sidebar />
        <div class="flex flex-col flex-1">
            <x-header />
            <main class="overflow-auto flex-1 bg-gray-50 md:px-8 md:py-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>