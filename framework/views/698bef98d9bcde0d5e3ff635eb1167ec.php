<?php $__env->startSection('title', 'My Orders - FoodHub'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold">My Orders</h1>
        <p class="mt-2">Track and view your order history</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">

    <!-- Filter Tabs (UI only for now) -->
    <div class="mb-6 flex gap-4 border-b-2 border-gray-200">
        <button class="px-4 py-2 font-semibold text-primary border-b-2 border-primary -mb-0.5">
            All Orders
        </button>
        <button class="px-4 py-2 font-semibold text-gray-600 hover:text-primary">
            Pending
        </button>
        <button class="px-4 py-2 font-semibold text-gray-600 hover:text-primary">
            Completed
        </button>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <?php
            // SUPPORT BOTH relationship names safely
            $items = $order->items ?? $order->orderItems ?? collect();
        ?>

        <div class="bg-white border-2 border-gray-200 rounded-lg p-6 mb-4 hover:border-primary transition">

            <!-- Header -->
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold text-dark">
                        Order #<?php echo e($order->id); ?>

                    </h3>
                    <p class="text-sm text-gray-600">
                        <?php echo e(optional($order->created_at)->format('M d, Y - h:i A')); ?>

                    </p>
                </div>

                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    <?php if($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800 <?php endif; ?>
                    <?php if($order->status === 'processing'): ?> bg-blue-100 text-blue-800 <?php endif; ?>
                    <?php if($order->status === 'completed'): ?> bg-green-100 text-green-800 <?php endif; ?>
                    <?php if($order->status === 'cancelled'): ?> bg-red-100 text-red-800 <?php endif; ?>
                ">
                    <?php echo e(ucfirst($order->status)); ?>

                </span>
            </div>

            <!-- Items Preview -->
            <div class="mb-4 space-y-3">
                <?php $__currentLoopData = $items->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $menu = $item->menuItem ?? null;
                    ?>

                    <div class="flex items-center gap-3">
                        <?php if($menu && $menu->image): ?>
                            <img
                                src="<?php echo e(asset('storage/' . $menu->image)); ?>"
                                alt="<?php echo e($menu->name); ?>"
                                class="w-12 h-12 object-cover rounded"
                            >
                        <?php else: ?>
                            <div class="w-12 h-12 bg-gray-200 rounded"></div>
                        <?php endif; ?>

                        <div class="flex-1">
                            <p class="font-semibold text-dark">
                                <?php echo e($menu->name ?? 'Item removed'); ?>

                            </p>
                            <p class="text-sm text-gray-600">
                                Quantity: <?php echo e($item->quantity ?? 0); ?>

                            </p>
                        </div>

                        <p class="font-semibold text-dark">
                            $<?php echo e(number_format(($item->price ?? 0) * ($item->quantity ?? 1), 2)); ?>

                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($items->count() > 3): ?>
                    <p class="text-sm text-gray-600 ml-15">
                        + <?php echo e($items->count() - 3); ?> more items
                    </p>
                <?php endif; ?>
            </div>

            <!-- Footer -->
            <div class="flex justify-between items-center pt-4 border-t-2 border-gray-200">
                <div>
                    <p class="text-gray-600 text-sm">Total Amount</p>
                    <p class="text-2xl font-bold text-primary">
                        $<?php echo e(number_format($order->total_amount ?? 0, 2)); ?>

                    </p>
                </div>

                <div class="flex gap-3">
                    <a
                        href="<?php echo e(route('customer.order-details', $order->id)); ?>"
                        class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition"
                    >
                        View Details
                    </a>

                    <?php if($order->status === 'completed'): ?>
                        <button
                            class="bg-dark text-white px-6 py-2 rounded-lg hover:opacity-90 transition"
                        >
                            Reorder
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-12">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>

            <h2 class="text-2xl font-bold text-dark mb-2">No orders yet</h2>
            <p class="text-gray-600 mb-6">Start ordering your favorite food</p>

            <a
                href="<?php echo e(route('customer.menu')); ?>"
                class="inline-block bg-primary text-white px-8 py-3 rounded-lg hover:opacity-90 transition"
            >
                Browse Menu
            </a>
        </div>
    <?php endif; ?>

    <!-- Pagination -->
    <?php if($orders->hasPages()): ?>
        <div class="mt-8">
            <?php echo e($orders->links()); ?>

        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/customer/order-history.blade.php ENDPATH**/ ?>