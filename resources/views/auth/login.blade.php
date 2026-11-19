<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Pickleball Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f8fa] text-slate-800">
    <main class="mx-auto flex min-h-screen max-w-md items-center px-4">
        <div class="w-full overflow-hidden rounded-xl border border-slate-200 bg-white p-6 shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
            <p class="text-sm text-slate-400">Inventory</p>
            <h1 class="mt-1 mb-1 text-xl font-bold text-slate-900">Pickleball Inventory</h1>
            <p class="mb-5 text-sm text-slate-500">Administrator Login</p>

            @if (session('status'))
                <div class="mb-4 rounded bg-green-100 px-4 py-2 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="login" class="block font-semibold">Email or Username</label>
                    <input
                        id="login"
                        name="login"
                        type="text"
                        value="{{ old('login') }}"
                        class="mt-1 w-full rounded border-gray-300"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @error('login')
                        <p class="mt-1 text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-semibold">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 w-full rounded border-gray-300"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <p class="mt-1 text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="mb-5 flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="rounded border-gray-300 text-indigo-600"
                    >
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                <button type="submit" class="w-full rounded bg-indigo-600 px-4 py-2 text-white">
                    Log in
                </button>
            </form>
        </div>
    </main>
</body>
</html>
