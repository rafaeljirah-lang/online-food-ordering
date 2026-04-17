<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Today's Orders</p>
            <p class="text-2xl font-bold mt-1"><?php echo e($todayOrders); ?></p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Today's Revenue</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">$<?php echo e(number_format($todaySales, 2)); ?></p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Pending Orders</p>
            <p class="text-2xl font-bold mt-1"><?php echo e($pendingOrders); ?></p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Menu Items</p>
            <p class="text-2xl font-bold mt-1"><?php echo e($totalMenuItems); ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Customers</p>
            <p class="text-xl font-semibold"><?php echo e($totalCustomers); ?></p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Orders</p>
            <p class="text-xl font-semibold"><?php echo e($totalOrders); ?></p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-4">
            <p class="text-xs text-gray-500">Total Revenue</p>
            <p class="text-xl font-semibold">$<?php echo e(number_format($totalRevenue, 2)); ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-4 xl:col-span-1">
            <h2 class="font-semibold mb-3">Popular Menu Items</h2>
            <div class="space-y-2">
                <?php $__empty_1 = true; $__currentLoopData = $popularItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between text-sm border border-gray-100 rounded-lg px-3 py-2">
                        <span><?php echo e($item->name); ?></span>
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded"><?php echo e($item->order_items_count); ?> orders</span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500">No data available.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-4 xl:col-span-2">
            <h2 class="font-semibold mb-3">Recent Orders</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="py-2">Order ID</th>
                            <th class="py-2">Customer</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Total</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-b border-gray-100">
                                <td class="py-2">#<?php echo e($order->id); ?></td>
                                <td class="py-2"><?php echo e($order->user->name ?? 'Guest'); ?></td>
                                <td class="py-2">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        <?php echo e($order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : ''); ?>

                                        <?php echo e($order->status === 'processing' ? 'bg-blue-100 text-blue-700' : ''); ?>

                                        <?php echo e($order->status === 'completed' ? 'bg-green-100 text-green-700' : ''); ?>

                                        <?php echo e($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : ''); ?>">
                                        <?php echo e(ucfirst($order->status)); ?>

                                    </span>
                                </td>
                                <td class="py-2">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                                <td class="py-2">
                                    <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="text-blue-600 hover:underline">View</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="5" class="py-4 text-gray-500">No recent orders.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>