<?php if(request('partialRequest')): ?>
    <?php echo $__env->make('layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php (die()); ?>
<?php else: ?>
    

    <?php $__env->startSection('body_class', 'sidebar-mini layout-fixed ' . ((session()->has('collapse')) ? 'sidebar-collapse' : '')); ?>

    <?php $__env->startSection('body'); ?>
        <div class="wrapper">
            <?php if(auth()->guard()->check()): ?>
                <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php echo $__env->make('layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/layouts/app.blade.php ENDPATH**/ ?>