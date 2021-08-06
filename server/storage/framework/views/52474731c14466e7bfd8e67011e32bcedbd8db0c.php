<?php if($errors): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> <?php echo e(__('Hata!')); ?></h5>
            <?php echo e($message); ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /liman/server/resources/views/components/errors.blade.php ENDPATH**/ ?>