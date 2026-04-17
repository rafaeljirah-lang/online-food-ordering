<?php $__env->startSection('title', 'Shopping Cart - FoodHub'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold">Shopping Cart</h1>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <?php if(session('cart') && count(session('cart')) > 0): ?>
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="md:col-span-2">
            <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white border-2 border-gray-200 rounded-lg p-4 mb-4 flex items-center gap-4">
                <?php if($details['image']): ?>
                <img src="<?php echo e(asset('storage/' . $details['image'])); ?>" alt="<?php echo e($details['name']); ?>" class="w-24 h-24 object-cover rounded">
                <?php else: ?>
                <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                    <span class="text-gray-400 text-xs">No Image</span>
                </div>
                <?php endif; ?>

                <div class="flex-1">
                    <h3 class="font-bold text-lg text-dark"><?php echo e($details['name']); ?></h3>
                    <p class="text-primary font-semibold">$<?php echo e(number_format($details['price'], 2)); ?> each</p>
                </div>

                <div class="flex items-center gap-4">
                    <form action="<?php echo e(route('customer.cart.update')); ?>" method="POST" class="flex items-center gap-2">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($id); ?>">
                        <input type="number" name="quantity" value="<?php echo e($details['quantity']); ?>" min="1" 
                               class="w-20 px-2 py-1 border-2 border-gray-300 rounded focus:border-primary focus:outline-none">
                        <button type="submit" class="bg-primary text-white px-3 py-1 rounded hover:opacity-90 transition text-sm">
                            Update
                        </button>
                    </form>

                    <form action="<?php echo e(route('customer.cart.remove', $id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="text-right">
                    <p class="font-bold text-dark">$<?php echo e(number_format($details['price'] * $details['quantity'], 2)); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Order Summary -->
        <div class="md:col-span-1">
            <div class="bg-white border-2 border-gray-200 rounded-lg p-6 sticky top-4">
                <h3 class="text-2xl font-bold mb-4 text-dark">Order Summary</h3>
                
                <?php
                    $total = 0;
                    foreach(session('cart') as $details) {
                        $total += $details['price'] * $details['quantity'];
                    }
                ?>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>$<?php echo e(number_format($total, 2)); ?></span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Delivery Fee</span>
                        <span>$5.00</span>
                    </div>
                    <div class="border-t-2 border-gray-200 pt-3 flex justify-between font-bold text-lg text-dark">
                        <span>Total</span>
                        <span class="text-primary">$<?php echo e(number_format($total + 5, 2)); ?></span>
                    </div>
                </div>

                <a href="<?php echo e(route('customer.checkout')); ?>" class="block w-full bg-primary text-white text-center px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition">
                    Proceed to Checkout
                </a>

                <a href="<?php echo e(route('customer.menu')); ?>" class="block w-full text-center text-dark px-6 py-3 rounded-lg mt-3 border-2 border-gray-300 hover:border-primary transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="text-center py-12">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <h2 class="text-2xl font-bold text-dark mb-2">Your cart is empty</h2>
        <p class="text-gray-600 mb-6">Add some delicious items to your cart</p>
        <a href="<?php echo e(route('customer.menu')); ?>" class="inline-block bg-primary text-white px-8 py-3 rounded-lg hover:opacity-90 transition">
            Browse Menu
        </a>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/customer/cart.blade.php ENDPATH**/ ?>