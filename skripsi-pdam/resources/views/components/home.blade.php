<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDAM Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white h-screen overflow-hidden">
    <div class="flex h-screen">
        <x-sidebar />
        <div class="flex-1 flex flex-col">
            <x-header />
            <main class="flex-1 overflow-y-auto p-8 bg-gray-50 min-h-screen">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>