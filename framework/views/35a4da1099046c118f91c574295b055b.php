

<?php $__env->startSection('title', 'My Profile - FoodHub'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-dark text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold">My Profile</h1>
        <p class="mt-2">Update your account information</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto bg-white border-2 border-gray-200 rounded-lg p-8">
        <?php if(session('success')): ?>
            <div class="mb-4 bg-green-50 border-2 border-green-200 text-green-700 p-3 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-4 bg-red-50 border-2 border-red-200 text-red-700 p-3 rounded-lg">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('customer.profile.update')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label class="block text-dark font-semibold mb-2">Name</label>
                <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-dark font-semibold mb-2">Email</label>
                <input type="email" value="<?php echo e($user->email); ?>" disabled
                       class="w-full px-4 py-3 border-2 border-gray-200 bg-gray-100 rounded-lg">
                <p class="text-xs text-gray-500 mt-1">Email changes are disabled for security.</p>
            </div>

            <div class="mb-4">
                <label class="block text-dark font-semibold mb-2">Phone</label>
                <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-dark font-semibold mb-2">Address</label>
                <textarea name="address" rows="4"
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"><?php echo e(old('address', $user->address)); ?></textarea>
            </div>

            <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition">
                Save Profile
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/customer/profile.blade.php ENDPATH**/ ?>