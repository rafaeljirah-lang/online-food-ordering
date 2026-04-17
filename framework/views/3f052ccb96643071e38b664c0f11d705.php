<?php $__env->startSection('title', 'Edit Menu Item'); ?>
<?php $__env->startSection('page-title', 'Edit Menu Item'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <div class="bg-white border-2 border-gray-200 rounded-lg p-6">

        <form action="<?php echo e(route('admin.menu.update', $menu)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Name -->
            <div class="mb-6">
                <label class="block text-dark font-bold mb-2">Item Name *</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"
                       value="<?php echo e(old('name', $menu->name)); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-dark font-bold mb-2">Description *</label>
                <textarea name="description" rows="4" required
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"><?php echo e(old('description', $menu->description)); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Category & Price -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-dark font-bold mb-2">Category *</label>
                    <select name="category_id" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
                        <option value="">Select Category</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $menu->category_id) == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-dark font-bold mb-2">Price ($) *</label>
                    <input type="number" name="price" step="0.01" min="0" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"
                           value="<?php echo e(old('price', $menu->price)); ?>">
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Preparation Time -->
            <div class="mb-6">
                <label class="block text-dark font-bold mb-2">Preparation Time (minutes) *</label>
                <input type="number" name="preparation_time" min="1" required
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none"
                       value="<?php echo e(old('preparation_time', $menu->preparation_time)); ?>">
                <?php $__errorArgs = ['preparation_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label class="block text-dark font-bold mb-2">Item Image</label>

                <?php if($menu->image): ?>
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                    <img src="<?php echo e(asset('storage/' . $menu->image)); ?>" alt="<?php echo e($menu->name); ?>" class="w-48 h-48 object-cover rounded-lg border-2 border-gray-200">
                </div>
                <?php endif; ?>

                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none">
                <p class="text-sm text-gray-600 mt-1">
                    <?php echo e($menu->image ? 'Upload a new image to replace the current one.' : 'Recommended size: 800x600px. Max 2MB.'); ?>

                </p>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Checkboxes -->
            <div class="mb-6">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_available" value="1"
                           <?php echo e(old('is_available', $menu->is_available) ? 'checked' : ''); ?>

                           class="w-5 h-5 text-primary border-2 border-gray-300 rounded">
                    <span class="ml-3 text-dark font-bold">Available for ordering</span>
                </label>

                <label class="flex items-center cursor-pointer mt-2">
                    <input type="checkbox" name="is_featured" value="1"
                           <?php echo e(old('is_featured', $menu->is_featured) ? 'checked' : ''); ?>

                           class="w-5 h-5 text-primary border-2 border-gray-300 rounded">
                    <span class="ml-3 text-dark font-bold">Featured Item</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition">
                    Update Menu Item
                </button>
                <a href="<?php echo e(route('admin.menu.index')); ?>" class="bg-dark text-white px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Delete Form -->
        <div class="mt-8 pt-8 border-t-2 border-gray-200">
            <h3 class="text-lg font-bold text-dark mb-2">Danger Zone</h3>
            <p class="text-sm text-gray-600 mb-4">Once you delete this menu item, there is no going back. Please be certain.</p>
            <form action="<?php echo e(route('admin.menu.destroy', $menu)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu item? This action cannot be undone.')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:opacity-90 transition">
                    Delete Menu Item
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\JM\online-food-ordering\resources\views/admin/menu/edit.blade.php ENDPATH**/ ?>