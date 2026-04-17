<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Online Food Ordering')</title>
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
</head>
<body class="bg-white text-dark">
    <!-- Navigation -->
    <nav class="bg-dark text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('customer.home') }}" class="text-2xl font-bold">
                    FoodHub
                </a>
                
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('customer.home') }}" class="hover:text-primary transition">Home</a>
                    <a href="{{ route('customer.menu') }}" class="hover:text-primary transition">Menu</a>
                    @auth
                        <a href="{{ route('customer.orders') }}" class="hover:text-primary transition">My Orders</a>
                        <a href="{{ route('customer.cart') }}" class="hover:text-primary transition">Cart</a>
                        <a href="{{ route('customer.profile') }}" class="hover:text-primary transition">Profile</a>
                    @endauth
                </div>

                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-primary transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-primary px-4 py-2 rounded hover:opacity-90 transition">Sign Up</a>
                    @else
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition">Admin</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-primary transition">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @if(session('success'))
            <div class="container mx-auto px-4 pt-4">
                <div class="bg-green-50 border-2 border-green-200 text-green-700 p-3 rounded-lg">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mx-auto px-4 pt-4">
                <div class="bg-red-50 border-2 border-red-200 text-red-700 p-3 rounded-lg">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center">
                <p>&copy; 2024 FoodHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
