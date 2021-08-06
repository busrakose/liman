<?php if(request()->wantsJson() || $_SERVER['REMOTE_ADDR'] == "127.0.0.1"): ?>
    <?php (respond(__($exception->getMessage()),201)); ?>
<?php else: ?>
    
    <?php $__env->startSection('content'); ?>
        <div class="error-page mt-5">
            <h2 class="headline text-warning"><i class="fas fa-exclamation-triangle text-warning"></i></h2>
            <div class="error-content">
                <h3><?php echo e(__("Bir şeyler ters gitti.")); ?></h3>
    
                <p>
                    <?php echo e($exception->getMessage()); ?>

                    <br><a class="btn btn-primary mt-2" href="<?php echo e(URL::full()); ?>"><?php echo e(__("Yenile")); ?></a>
                </p>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/errors/504.blade.php ENDPATH**/ ?>