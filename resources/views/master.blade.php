<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'App Pegawai')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-gray-50 text-gray-900 antialiased">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-red-700 text-white shadow">
        <div class="mx-auto max-w-7xl px-4">
            <div class="flex items-center gap-10 py-3">
                <a href="{{ url('/') }}" class="font-semibold tracking-wide hover:opacity-90">
                    App Pegawai
                </a>
                <nav class="flex-1">
                    <ul class="flex items-center gap-6 text-sm">
                        <li><a class="hover:underline @if(request()->is('dashboard')) underline @endif" href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li><a class="hover:underline @if(request()->is('employees*')) underline @endif" href="{{ url('/employees') }}">Employee</a></li>
                        <li><a class="hover:underline @if(request()->is('departments*')) underline @endif" href="{{ url('/departments') }}">Department</a></li>
                        <li><a class="hover:underline @if(request()->is('positions*')) underline @endif" href="{{ url('/positions') }}">Position</a></li>
                        <li><a class="hover:underline @if(request()->is('attendances*')) underline @endif" href="{{ url('/attendances') }}">Attendance</a></li>
                        <li><a class="hover:underline @if(request()->is('salaries*')) underline @endif" href="{{ url('/salaries') }}">Salaries</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex-1 mx-auto w-full max-w-7xl px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto border-t bg-white/70">
        <div class="mx-auto max-w-7xl px-4 py-6 text-center text-sm text-gray-500">
            © {{ date('Y') }} App Pegawai
        </div>
    </footer>

</body>
</html>
