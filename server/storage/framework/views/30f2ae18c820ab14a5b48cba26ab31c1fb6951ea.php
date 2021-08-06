<?php $__env->startSection('content'); ?>

<ol class="breadcrumb">
    <!--<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
    <li class="breadcrumb-item"><a href="/l/<?php echo e(extension()->id); ?>"><?php echo e(extension()->display_name); ?> <?php echo e(__('Sunucuları')); ?></a></li>
    <li class="breadcrumb-item"><a href="/l/<?php echo e(extension()->id); ?>/<?php echo e(server()->city); ?>"><?php echo e(cities(server()->city)); ?></a></li>
    <li class="breadcrumb-item"><a href='/l/<?php echo e(extension()->id); ?>/<?php echo e(server()->city); ?>/<?php echo e(server()->id); ?>'><?php echo e(server()->name); ?></a></li> 
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__("Eklenti Ayarları")); ?></li>-->
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('server_one', server()->id)); ?>"><?php echo e(server()->name); ?></a></li>
    <li class="breadcrumb-item"><a href="/l/<?php echo e(server()->id); ?>/<?php echo e(extension()->id); ?>"><?php echo e(__(extension()->display_name)); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__(extension()->display_name)); ?> eklenti ayarları</li>
</ol>
<?php echo $__env->make("extension_pages.setup_data", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/extension_pages/setup.blade.php ENDPATH**/ ?>