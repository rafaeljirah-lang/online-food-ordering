<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind (for existing admin utility classes) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        dark: '#1f2937',
                    }
                }
            }
        }
    </script>

    <style>
        html { font-size: 16px; }
        body {
            background-color: #eef1f7;
        }
    </style>
</head>
<body class="min-h-screen text-[15px] md:text-base">
<div class="flex min-h-screen">
    <aside class="w-64 bg-slate-900 text-white p-4 hidden md:flex md:flex-col">
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold mb-6">Admin Panel</a>

        <nav class="space-y-2 text-[15px]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <i class="fas fa-chart-line w-4"></i> Dashboard
            </a>
            <a href="{{ route('admin.menu.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.menu.*') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <i class="fas fa-box w-4"></i> Menu Management
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <i class="fas fa-shopping-cart w-4"></i> Orders
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <i class="fas fa-tags w-4"></i> Categories
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <i class="fas fa-users w-4"></i> Users
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600' : 'hover:bg-slate-800' }}">
                <i class="fas fa-file-alt w-4"></i> Sales Reports
            </a>
            <a href="{{ route('customer.home') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800">
                <i class="fas fa-globe w-4"></i> View Site
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
            @csrf
            <button class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg">Logout</button>
        </form>
    </aside>

    <main class="flex-1 p-4 md:p-6">
        <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 mb-4 flex items-center justify-between">
            <h1 class="font-semibold text-slate-800">@yield('title')</h1>
            <span class="text-sm text-gray-500">{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border-2 border-green-200 text-green-700 p-3 rounded-lg">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-50 border-2 border-red-200 text-red-700 p-3 rounded-lg">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
