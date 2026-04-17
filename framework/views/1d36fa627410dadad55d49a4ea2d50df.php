<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Online Food Ordering'); ?></title>
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
                <a href="<?php echo e(route('customer.home')); ?>" class="text-2xl font-bold">
                    FoodHub
                </a>
                
                <div class="hidden md:flex space-x-6">
                    <a href="<?php echo e(route('customer.home')); ?>" class="hover:text-primary transition">Home</a>
                    <a href="<?php echo e(route('customer.menu')); ?>" class="hover:text-primary transition">Menu</a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('customer.orders')); ?>" class="hover:text-primary transition">My Orders</a>
                        <a href="<?php echo e(route('customer.cart')); ?>" class="hover:text-primary transition">Cart</a>
                        <a href="<?php echo e(route('customer.profile')); ?>" class="hover:text-primary transition">Profile</a>
                    <?php endif; ?>
                </div>

                <div class="flex items-center space-x-4">
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="hover:text-primary transition">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="bg-primary px-4 py-2 rounded hover:opacity-90 transition">Sign Up</a>
                    <?php else: ?>
                        <?php if(auth()->user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-primary transition">Admin</a>
                        <?php endif; ?>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="hover:text-primary transition">Logout</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        <?php if(session('success')): ?>
            <div class="container mx-auto px-4 pt-4">
                <div class="bg-green-50 border-2 border-green-200 text-green-700 p-3 rounded-lg">
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="container mx-auto px-4 pt-4">
                <div class="bg-red-50 border-2 border-red-200 text-red-700 p-3 rounded-lg">
                    <?php echo e(session('error')); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center">
                <p>&copy; 2024 FoodHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\JM\online-food-ordering\resources\views/layouts/app.blade.php ENDPATH**/ ?>