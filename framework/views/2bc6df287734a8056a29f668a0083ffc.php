<?php $__env->startSection('title', 'Order Details'); ?>

<?php $__env->startSection('page-title', 'Order #' . ($order->id ?? '')); ?>

<?php $__env->startSection('content'); ?>
<div class="grid md:grid-cols-3 gap-6">
    <!-- Order Details -->
    <div class="md:col-span-2 space-y-6">
        <!-- Order Items -->
        <div class="bg-white border-2 border-gray-200 rounded-lg p-6">
            <h2 class="text-2xl font-bold text-dark mb-4">Order Items</h2>
            
            <div class="space-y-4">
                <?php $__currentLoopData = $order->orderItems ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                    <?php if($item->menuItem->image): ?>
                    <img src="<?php echo e(asset('storage/' . $item->menuItem->image)); ?>" alt="<?php echo e($item->menuItem->name); ?>" class="w-20 h-20 object-cover rounded">
                    <?php else: ?>
                    <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                        <span class="text-gray-400 text-xs">No Image</span>
                    </div>
                    <?php endif; ?>

                    <div class="flex-1">
                        <h3 class="font-bold text-dark"><?php echo e($item->menuItem->name); ?></h3>
                        <p class="text-sm text-gray-600">Quantity: <?php echo e($item->quantity); ?></p>
                        <p class="text-primary font-semibold">$<?php echo e(number_format($item->price, 2)); ?> each</p>
                    </div>

                    <div class="text-right">
                        <p class="font-bold text-dark">$<?php echo e(number_format($item->price * $item->quantity, 2)); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-6 pt-6 border-t-2 border-gray-200">
                <div class="flex justify-between text-gray-600 mb-2">
                    <span>Subtotal</span>
                    <span>$<?php echo e(number_format($order->subtotal ?? 0, 2)); ?></span>
                </div>
                <div class="flex justify-between text-gray-600 mb-3">
                    <span>Delivery Fee</span>
                    <span>$<?php echo e(number_format($order->delivery_fee ?? 5, 2)); ?></span>
                </div>
                <div class="flex justify-between font-bold text-xl text-dark">
                    <span>Total</span>
                    <span class="text-primary">$<?php echo e(number_format($order->total_amount ?? 0, 2)); ?></span>
                </div>
            </div>
        </div>

        <!-- Delivery Information -->
        <div class="bg-white border-2 border-gray-200 rounded-lg p-6">
            <h2 class="text-2xl font-bold text-dark mb-4">Delivery Information</h2>
            
            <div class="space-y-3">
                <div>
                    <p class="text-gray-600 text-sm">Customer Name</p>
                    <p class="font-semibold text-dark"><?php echo e($order->delivery_name ?? $order->user->name); ?></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Phone Number</p>
                    <p class="font-semibold text-dark"><?php echo e($order->customer_phone ?? $order->user->phone); ?></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Delivery Address</p>
                    <p class="font-semibold text-dark"><?php echo e($order->delivery_address); ?></p>
                </div>
                <?php if($order->notes): ?>
                <div>
                    <p class="text-gray-600 text-sm">Special Instructions</p>
                    <p class="font-semibold text-dark"><?php echo e($order->notes); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Order Summary Card -->
    <div class="md:col-span-1">
        <div class="bg-white border-2 border-gray-200 rounded-lg p-6 sticky top-4">
            <h2 class="text-2xl font-bold text-dark mb-4">Order Summary</h2>
            
            <div class="space-y-3 mb-6">
                <div>
                    <p class="text-gray-600 text-sm">Order ID</p>
                    <p class="font-bold text-dark">#<?php echo e($order->id); ?></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Date & Time</p>
                    <p class="font-semibold text-dark"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                    <p class="text-sm text-gray-600"><?php echo e($order->created_at->format('h:i A')); ?></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Payment Method</p>
                    <p class="font-semibold text-dark"><?php echo e(ucfirst($order->payment_method)); ?></p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Current Status</p>
                    <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold
                        <?php echo e($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ''); ?>

                        <?php echo e($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : ''); ?>

                        <?php echo e($order->status == 'completed' ? 'bg-green-100 text-green-800' : ''); ?>

                        <?php echo e($order->status == 'cancelled' ? 'bg-red-100 text-red-800' : ''); ?>">
                        <?php echo e(ucfirst($order->status)); ?>

                    </span>
                </div>
            </div>

            <!-- Update Status -->
            <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST" class="mb-4">
                <?php echo csrf_field(); ?>
                <label class="block text-dark font-bold mb-2">Update Status</label>
                <select name="status" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none mb-3">
                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>Processing</option>
                    <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Completed</option>
                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
                <button type="submit" class="w-full bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                    Update Status
                </button>
            </form>

            <a href="<?php echo e(route('admin.orders.print', $order->id)); ?>" target="_blank" class="block w-full text-center bg-dark text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                Print Receipt
            </a>

            <form action="<?php echo e(route('admin.orders.destroy', $order->id)); ?>" method="POST" class="mt-3" onsubmit="return confirm('Delete this order permanently?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="w-full bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition">
                    Delete Order
                </button>
            </form>

            <a href="<?php echo e(route('admin.orders.index')); ?>" class="block w-full text-center text-dark px-6 py-2 rounded-lg mt-3 border-2 border-gray-300 hover:border-primary transition">
                Back to Orders
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>