<?php $__env->startSection('title', 'Orders Management'); ?>

<?php $__env->startSection('page-title', 'Orders Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex gap-4">
    <select id="statusFilter" class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
        <option value="">All Status</option>
        <option value="pending">Pending</option>
        <option value="processing">Processing</option>
        <option value="completed">Completed</option>
        <option value="cancelled">Cancelled</option>
    </select>
    <input type="date" id="dateFilter" class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
</div>

<div class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr class="border-b-2 border-gray-200">
                <th class="text-left py-4 px-6 text-dark font-bold">Order ID</th>
                <th class="text-left py-4 px-6 text-dark font-bold">Customer</th>
                <th class="text-left py-4 px-6 text-dark font-bold">Items</th>
                <th class="text-left py-4 px-6 text-dark font-bold">Total</th>
                <th class="text-left py-4 px-6 text-dark font-bold">Payment</th>
                <th class="text-left py-4 px-6 text-dark font-bold">Status</th>
                <th class="text-left py-4 px-6 text-dark font-bold">Date</th>
                <th class="text-left py-4 px-6 text-dark font-bold">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $orders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-4 px-6 font-semibold text-dark">#<?php echo e($order->id ?? 'N/A'); ?></td>

                <td class="py-4 px-6">
                    <p class="font-semibold text-dark"><?php echo e($order->user->name ?? 'Guest'); ?></p>
                    <p class="text-sm text-gray-600"><?php echo e($order->user->email ?? '-'); ?></p>
                </td>

                <td class="py-4 px-6 text-dark">
                    <?php echo e($order->orderItems?->count() ?? 0); ?> item<?php echo e(($order->orderItems?->count() ?? 0) !== 1 ? 's' : ''); ?>

                </td>

                <td class="py-4 px-6 font-semibold text-primary">
                    $<?php echo e(number_format($order->total_amount ?? 0, 2)); ?>

                </td>

                <td class="py-4 px-6">
                    <span class="text-sm text-dark"><?php echo e(ucfirst($order->payment_method ?? 'N/A')); ?></span>
                </td>

                <td class="py-4 px-6">
                    <form action="<?php echo e(route('admin.orders.update-status', $order->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <select name="status" onchange="this.form.submit()"
                                class="px-3 py-1 rounded-full text-xs font-semibold border-2
                                <?php echo e($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800 border-yellow-300' : ''); ?>

                                <?php echo e($order->status == 'processing' ? 'bg-blue-100 text-blue-800 border-blue-300' : ''); ?>

                                <?php echo e($order->status == 'completed' ? 'bg-green-100 text-green-800 border-green-300' : ''); ?>

                                <?php echo e($order->status == 'cancelled' ? 'bg-red-100 text-red-800 border-red-300' : ''); ?>">
                            <option value="pending" <?php echo e(($order->status ?? '') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="processing" <?php echo e(($order->status ?? '') == 'processing' ? 'selected' : ''); ?>>Processing</option>
                            <option value="completed" <?php echo e(($order->status ?? '') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                            <option value="cancelled" <?php echo e(($order->status ?? '') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                    </form>
                </td>

                <td class="py-4 px-6 text-sm text-gray-600">
                    <?php echo e(optional($order->created_at)->format('M d, Y') ?? '-'); ?><br>
                    <span class="text-xs"><?php echo e(optional($order->created_at)->format('h:i A') ?? '-'); ?></span>
                </td>

                <td class="py-4 px-6">
                    <div class="flex gap-2">
                        <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="text-primary hover:underline">View</a>
                        <a href="<?php echo e(route('admin.orders.print', $order->id)); ?>" class="text-dark hover:underline" target="_blank">Print</a>
                        <form action="<?php echo e(route('admin.orders.destroy', $order->id)); ?>" method="POST" onsubmit="return confirm('Delete this order permanently?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="text-center py-8 text-gray-500">No orders found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if(isset($orders) && $orders->hasPages()): ?>
<div class="mt-6">
    <?php echo e($orders->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>