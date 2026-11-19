<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pickleball Inventory')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex gap-6 items-center">
                <span class="font-bold">Pickleball Inventory</span>
                <a href="{{ route('equipment.index') }}" class="hover:underline">Equipment</a>
                <a href="{{ route('reports.index') }}" class="hover:underline">Reports</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @if (session('success'))
            <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pickleball Inventory')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex gap-6 items-center">
                <span class="font-bold">Pickleball Inventory</span>
                <a href="{{ route('equipment.index') }}" class="hover:underline">Equipment</a>
                <a href="{{ route('reports.index') }}" class="hover:underline">Reports</a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @if (session('success'))
            <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>