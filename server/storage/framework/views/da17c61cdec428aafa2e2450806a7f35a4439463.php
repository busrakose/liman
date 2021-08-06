<?php if(isset($text,$class,$target_id)): ?>
<button type="button" class="btn <?php echo e($class); ?>" data-toggle="modal" data-target="#<?php echo e($target_id); ?>">
    <?php if(isset($icon)): ?><i class="<?php echo e($icon); ?>"></i> <?php endif; ?><?php echo e(__($text)); ?>

</button>
<?php endif; ?><?php /**PATH /liman/server/resources/views/components/modal-button.blade.php ENDPATH**/ ?>