<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pickleball Inventory')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f7f8fa] text-slate-800">
    <nav class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-[1500px] items-center justify-between px-6 py-4">
            <div class="flex items-center gap-8">
                <a href="{{ route('equipment.index') }}" class="text-lg font-bold text-slate-900">Inventory</a>
                <div class="hidden items-center gap-6 text-sm sm:flex">
                    <a href="{{ route('equipment.index') }}" class="{{ request()->routeIs('equipment.*') ? 'font-semibold text-indigo-600' : 'text-slate-500 hover:text-slate-900' }}">Equipment</a>
                    <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'font-semibold text-indigo-600' : 'text-slate-500 hover:text-slate-900' }}">Reports</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="hidden text-sm text-slate-500 md:inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <main class="mx-auto max-w-[1500px] px-4 py-6 sm:px-6">
        @if (session('success'))
            <div class="mb-4 rounded bg-green-100 px-4 py-2 text-green-800">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
