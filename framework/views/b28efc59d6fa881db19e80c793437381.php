<?php $__env->startSection('title', 'Order Placed - FoodHub'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="max-w-2xl w-full">
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-green-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-dark mb-2">Order Placed Successfully!</h1>
            <p class="text-lg text-gray-600">Thank you for your order</p>
        </div>

        <!-- Order Details Card -->
        <div class="bg-white border-2 border-gray-200 rounded-lg p-8 mb-6">
            <div class="text-center mb-6">
                <p class="text-gray-600 mb-2">Your Order Number</p>
                <p class="text-4xl font-bold text-primary">#<?php echo e($order->id ?? ''); ?></p>
            </div>

            <div class="border-t-2 border-gray-200 pt-6 space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Order Date:</span>
                    <span class="font-semibold text-dark"><?php echo e($order->created_at->format('M d, Y - h:i A')); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-bold text-2xl text-primary">$<?php echo e(number_format($order->total_amount, 2)); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Payment Method:</span>
                    <span class="font-semibold text-dark"><?php echo e(ucfirst($order->payment_method)); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Delivery Address:</span>
                    <span class="font-semibold text-dark text-right"><?php echo e($order->delivery_address); ?></span>
                </div>
            </div>
        </div>

        <!-- What's Next -->
        <div class="bg-white border-2 border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-dark mb-4">What's Next?</h2>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold">1</span>
                    </div>
                    <div>
                        <p class="font-semibold text-dark">Order Confirmation</p>
                        <p class="text-sm text-gray-600">We've sent a confirmation email to your registered email address.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <div>
                        <p class="font-semibold text-dark">Preparing Your Order</p>
                        <p class="text-sm text-gray-600">Our kitchen is preparing your delicious meal with care.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <div>
                        <p class="font-semibold text-dark">Out for Delivery</p>
                        <p class="text-sm text-gray-600">Your order will be on its way to you shortly.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid md:grid-cols-2 gap-4">
            <a href="<?php echo e(route('customer.order-details', $order->id)); ?>" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold text-center hover:opacity-90 transition">
                View Order Details
            </a>
            <a href="<?php echo e(route('customer.menu')); ?>" class="bg-dark text-white px-6 py-3 rounded-lg font-semibold text-center hover:opacity-90 transition">
                Continue Shopping
            </a>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="<?php echo e(route('customer.home')); ?>" class="text-primary hover:underline">
                ← Back to Home
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/customer/order-success.blade.php ENDPATH**/ ?>